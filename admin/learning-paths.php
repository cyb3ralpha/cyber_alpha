<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paths  = readJson('learning-paths.json');
    $action = $_POST['_action'] ?? '';

    if ($action === 'delete') {
        $id    = (int)$_POST['id'];
        $paths = array_values(array_filter($paths, fn($p) => $p['id'] !== $id));
        writeJson('learning-paths.json', $paths);
        $msg = 'Path deleted.';
    } else {
        $rawLessons = $_POST['lessons'] ?? '';
        $lessons    = array_filter(array_map('trim', explode("\n", $rawLessons)));
        $item = [
            'id'          => (int)$_POST['id'],
            'title'       => trim($_POST['title']),
            'level'       => $_POST['level'],
            'duration'    => trim($_POST['duration']),
            'description' => trim($_POST['description']),
            'status'      => $_POST['status'],
            'lessons'     => array_values($lessons),
        ];
        if ($item['id'] === 0) {
            $item['id'] = nextId($paths);
            $paths[]    = $item;
            $msg = 'Learning path added.';
        } else {
            foreach ($paths as &$p) {
                if ($p['id'] === $item['id']) { $p = $item; break; }
            }
            $msg = 'Path updated.';
        }
        writeJson('learning-paths.json', $paths);
    }
}

$paths = readJson('learning-paths.json');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Learning Paths — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>
<?php include __DIR__ . '/partials/sidebar.php'; ?>
<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/learning-paths</div>
    <div class="topbar-right">
      <button onclick="openModal()" class="btn btn-primary btn-sm">+ Add Path</button>
    </div>
  </div>
  <div class="content">
    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>
    <div class="card">
      <div class="card-header">
        <div class="card-title">All Learning Paths</div>
        <span style="font-size:.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($paths) ?> paths</span>
      </div>
      <?php if (empty($paths)): ?>
        <div class="empty-state"><div class="icon">🗺</div><p>No learning paths yet.</p></div>
      <?php else: ?>
      <table>
        <thead><tr><th>Title</th><th>Level</th><th>Duration</th><th>Lessons</th><th>Status</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($paths as $p): ?>
          <tr>
            <td>
              <div style="font-weight:600"><?= htmlspecialchars($p['title']) ?></div>
              <div style="font-size:.72rem;color:var(--text-muted)"><?= htmlspecialchars(substr($p['description'],0,70)) ?>…</div>
            </td>
            <td><?php
              $lc = ['beginner'=>'badge-success','intermediate'=>'badge-warning','advanced'=>'badge-danger'];
              echo '<span class="badge '.($lc[$p['level']]??'badge-muted').'">'.htmlspecialchars($p['level']).'</span>';
            ?></td>
            <td style="font-family:var(--font-mono);font-size:.8rem"><?= htmlspecialchars($p['duration']) ?></td>
            <td style="font-family:var(--font-mono)"><?= count($p['lessons'] ?? []) ?></td>
            <td><?= $p['status']==='active'
              ? '<span class="badge badge-success">● active</span>'
              : '<span class="badge badge-muted">inactive</span>' ?></td>
            <td>
              <div class="actions">
                <button onclick="editPath(<?= htmlspecialchars(json_encode($p)) ?>)" class="btn btn-secondary btn-sm">✏ Edit</button>
                <form method="POST" onsubmit="return confirm('Delete?')">
                  <input type="hidden" name="_action" value="delete">
                  <input type="hidden" name="id" value="<?= $p['id'] ?>">
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

<div class="modal-backdrop" id="pathModal">
  <div class="modal" style="max-width:680px">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">// add_path</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="pId" value="0">
        <div class="form-group">
          <label class="form-label">Title *</label>
          <input type="text" name="title" id="pTitle" class="form-control" required placeholder="Web Application Security">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Level</label>
            <select name="level" id="pLevel" class="form-control">
              <option value="beginner">Beginner</option>
              <option value="intermediate">Intermediate</option>
              <option value="advanced">Advanced</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Duration</label>
            <input type="text" name="duration" id="pDuration" class="form-control" placeholder="12 weeks">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" id="pDesc" class="form-control" rows="3" placeholder="What will students learn?"></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Lessons <span style="color:var(--text-muted)">(one per line)</span></label>
          <textarea name="lessons" id="pLessons" class="form-control" rows="8"
                    placeholder="HTTP & Web Fundamentals&#10;OWASP Top 10&#10;SQL Injection&#10;XSS & CSRF&#10;…"></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">Status</label>
          <select name="status" id="pStatus" class="form-control">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">💾 Save Path</button>
      </div>
    </form>
  </div>
</div>
<?php include __DIR__ . '/partials/toast.php'; ?>
<script>
function openModal(d) {
  document.getElementById('pId').value      = d?.id ?? 0;
  document.getElementById('pTitle').value   = d?.title ?? '';
  document.getElementById('pLevel').value   = d?.level ?? 'beginner';
  document.getElementById('pDuration').value= d?.duration ?? '';
  document.getElementById('pDesc').value    = d?.description ?? '';
  document.getElementById('pLessons').value = (d?.lessons ?? []).join('\n');
  document.getElementById('pStatus').value  = d?.status ?? 'active';
  document.getElementById('modalTitle').textContent = d ? '// edit_path' : '// add_path';
  document.getElementById('pathModal').classList.add('open');
}
function editPath(d) { openModal(d); }
function closeModal() { document.getElementById('pathModal').classList.remove('open'); }
</script>
</body>
</html>
