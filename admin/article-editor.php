<?php
require __DIR__ . '/auth.php';
requireAuth();

$articles = readJson('articles.json');
$id       = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$article  = null;
$msg      = '';

if ($id) {
    foreach ($articles as $a) {
        if ($a['id'] === $id) { $article = $a; break; }
    }
}

/* ── Save ── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = [
        'id'       => (int)$_POST['id'],
        'title'    => trim($_POST['title']),
        'slug'     => trim($_POST['slug']) ?: strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($_POST['title']))),
        'category' => trim($_POST['category']),
        'status'   => $_POST['status'],
        'excerpt'  => trim($_POST['excerpt']),
        'content'  => $_POST['content'] ?? '',
        'date'     => $_POST['date'] ?: date('Y-m-d'),
        'views'    => (int)($_POST['views'] ?? 0),
        'tags'     => array_map('trim', explode(',', $_POST['tags'] ?? '')),
    ];

    if ($item['id'] === 0) {
        $item['id'] = nextId($articles);
        $articles[] = $item;
        $msg = 'Article created!';
        $id  = $item['id'];
        $article = $item;
    } else {
        foreach ($articles as &$a) {
            if ($a['id'] === $item['id']) { $a = $item; $article = $item; break; }
        }
        $msg = 'Article saved!';
    }
    writeJson('articles.json', $articles);
}

$isNew = !$article;
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $isNew ? 'New Article' : htmlspecialchars($article['title']) ?> — Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
<!-- Quill.js -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<style>
/* Override Quill theme to match dark admin */
.ql-toolbar.ql-snow {
  background: var(--bg3);
  border: 1px solid var(--border) !important;
  border-bottom: none !important;
  border-radius: 8px 8px 0 0;
  padding: 10px 12px;
  flex-wrap: wrap;
  gap: 4px;
}
.ql-container.ql-snow {
  background: var(--bg3);
  border: 1px solid var(--border) !important;
  border-top: none !important;
  border-radius: 0 0 8px 8px;
  font-family: var(--font-body);
  font-size: 1rem;
  min-height: 420px;
}
.ql-editor {
  color: var(--text);
  min-height: 420px;
  line-height: 1.8;
  padding: 20px 24px;
}
.ql-editor.ql-blank::before { color: var(--text-muted); font-style: italic; }
.ql-toolbar .ql-stroke { stroke: var(--text-dim) !important; }
.ql-toolbar .ql-fill  { fill:   var(--text-dim) !important; }
.ql-toolbar .ql-picker-label { color: var(--text-dim) !important; }
.ql-toolbar button:hover .ql-stroke,
.ql-toolbar .ql-active .ql-stroke { stroke: var(--primary) !important; }
.ql-toolbar button:hover .ql-fill,
.ql-toolbar .ql-active .ql-fill  { fill:   var(--primary) !important; }
.ql-toolbar .ql-picker-label:hover { color: var(--primary) !important; }
.ql-toolbar .ql-picker-options {
  background: var(--bg2) !important;
  border: 1px solid var(--border) !important;
  border-radius: 6px;
}
.ql-toolbar .ql-picker-item { color: var(--text-dim) !important; }
.ql-toolbar .ql-picker-item:hover { color: var(--primary) !important; }
.ql-editor h1, .ql-editor h2, .ql-editor h3 { color: var(--primary); font-family: var(--font-mono); margin: 1.2em 0 .5em; }
.ql-editor a { color: var(--secondary); }
.ql-editor code, .ql-editor pre { background: var(--bg2) !important; color: var(--primary); border-radius: 4px; }
.ql-editor blockquote { border-left: 3px solid var(--primary); padding-left: 16px; color: var(--text-dim); margin: 1em 0; }

.editor-layout { display: grid; grid-template-columns: 1fr 320px; gap: 24px; }
.editor-sidebar { display: flex; flex-direction: column; gap: 16px; }
.meta-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: var(--radius); padding: 20px; }
.meta-card h4 { font-family: var(--font-mono); color: var(--secondary); font-size: .8rem; margin-bottom: 14px; padding-bottom: 8px; border-bottom: 1px solid var(--border); }
.meta-card h4::before { content: '> '; color: var(--text-muted); }

.word-count { font-family: var(--font-mono); font-size: .72rem; color: var(--text-muted); text-align: right; margin-top: 6px; }
</style>
</head>
<body>

