<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contacts = readJson('contacts.json');
    $action   = $_POST['_action'] ?? '';
    $id       = (int)$_POST['id'];

    if ($action === 'delete') {
        $contacts = array_values(array_filter($contacts, fn($c) => $c['id'] !== $id));
        writeJson('contacts.json', $contacts);
        $msg = 'Message deleted.';
    } elseif ($action === 'read') {
        foreach ($contacts as &$c) {
            if ($c['id'] === $id) { $c['read'] = true; break; }
        }
        writeJson('contacts.json', $contacts);
    } elseif ($action === 'read_all') {
        foreach ($contacts as &$c) { $c['read'] = true; }
        writeJson('contacts.json', $contacts);
        $msg = 'All messages marked as read.';
    }
}

$contacts = readJson('contacts.json');
$unread   = count(array_filter($contacts, fn($c) => !$c['read']));
$open     = isset($_GET['open']) ? (int)$_GET['open'] : 0;
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Messages — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>

<?php include __DIR__ . '/partials/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/contacts <?php if ($unread): ?><span class="badge badge-danger" style="font-size:.7rem;margin-left:8px"><?= $unread ?> new</span><?php endif; ?></div>
    <div class="topbar-right">
      <?php if ($unread): ?>
        <form method="POST">
          <input type="hidden" name="_action" value="read_all">
          <button class="btn btn-secondary btn-sm">✓ Mark All Read</button>
        </form>
      <?php endif; ?>
    </div>
  </div>

  <div class="content">

    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <?php if (empty($contacts)): ?>
      <div class="card"><div class="empty-state"><div class="icon">📭</div><p>No messages yet.</p></div></div>
    <?php else: ?>

    <div class="card">
      <div class="card-header">
        <div class="card-title">All Messages</div>
        <span style="font-size:.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= count($contacts) ?> total</span>
      </div>
      <table>
        <thead>
          <tr><th>From</th><th>Subject</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
        <?php foreach ($contacts as $c): ?>
          <tr style="<?= !$c['read'] ? 'background:rgba(0,255,65,.03)' : '' ?>">
            <td>
              <div style="font-weight:<?= !$c['read'] ? '700' : '400' ?>"><?= htmlspecialchars($c['name']) ?></div>
              <div style="font-size:.72rem;color:var(--text-muted)"><?= htmlspecialchars($c['email']) ?></div>
            </td>
            <td style="font-weight:<?= !$c['read'] ? '600' : '400' ?>"><?= htmlspecialchars($c['subject']) ?></td>
            <td style="font-family:var(--font-mono);font-size:.78rem"><?= $c['date'] ?></td>
            <td>
              <?= $c['read']
                ? '<span class="badge badge-muted">read</span>'
                : '<span class="badge badge-warning">● unread</span>' ?>
            </td>
            <td>
              <div class="actions">
                <button onclick="toggleMsg(<?= $c['id'] ?>)" class="btn btn-secondary btn-sm">👁 View</button>
                <?php if (!$c['read']): ?>
                  <form method="POST" style="display:inline">
                    <input type="hidden" name="_action" value="read">
                    <input type="hidden" name="id" value="<?= $c['id'] ?>">
                    <button class="btn btn-secondary btn-sm">✓</button>
                  </form>
                <?php endif; ?>
                <form method="POST" onsubmit="return confirm('Delete this message?')">
                  <input type="hidden" name="_action" value="delete">
                  <input type="hidden" name="id" value="<?= $c['id'] ?>">
                  <button class="btn btn-danger btn-sm">✕</button>
                </form>
              </div>
              <!-- Message body -->
              <div class="msg-detail" id="msg-<?= $c['id'] ?>">
                <p style="font-size:.85rem;line-height:1.7;color:var(--text)"><?= nl2br(htmlspecialchars($c['message'])) ?></p>
                <div style="margin-top:12px;display:flex;gap:8px">
                  <a href="mailto:<?= htmlspecialchars($c['email']) ?>?subject=Re: <?= urlencode($c['subject']) ?>"
                     class="btn btn-primary btn-sm">✉ Reply</a>
                  <a href="mailto:<?= htmlspecialchars($c['email']) ?>"
                     class="btn btn-secondary btn-sm"><?= htmlspecialchars($c['email']) ?></a>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

  </div>
</div>

<?php include __DIR__ . '/partials/toast.php'; ?>

<script>
function toggleMsg(id) {
  const el = document.getElementById('msg-' + id);
  el.classList.toggle('open');
}
<?php if ($open): ?>
document.addEventListener('DOMContentLoaded', () => {
  const el = document.getElementById('msg-<?= $open ?>');
  if (el) { el.classList.add('open'); el.scrollIntoView({behavior:'smooth',block:'center'}); }
});
<?php endif; ?>
</script>
</body>
</html>
