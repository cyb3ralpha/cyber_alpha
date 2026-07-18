<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

/* ── Save / Create ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $articles = readJson('articles.json');
    $action   = $_POST['_action'] ?? '';

    if ($action === 'delete') {
        $id       = (int)$_POST['id'];
        $articles = array_values(array_filter($articles, fn($a) => $a['id'] !== $id));
        writeJson('articles.json', $articles);
        $msg = 'Article deleted.';
    } else {
        $item = [
            'id'       => (int)($_POST['id'] ?: 0),
            'title'    => trim($_POST['title']),
            'slug'     => trim($_POST['slug']) ?: strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($_POST['title']))),
            'category' => trim($_POST['category']),
            'status'   => $_POST['status'],
            'excerpt'  => trim($_POST['excerpt']),
            'date'     => $_POST['date'] ?: date('Y-m-d'),
            'views'    => (int)($_POST['views'] ?? 0),
            'tags'     => array_map('trim', explode(',', $_POST['tags'] ?? '')),
        ];

        if ($item['id'] === 0) {
            $item['id'] = nextId($articles);
            $articles[] = $item;
            $msg = 'Article created.';
        } else {
            foreach ($articles as &$a) {
                if ($a['id'] === $item['id']) { $a = $item; break; }
            }
            $msg = 'Article updated.';
        }
        writeJson('articles.json', $articles);
    }
}

$articles = readJson('articles.json');
$filter   = $_GET['status'] ?? '';
$search   = strtolower($_GET['q'] ?? '');

$filtered = $articles;
if ($filter) $filtered = array_filter($filtered, fn($a) => $a['status'] === $filter);
if ($search) $filtered = array_filter($filtered, fn($a) => str_contains(strtolower($a['title']), $search));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Articles — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>

<?php include __DIR__ . '/partials/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/articles</div>
    <div class="topbar-right">
      <a href="/admin/article-editor" class="btn btn-primary btn-sm">✍ Write New Article</a>
    </div>
  </div>

  <div class="content">

    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <!-- Toolbar -->
    <form method="GET" class="toolbar">
      <div class="search-box">
        <span class="icon">🔍</span>
        <input name="q" placeholder="Search articles…" value="<?= htmlspecialchars($search) ?>">
      </div>
      <select name="status" class="form-control" style="width:auto" onchange="this.form.submit()">
        <option value="">All Status</option>
        <option value="published" <?= $filter==='published'?'selected':'' ?>>Published</option>
        <option value="draft" <?= $filter==='draft'?'selected':'' ?>>Draft</option>
      </select>
      <button type="submit" class="btn btn-secondary btn-sm">Filter</button>
    </form>

    <!-- Table -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">All Articles</div>
        <span style="font-size:0.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($filtered) ?> article<?= count($filtered)!==1?'s':'' ?></span>
      </div>
      <?php if (empty($filtered)): ?>
        <div class="empty-state"><div class="icon">📝</div><p>No articles found.</p></div>
      <?php else: ?>
      <table>
        <thead>
          <tr><th>Title</th><th>Category</th><th>Date</th><th>Views</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($filtered as $a): ?>
          <tr>
            <td>
              <div style="font-weight:600;max-width:240px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                <?= htmlspecialchars($a['title']) ?>
              </div>
              <div style="font-size:0.7rem;color:var(--text-muted);font-family:var(--font-mono)">/<?= htmlspecialchars($a['slug']) ?></div>
            </td>
            <td><span class="badge badge-primary"><?= htmlspecialchars($a['category']) ?></span></td>
            <td style="font-family:var(--font-mono);font-size:0.8rem"><?= $a['date'] ?></td>
            <td style="font-family:var(--font-mono);font-size:0.8rem"><?= number_format($a['views']) ?></td>
            <td>
              <?php if ($a['status'] === 'published'): ?>
                <span class="badge badge-success">✓ live</span>
              <?php else: ?>
                <span class="badge badge-muted">draft</span>
              <?php endif; ?>
            </td>
            <td>
              <div class="actions">
                <a href="/admin/article-editor?id=<?= $a['id'] ?>" class="btn btn-primary btn-sm">✍ Write</a>
                <button onclick="editArticle(<?= htmlspecialchars(json_encode($a)) ?>)" class="btn btn-secondary btn-sm">⚙ Meta</button>
                <form method="POST" onsubmit="return confirm('Delete this article?')">
                  <input type="hidden" name="_action" value="delete">
                  <input type="hidden" name="id" value="<?= $a['id'] ?>">
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
<div class="modal-backdrop" id="articleModal">
  <div class="modal">
    <div class="modal-header">
      <div class="modal-title" id="modalTitle">// new_article</div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <form method="POST">
      <div class="modal-body">
        <input type="hidden" name="id" id="articleId" value="0">
        <div class="form-group">
          <label class="form-label">Title *</label>
          <input type="text" name="title" id="articleTitle" class="form-control" required placeholder="Article title…">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Slug (auto-generated)</label>
            <input type="text" name="slug" id="articleSlug" class="form-control" placeholder="url-slug">
          </div>
          <div class="form-group">
            <label class="form-label">Category</label>
            <input type="text" name="category" id="articleCategory" class="form-control" placeholder="Web Security, AI Security…">
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Excerpt</label>
          <textarea name="excerpt" id="articleExcerpt" class="form-control" rows="3" placeholder="Brief description…"></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label class="form-label">Publish Date</label>
            <input type="date" name="date" id="articleDate" class="form-control">
          </div>
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" id="articleStatus" class="form-control">
              <option value="published">Published</option>
              <option value="draft">Draft</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="form-label">Tags (comma separated)</label>
          <input type="text" name="tags" id="articleTags" class="form-control" placeholder="JWT, Authentication, Web Security">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="closeModal()" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">💾 Save Article</button>
      </div>
    </form>
  </div>
</div>

<?php include __DIR__ . '/partials/toast.php'; ?>

<script>
function openModal(data) {
  document.getElementById('articleId').value       = data?.id ?? 0;
  document.getElementById('articleTitle').value    = data?.title ?? '';
  document.getElementById('articleSlug').value     = data?.slug ?? '';
  document.getElementById('articleCategory').value = data?.category ?? '';
  document.getElementById('articleExcerpt').value  = data?.excerpt ?? '';
  document.getElementById('articleDate').value     = data?.date ?? new Date().toISOString().slice(0,10);
  document.getElementById('articleStatus').value   = data?.status ?? 'draft';
  document.getElementById('articleTags').value     = (data?.tags ?? []).join(', ');
  document.getElementById('modalTitle').textContent = data ? '// edit_article' : '// new_article';
  document.getElementById('articleModal').classList.add('open');
}
function editArticle(data) { openModal(data); }
function closeModal() { document.getElementById('articleModal').classList.remove('open'); }
<?php if (isset($_GET['new'])): ?>window.onload = () => openModal();<?php endif; ?>
</script>
</body>
</html>