<?php include __DIR__ . '/partials/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div class="page-title">
      <span>~/admin/articles</span>/<?= $isNew ? 'new' : 'edit' ?>
    </div>
    <div class="topbar-right">
      <a href="/admin/articles" class="btn btn-secondary btn-sm">← Back</a>
      <button form="articleForm" type="submit" class="btn btn-primary btn-sm">
        <?= $article && $article['status']==='published' ? '🌐 Publish' : '💾 Save Draft' ?>
      </button>
    </div>
  </div>

  <?php if ($msg): ?>
    <div class="alert alert-success" style="margin:16px 32px 0">✓ <?= htmlspecialchars($msg) ?></div>
  <?php endif; ?>

  <form method="POST" id="articleForm" onsubmit="syncEditor()">
  <div class="content">
    <div class="editor-layout">

      <!-- LEFT: Editor -->
      <div>
        <div class="form-group">
          <input type="text" name="title" id="titleInput" class="form-control"
                 placeholder="Article title…"
                 value="<?= htmlspecialchars($article['title'] ?? '') ?>"
                 style="font-size:1.4rem;font-weight:700;font-family:var(--font-mono);padding:14px 18px"
                 required>
        </div>

        <div class="form-group">
          <label class="form-label">Content</label>
          <div id="quillEditor"><?= $article['content'] ?? '' ?></div>
          <textarea name="content" id="hiddenContent" style="display:none"><?= htmlspecialchars($article['content'] ?? '') ?></textarea>
          <div class="word-count"><span id="wordCount">0</span> words &nbsp;|&nbsp; <span id="charCount">0</span> chars</div>
        </div>
      </div>

      <!-- RIGHT: Meta -->
      <div class="editor-sidebar">

        <div class="meta-card">
          <h4>Publish Settings</h4>
          <input type="hidden" name="id" value="<?= $article['id'] ?? 0 ?>">
          <input type="hidden" name="views" value="<?= $article['views'] ?? 0 ?>">
          <div class="form-group">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" id="statusSelect">
              <option value="draft" <?= ($article['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft</option>
              <option value="published" <?= ($article['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Publish Date</label>
            <input type="date" name="date" class="form-control"
                   value="<?= $article['date'] ?? date('Y-m-d') ?>">
          </div>
          <div style="display:flex;gap:8px">
            <button type="submit" onclick="setStatus('published')" class="btn btn-primary" style="flex:1;justify-content:center">🌐 Publish</button>
            <button type="submit" onclick="setStatus('draft')" class="btn btn-secondary" style="flex:1;justify-content:center">📝 Draft</button>
          </div>
        </div>

        <div class="meta-card">
          <h4>Article Details</h4>
          <div class="form-group">
            <label class="form-label">Excerpt</label>
            <textarea name="excerpt" class="form-control" rows="3" placeholder="Short description for cards/SEO…"><?= htmlspecialchars($article['excerpt'] ?? '') ?></textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Category</label>
            <input type="text" name="category" class="form-control"
                   placeholder="Web Security, AI Security…"
                   value="<?= htmlspecialchars($article['category'] ?? '') ?>">
          </div>
          <div class="form-group">
            <label class="form-label">Tags <span style="color:var(--text-muted)">(comma separated)</span></label>
            <input type="text" name="tags" class="form-control"
                   placeholder="JWT, XSS, Red Team"
                   value="<?= htmlspecialchars(implode(', ', $article['tags'] ?? [])) ?>">
          </div>
          <div class="form-group">
            <label class="form-label">URL Slug</label>
            <input type="text" name="slug" class="form-control"
                   placeholder="auto-generated from title"
                   value="<?= htmlspecialchars($article['slug'] ?? '') ?>">
          </div>
        </div>

        <?php if (!$isNew): ?>
        <div class="meta-card">
          <h4>Stats</h4>
          <div style="font-family:var(--font-mono);font-size:.85rem">
            <div style="display:flex;justify-content:space-between;margin-bottom:8px">
              <span style="color:var(--text-muted)">Views</span>
              <span style="color:var(--primary)"><?= number_format($article['views'] ?? 0) ?></span>
            </div>
            <div style="display:flex;justify-content:space-between;margin-bottom:8px">
              <span style="color:var(--text-muted)">Status</span>
              <span><?= $article['status'] ?? 'draft' ?></span>
            </div>
            <div style="display:flex;justify-content:space-between">
              <span style="color:var(--text-muted)">Published</span>
              <span><?= $article['date'] ?? '—' ?></span>
            </div>
          </div>
        </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
  </form>
</div>

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<script>
const quill = new Quill('#quillEditor', {
  theme: 'snow',
  placeholder: 'Start writing your article here…\n\nUse the toolbar above for headings, bold, italic, code blocks, links, and more.',
  modules: {
    toolbar: [
      [{ header: [1, 2, 3, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      ['blockquote', 'code-block'],
      [{ list: 'ordered' }, { list: 'bullet' }],
      ['link', 'image'],
      [{ color: [] }, { background: [] }],
      [{ align: [] }],
      ['clean']
    ]
  }
});

/* Set initial content */
const saved = document.getElementById('quillEditor').innerHTML;

/* Word / char count */
function updateCount() {
  const text = quill.getText().trim();
  const words = text ? text.split(/\s+/).length : 0;
  document.getElementById('wordCount').textContent = words.toLocaleString();
  document.getElementById('charCount').textContent = text.length.toLocaleString();
}
quill.on('text-change', updateCount);
updateCount();

/* Sync editor → hidden textarea before form submit */
function syncEditor() {
  document.getElementById('hiddenContent').value = quill.root.innerHTML;
}

/* Publish / Draft buttons */
function setStatus(s) {
  document.getElementById('statusSelect').value = s;
  syncEditor();
}

/* Auto-generate slug from title */
document.getElementById('titleInput').addEventListener('blur', function() {
  const slugInput = document.querySelector('input[name="slug"]');
  if (!slugInput.value) {
    slugInput.value = this.value.toLowerCase()
      .replace(/[^a-z0-9\s-]/g, '')
      .replace(/\s+/g, '-')
      .replace(/-+/g, '-')
      .trim();
  }
});

/* Update publish button label based on status */
document.getElementById('statusSelect').addEventListener('change', function() {
  const btn = document.querySelector('[form="articleForm"].btn-primary');
  btn.textContent = this.value === 'published' ? '🌐 Publish' : '💾 Save Draft';
});
</script>
</body>
</html>
