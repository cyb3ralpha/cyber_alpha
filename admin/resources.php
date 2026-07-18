<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items  = readJson('resources.json');
    $action = $_POST['_action'] ?? '';

    if ($action === 'delete') {
        $id    = (int)$_POST['id'];
        $items = array_values(array_filter($items, fn($i) => $i['id'] !== $id));
        writeJson('resources.json', $items);
        $msg = 'Resource deleted.';
    } else {
        $item = [
            'id'          => (int)$_POST['id'],
            'title'       => trim($_POST['title']),
            'type'        => $_POST['type'],
            'description' => trim($_POST['description']),
            'download'    => trim($_POST['download']),
            'status'      => $_POST['status'],
            'tags'        => array_map('trim', explode(',', $_POST['tags'] ?? '')),
        ];
        if ($item['id'] === 0) {
            $item['id'] = nextId($items);
            $items[]    = $item;
            $msg = 'Resource added.';
        } else {
            foreach ($items as &$i) {
                if ($i['id'] === $item['id']) { $i = $item; break; }
            }
            $msg = 'Resource updated.';
        }
        writeJson('resources.json', $items);
    }
}

$items = readJson('resources.json');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Resources — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/resources</div>
    <div class="topbar-right">
      <button onclick="openModal()" class="btn btn-primary btn-sm">+ Add Resource</button>
    </div>
  </div>
  <div class="content">
    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <div class="card-title">Resource Library</div>
        <span style="font-size:.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($items) ?> items</span>
      </div>
      <?php if (empty($items)): ?>
        <div class="empty-state"><div class="icon">📚</div><p>No resources yet.</p></div>
      <?php else: ?>
      <table>
        <thead><tr><th>Title</th><th>Type</th><th>Download Link</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($items as $r): ?>
          <tr>
            <td>
              <div style="font-weight:600"><?= htmlspecialchars($r['title']) ?></div>
              <div style="font-size:.72rem;color:var(--text-muted)"><?= htmlspecialchars(implode(', ', $r['tags'] ?? [])) ?></div>
            </td>
            <td><span class="badge badge-primary"><?= htmlspecialchars($r['type']) ?></span></td>
            <td style="font-family:var(--font-mono);font-size:.78rem;color:var(--text-muted)"><?= htmlspecialchars($r['download']) ?></td>
            <td><?= $r['status']==='active'
              ? '<span class="badge badge-success">● active</span>'
              : '<span class="badge badge-muted">hidden</span>' ?></td>
            <td>
              <div class="actions">
                <button onclick="editItem(<?= htmlspecialchars(json_encode($r)) ?>)" class="btn btn-secondary btn-sm">✏ Edit</button>
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

<div class="modal-backdrop" id="resourceModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">// add_resource</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="resId" value="0">
        <div class="form-group">
          <label class="form-label">Title *</label>
          <input type="text" name="title" id="resTitle" class="form-control" required placeholder="Web Security Cheat Sheet">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Type</label>
            <select name="type" id="resType" class="form-control">
              <option value="cheatsheet">Cheat Sheet</option>
              <option value="checklist">Checklist</option>
              <option value="tool">Tool</option>
              <option value="script">Script</option>
              <option value="template">Template</option>
              <option value="ebook">eBook</option>
              <option value="mindmap">Mind Map</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" id="resStatus" class="form-control">
              <option value="active">Active (visible)</option>
              <option value="hidden">Hidden</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" id="resDesc" class="form-control" rows="3" placeholder="What is this resource?"></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Download URL / Path</label>
            <input type="text" name="download" id="resDownload" class="form-control" placeholder="/resources/file.pdf">
          </div>
          <div class="form-group">
            <label class="form-label">Tags</label>
            <input type="text" name="tags" id="resTags" class="form-control" placeholder="Web, Tools, CTF">
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
  document.getElementById('resId').value       = d?.id ?? 0;
  document.getElementById('resTitle').value    = d?.title ?? '';
  document.getElementById('resType').value     = d?.type ?? 'cheatsheet';
  document.getElementById('resStatus').value   = d?.status ?? 'active';
  document.getElementById('resDesc').value     = d?.description ?? '';
  document.getElementById('resDownload').value = d?.download ?? '';
  document.getElementById('resTags').value     = (d?.tags ?? []).join(', ');
  document.getElementById('modalTitle').textContent = d ? '// edit_resource' : '// add_resource';
  document.getElementById('resourceModal').classList.add('open');
}
function editItem(d) { openModal(d); }
function closeModal() { document.getElementById('resourceModal').classList.remove('open'); }
</script>
</body>
</html>
