<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $projects = readJson('projects.json');
    $action   = $_POST['_action'] ?? '';

    if ($action === 'delete') {
        $id       = (int)$_POST['id'];
        $projects = array_values(array_filter($projects, fn($p) => $p['id'] !== $id));
        writeJson('projects.json', $projects);
        $msg = 'Project deleted.';
    } else {
        $item = [
            'id'          => (int)($_POST['id'] ?: 0),
            'name'        => trim($_POST['name']),
            'slug'        => trim($_POST['slug']) ?: strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($_POST['name']))),
            'description' => trim($_POST['description']),
            'status'      => $_POST['status'],
            'stars'       => (int)$_POST['stars'],
            'forks'       => (int)$_POST['forks'],
            'language'    => trim($_POST['language']),
            'github'      => trim($_POST['github']),
            'tags'        => array_map('trim', explode(',', $_POST['tags'] ?? '')),
        ];

        if ($item['id'] === 0) {
            $item['id'] = nextId($projects);
            $projects[] = $item;
            $msg = 'Project created.';
        } else {
            foreach ($projects as &$p) {
                if ($p['id'] === $item['id']) { $p = $item; break; }
            }
            $msg = 'Project updated.';
        }
        writeJson('projects.json', $projects);
    }
}

$projects = readJson('projects.json');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Projects — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>

<?php include __DIR__ . '/partials/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/projects</div>
    <div class="topbar-right">
      <button onclick="openModal()" class="btn btn-primary btn-sm">+ New Project</button>
    </div>
  </div>

  <div class="content">

    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header">
        <div class="card-title">All Projects</div>
        <span style="font-size:0.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($projects) ?> project<?= count($projects)!==1?'s':'' ?></span>
      </div>
      <?php if (empty($projects)): ?>
        <div class="empty-state"><div class="icon">🚀</div><p>No projects yet.</p></div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>Project</th><th>Language</th><th>Stars</th><th>Forks</th><th>GitHub</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $p): ?>
          <tr>
            <td>
              <div style="font-weight:600"><?= htmlspecialchars($p['name']) ?></div>
              <div style="font-size:0.72rem;color:var(--text-muted);max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                <?= htmlspecialchars($p['description']) ?>
              </div>
            </td>
            <td><span class="badge badge-primary"><?= htmlspecialchars($p['language']) ?></span></td>
            <td style="font-family:var(--font-mono)">⭐ <?= number_format($p['stars']) ?></td>
            <td style="font-family:var(--font-mono)">🍴 <?= number_format($p['forks']) ?></td>
            <td>
              <?php if ($p['github']): ?>
                <a href="<?= htmlspecialchars($p['github']) ?>" target="_blank" class="btn btn-secondary btn-sm">↗ Repo</a>
              <?php else: ?>
                <span style="color:var(--text-muted);font-size:0.75rem">—</span>
              <?php endif; ?>
            </td>
            <td>
              <?= $p['status'] === 'active'
                ? '<span class="badge badge-success">● active</span>'
                : '<span class="badge badge-muted">archived</span>' ?>
            </td>
            <td>
              <div class="actions">
                <button onclick="editProject(<?= htmlspecialchars(json_encode($p)) ?>)" class="btn btn-secondary btn-sm">✏ Edit</button>
                <form method="POST" onsubmit="return confirm('Delete this project?')">
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

<!-- Modal -->
<div class="modal-backdrop" id="projectModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">// new_project</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="projectId" value="0">
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Project Name *</label>
            <input type="text" name="name" id="projectName" class="form-control" required placeholder="NeuralScan">
          </div>
          <div class="form-group">
            <label class="form-label">Language</label>
            <input type="text" name="language" id="projectLang" class="form-control" placeholder="Python, Go, Rust…">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Description</label>
          <textarea name="description" id="projectDesc" class="form-control" rows="3" placeholder="What does this project do?"></textarea>
        </div>
        <div class="form-group">
          <label class="form-label">GitHub URL</label>
          <input type="url" name="github" id="projectGithub" class="form-control" placeholder="https://github.com/cyberalpha/…">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Stars</label>
            <input type="number" name="stars" id="projectStars" class="form-control" value="0" min="0">
          </div>
          <div class="form-group">
            <label class="form-label">Forks</label>
            <input type="number" name="forks" id="projectForks" class="form-control" value="0" min="0">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" id="projectStatus" class="form-control">
              <option value="active">Active</option>
              <option value="archived">Archived</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Tags (comma separated)</label>
            <input type="text" name="tags" id="projectTags" class="form-control" placeholder="AI, Security, Python">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">💾 Save Project</button>
      </div>
    </form>
  </div>
</div>

<?php include __DIR__ . '/partials/toast.php'; ?>

<script>
function openModal(data) {
  document.getElementById('projectId').value     = data?.id ?? 0;
  document.getElementById('projectName').value   = data?.name ?? '';
  document.getElementById('projectLang').value   = data?.language ?? '';
  document.getElementById('projectDesc').value   = data?.description ?? '';
  document.getElementById('projectGithub').value = data?.github ?? '';
  document.getElementById('projectStars').value  = data?.stars ?? 0;
  document.getElementById('projectForks').value  = data?.forks ?? 0;
  document.getElementById('projectStatus').value = data?.status ?? 'active';
  document.getElementById('projectTags').value   = (data?.tags ?? []).join(', ');
  document.getElementById('modalTitle').textContent = data ? '// edit_project' : '// new_project';
  document.getElementById('projectModal').classList.add('open');
}
function editProject(data) { openModal(data); }
function closeModal() { document.getElementById('projectModal').classList.remove('open'); }
</script>
</body>
</html>
