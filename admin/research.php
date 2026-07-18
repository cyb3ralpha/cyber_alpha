<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items  = readJson('research.json');
    $action = $_POST['_action'] ?? '';

    if ($action === 'delete') {
        $id    = (int)$_POST['id'];
        $items = array_values(array_filter($items, fn($i) => $i['id'] !== $id));
        writeJson('research.json', $items);
        $msg = 'Entry deleted.';
    } else {
        $item = [
            'id'       => (int)$_POST['id'],
            'title'    => trim($_POST['title']),
            'type'     => $_POST['type'],
            'status'   => $_POST['status'],
            'date'     => $_POST['date'],
            'journal'  => trim($_POST['journal']),
            'abstract' => trim($_POST['abstract']),
            'link'     => trim($_POST['link']),
            'tags'     => array_map('trim', explode(',', $_POST['tags'] ?? '')),
        ];
        if ($item['id'] === 0) {
            $item['id'] = nextId($items);
            $items[]    = $item;
            $msg = 'Research entry added.';
        } else {
            foreach ($items as &$i) {
                if ($i['id'] === $item['id']) { $i = $item; break; }
            }
            $msg = 'Entry updated.';
        }
        writeJson('research.json', $items);
    }
}

$items = readJson('research.json');
usort($items, fn($a,$b) => strcmp($b['date'], $a['date']));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Research — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/research</div>
    <div class="topbar-right">
      <button onclick="openModal()" class="btn btn-primary btn-sm">+ Add Entry</button>
    </div>
  </div>
  <div class="content">
    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <div class="card-title">Research & Publications</div>
        <span style="font-size:.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($items) ?> entries</span>
      </div>
      <?php if (empty($items)): ?>
        <div class="empty-state"><div class="icon">🔬</div><p>No research entries.</p></div>
      <?php else: ?>
      <table>
        <thead><tr><th>Title</th><th>Type</th><th>Published In</th><th>Date</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($items as $r): ?>
          <tr>
            <td style="max-width:260px">
              <div style="font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= htmlspecialchars($r['title']) ?></div>
              <div style="font-size:.7rem;color:var(--text-muted);white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= htmlspecialchars(substr($r['abstract'],0,80)) ?>…</div>
            </td>
            <td><span class="badge badge-primary"><?= $r['type'] ?></span></td>
            <td style="font-size:.8rem"><?= htmlspecialchars($r['journal']) ?></td>
            <td style="font-family:var(--font-mono);font-size:.8rem"><?= $r['date'] ?></td>
            <td><?php
              $badges = ['published'=>'badge-success','preprint'=>'badge-warning','draft'=>'badge-muted'];
              $bc     = $badges[$r['status']] ?? 'badge-muted';
            ?><span class="badge <?= $bc ?>"><?= $r['status'] ?></span></td>
            <td>
              <div class="actions">
                <button onclick="editItem(<?= htmlspecialchars(json_encode($r)) ?>)" class="btn btn-secondary btn-sm">✏ Edit</button>
                <?php if ($r['link']): ?>
                  <a href="<?= htmlspecialchars($r['link']) ?>" target="_blank" class="btn btn-secondary btn-sm">↗</a>
                <?php endif; ?>
                <form method="POST" onsubmit="return confirm('Delete?')">
                  <input type="hidden" name="_action" value="delete">
                  <input type="hidden" name="id" value="<?= $r['id'] ?>">
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

<div class="modal-backdrop" id="researchModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">// add_research</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="rId" value="0">
        <div class="form-group">
          <label class="form-label">Title *</label>
          <input type="text" name="title" id="rTitle" class="form-control" required placeholder="Paper or CVE title…">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Type</label>
            <select name="type" id="rType" class="form-control">
              <option value="paper">Research Paper</option>
              <option value="cve">CVE Disclosure</option>
              <option value="preprint">Preprint</option>
              <option value="thesis">Thesis</option>
              <option value="report">Technical Report</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" id="rStatus" class="form-control">
              <option value="published">Published</option>
              <option value="preprint">Preprint</option>
              <option value="draft">Draft</option>
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Journal / Venue</label>
            <input type="text" name="journal" id="rJournal" class="form-control" placeholder="IEEE S&P, arXiv, NVD…">
          </div>
          <div class="form-group">
            <label class="form-label">Date</label>
            <input type="date" name="date" id="rDate" class="form-control">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Abstract</label>
          <textarea name="abstract" id="rAbstract" class="form-control" rows="4" placeholder="Brief summary…"></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Link / DOI</label>
            <input type="url" name="link" id="rLink" class="form-control" placeholder="https://…">
          </div>
          <div class="form-group">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" id="rTags" class="form-control" placeholder="AI Security, CVE…">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">💾 Save</button>
      </div>
    </form>
  </div>
</div>
<?php include __DIR__ . '/partials/toast.php'; ?>
<script>
function openModal(d) {
  document.getElementById('rId').value       = d?.id ?? 0;
  document.getElementById('rTitle').value    = d?.title ?? '';
  document.getElementById('rType').value     = d?.type ?? 'paper';
  document.getElementById('rStatus').value   = d?.status ?? 'published';
  document.getElementById('rJournal').value  = d?.journal ?? '';
  document.getElementById('rDate').value     = d?.date ?? '';
  document.getElementById('rAbstract').value = d?.abstract ?? '';
  document.getElementById('rLink').value     = d?.link ?? '';
  document.getElementById('rTags').value     = (d?.tags ?? []).join(', ');
  document.getElementById('modalTitle').textContent = d ? '// edit_research' : '// add_research';
  document.getElementById('researchModal').classList.add('open');
}
function editItem(d) { openModal(d); }
function closeModal() { document.getElementById('researchModal').classList.remove('open'); }
</script>
</body>
</html>
