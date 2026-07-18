<?php
require __DIR__ . '/auth.php';
requireAuth();

$articles = readJson('articles.json');
$projects = readJson('projects.json');
$contacts = readJson('contacts.json');
$settings = readJson('settings.json');

$totalViews   = array_sum(array_column($articles, 'views'));
$unread       = count(array_filter($contacts, fn($c) => !$c['read']));
$published    = count(array_filter($articles, fn($a) => $a['status'] === 'published'));
$drafts       = count(array_filter($articles, fn($a) => $a['status'] === 'draft'));
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Dashboard — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>

<?php include __DIR__ . '/partials/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/dashboard</div>
    <div class="topbar-right">
      <a href="/" target="_blank" class="btn btn-secondary btn-sm">↗ View Site</a>
      <a href="/admin/articles?new=1" class="btn btn-primary btn-sm">+ New Article</a>
    </div>
  </div>

  <div class="content">

    <!-- Stats -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon">📝</div>
        <div class="stat-value"><?= $published ?></div>
        <div class="stat-label">Published Articles</div>
        <div class="stat-change">↑ <?= $drafts ?> draft<?= $drafts !== 1 ? 's' : '' ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">🚀</div>
        <div class="stat-value"><?= count($projects) ?></div>
        <div class="stat-label">Active Projects</div>
        <div class="stat-change">↑ all on GitHub</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">👁</div>
        <div class="stat-value"><?= number_format($totalViews) ?></div>
        <div class="stat-label">Total Article Views</div>
        <div class="stat-change">↑ across all posts</div>
      </div>
      <div class="stat-card">
        <div class="stat-icon">✉️</div>
        <div class="stat-value"><?= count($contacts) ?></div>
        <div class="stat-label">Messages</div>
        <?php if ($unread): ?>
          <div class="stat-change" style="color:var(--warning)">⚠ <?= $unread ?> unread</div>
        <?php else: ?>
          <div class="stat-change">✓ all read</div>
        <?php endif; ?>
      </div>
    </div>

    <div class="grid-2">

      <!-- Recent Articles -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Recent Articles</div>
          <a href="/admin/articles" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <table>
          <thead><tr><th>Title</th><th>Status</th><th>Views</th></tr></thead>
          <tbody>
          <?php foreach (array_slice($articles, 0, 5) as $a): ?>
            <tr>
              <td style="max-width:180px">
                <div style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;font-size:0.8rem">
                  <?= htmlspecialchars($a['title']) ?>
                </div>
                <div style="font-size:0.7rem;color:var(--text-muted);font-family:var(--font-mono)"><?= $a['date'] ?></div>
              </td>
              <td>
                <?php if ($a['status'] === 'published'): ?>
                  <span class="badge badge-success">✓ live</span>
                <?php else: ?>
                  <span class="badge badge-muted">draft</span>
                <?php endif; ?>
              </td>
              <td style="font-family:var(--font-mono);font-size:0.8rem"><?= number_format($a['views']) ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <!-- Recent Messages -->
      <div class="card">
        <div class="card-header">
          <div class="card-title">Recent Messages</div>
          <a href="/admin/contacts" class="btn btn-secondary btn-sm">View All</a>
        </div>
        <div class="card-body" style="padding:0">
          <?php foreach (array_slice($contacts, 0, 4) as $c): ?>
            <div class="activity-item" style="padding:14px 24px">
              <div class="activity-dot <?= !$c['read'] ? '' : 'cyan' ?>"></div>
              <div class="activity-text">
                <strong><?= htmlspecialchars($c['name']) ?></strong>
                — <?= htmlspecialchars($c['subject']) ?>
                <?php if (!$c['read']): ?><span class="badge badge-warning" style="margin-left:6px;font-size:.62rem">NEW</span><?php endif; ?>
                <span class="time"><?= $c['date'] ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

    </div>

    <!-- Projects Quick View -->
    <div class="card">
      <div class="card-header">
        <div class="card-title">Projects Overview</div>
        <a href="/admin/projects" class="btn btn-secondary btn-sm">Manage</a>
      </div>
      <table>
        <thead>
          <tr><th>Project</th><th>Language</th><th>Stars</th><th>Forks</th><th>Status</th></tr>
        </thead>
        <tbody>
        <?php foreach ($projects as $p): ?>
          <tr>
            <td>
              <div style="font-weight:600"><?= htmlspecialchars($p['name']) ?></div>
              <div style="font-size:0.72rem;color:var(--text-muted)"><?= htmlspecialchars(substr($p['description'], 0, 60)) ?>…</div>
            </td>
            <td><span class="badge badge-muted"><?= htmlspecialchars($p['language']) ?></span></td>
            <td style="font-family:var(--font-mono)">⭐ <?= number_format($p['stars']) ?></td>
            <td style="font-family:var(--font-mono)">🍴 <?= number_format($p['forks']) ?></td>
            <td><span class="badge badge-success">● <?= $p['status'] ?></span></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<?php include __DIR__ . '/partials/toast.php'; ?>
</body>
</html>
