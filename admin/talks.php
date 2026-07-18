<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $talks  = readJson('talks.json');
    $action = $_POST['_action'] ?? '';

    if ($action === 'delete') {
        $id    = (int)$_POST['id'];
        $talks = array_values(array_filter($talks, fn($t) => $t['id'] !== $id));
        writeJson('talks.json', $talks);
        $msg = 'Talk deleted.';
    } else {
        $item = [
            'id'          => (int)$_POST['id'],
            'title'       => trim($_POST['title']),
            'event'       => trim($_POST['event']),
            'date'        => $_POST['date'],
            'location'    => trim($_POST['location']),
            'type'        => $_POST['type'],
            'status'      => $_POST['status'],
            'description' => trim($_POST['description']),
            'slides'      => trim($_POST['slides']),
            'video'       => trim($_POST['video']),
            'tags'        => array_map('trim', explode(',', $_POST['tags'] ?? '')),
        ];
        if ($item['id'] === 0) {
            $item['id'] = nextId($talks);
            $talks[]    = $item;
            $msg = 'Talk added.';
        } else {
            foreach ($talks as &$t) {
                if ($t['id'] === $item['id']) { $t = $item; break; }
            }
            $msg = 'Talk updated.';
        }
        writeJson('talks.json', $talks);
    }
}

$talks = readJson('talks.json');
usort($talks, fn($a,$b) => strcmp($b['date'], $a['date']));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Talks — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/talks</div>
    <div class="topbar-right">
      <button onclick="openModal()" class="btn btn-primary btn-sm">+ Add Talk</button>
    </div>
  </div>
  <div class="content">
    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <div class="card-title">All Talks & Events</div>
        <span style="font-size:.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($talks) ?> total</span>
      </div>
      <?php if (empty($talks)): ?>
        <div class="empty-state"><div class="icon">🎙</div><p>No talks yet.</p></div>
      <?php else: ?>
      <table>
        <thead><tr><th>Title</th><th>Event</th><th>Date</th><th>Type</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($talks as $t): ?>
          <tr>
            <td>
              <div style="font-weight:600"><?= htmlspecialchars($t['title']) ?></div>
              <div style="font-size:.72rem;color:var(--text-muted)"><?= htmlspecialchars($t['location']) ?></div>
            </td>
            <td><?= htmlspecialchars($t['event']) ?></td>
            <td style="font-family:var(--font-mono);font-size:.8rem"><?= $t['date'] ?></td>
            <td><span class="badge badge-primary"><?= $t['type'] ?></span></td>
            <td><?= $t['status']==='upcoming'
              ? '<span class="badge badge-warning">● upcoming</span>'
              : '<span class="badge badge-success">✓ done</span>' ?></td>
            <td>
              <div class="actions">
                <button onclick="editTalk(<?= htmlspecialchars(json_encode($t)) ?>)" class="btn btn-secondary btn-sm">✏ Edit</button>
                <form method="POST" onsubmit="return confirm('Delete?')">
                  <input type="hidden" name="_action" value="delete">
                  <input type="hidden" name="id" value="<?= $t['id'] ?>">
                  <button class="btn btn-danger btn-sm">✕</button>
                </form>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</div>

<div class="modal-backdrop" id="talkModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">// add_talk</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="tId" value="0">
        <div class="form-group">
          <label class="form-label">Talk Title *</label>
          <input type="text" name="title" id="tTitle" class="form-control" required placeholder="AI-Powered Attacks…">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Event / Conference</label>
            <input type="text" name="event" id="tEvent" class="form-control" placeholder="Black Hat USA 2025">
          </div>
          <div class="form-group">
            <label class="form-label">Location</label>
            <input type="text" name="location" id="tLocation" class="form-control" placeholder="Las Vegas, NV">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Date</label>
            <input type="date" name="date" id="tDate" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Type</label>
            <select name="type" id="tType" class="form-control">
              <option value="talk">Talk</option>
              <option value="keynote">Keynote</option>
              <option value="workshop">Workshop</option>
              <option value="webinar">Webinar</option>
              <option value="panel">Panel</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" id="tDesc" class="form-control" rows="3" placeholder="What is this talk about?"></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Slides URL</label>
            <input type="url" name="slides" id="tSlides" class="form-control" placeholder="https://…">
          </div>
          <div class="form-group">
            <label class="form-label">Video URL</label>
            <input type="url" name="video" id="tVideo" class="form-control" placeholder="https://youtube.com/…">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" id="tStatus" class="form-control">
              <option value="upcoming">Upcoming</option>
              <option value="completed">Completed</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" id="tTags" class="form-control" placeholder="AI, Security, Career">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">💾 Save Talk</button>
      </div>
    </form>
  </div>
</div>
<?php include __DIR__ . '/partials/toast.php'; ?>
<script>
function openModal(d) {
  document.getElementById('tId').value       = d?.id ?? 0;
  document.getElementById('tTitle').value    = d?.title ?? '';
  document.getElementById('tEvent').value    = d?.event ?? '';
  document.getElementById('tLocation').value = d?.location ?? '';
  document.getElementById('tDate').value     = d?.date ?? '';
  document.getElementById('tType').value     = d?.type ?? 'talk';
  document.getElementById('tDesc').value     = d?.description ?? '';
  document.getElementById('tSlides').value   = d?.slides ?? '';
  document.getElementById('tVideo').value    = d?.video ?? '';
  document.getElementById('tStatus').value   = d?.status ?? 'upcoming';
  document.getElementById('tTags').value     = (d?.tags ?? []).join(', ');
  document.getElementById('modalTitle').textContent = d ? '// edit_talk' : '// add_talk';
  document.getElementById('talkModal').classList.add('open');
}
function editTalk(d) { openModal(d); }
function closeModal() { document.getElementById('talkModal').classList.remove('open'); }
</script>
</body>
</html>
