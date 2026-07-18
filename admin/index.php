<?php
require __DIR__ . '/auth.php';

if (isLoggedIn()) {
    header('Location: /admin/dashboard');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pw = $_POST['password'] ?? '';
    if (doLogin($pw)) {
        header('Location: /admin/dashboard');
        exit;
    }
    $error = 'Invalid password. Try again.';
}
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login — Cyber Alpha</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
<style>
.scanline { position: fixed; inset: 0; background: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(0,255,65,.015) 2px, rgba(0,255,65,.015) 4px); pointer-events: none; z-index: 0; }
</style>
</head>
<body>
<canvas id="matrix-bg"></canvas>
<div class="scanline"></div>

<div class="login-page">
  <div class="login-card">
    <div class="login-logo">
      <div class="brand">[ cyber_alpha ]</div>
      <div class="sub">// admin control panel</div>
    </div>

    <?php if ($error): ?>
      <div class="alert alert-danger">⚠ <?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="form-group">
        <label class="form-label">$ enter password_</label>
        <input type="password" name="password" class="form-control"
               placeholder="••••••••••••" autofocus autocomplete="current-password">
      </div>
      <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:12px">
        ▶ ACCESS SYSTEM
      </button>
    </form>

    <p class="login-hint" style="margin-top:20px">
      Default: CyberAlpha@2024 &nbsp;|&nbsp; Set ADMIN_PASSWORD env var to change
    </p>

    <div style="text-align:center;margin-top:24px">
      <a href="/" style="font-size:0.75rem;color:var(--text-muted);font-family:var(--font-mono)">← back to site</a>
    </div>
  </div>
</div>

<script>
const c = document.getElementById('matrix-bg');
const ctx = c.getContext('2d');
c.width = window.innerWidth; c.height = window.innerHeight;
const cols = Math.floor(c.width / 14);
const drops = Array(cols).fill(1);
const chars = 'アイウエオカキクケコ01ABCDEF!@#$%';
function draw() {
  ctx.fillStyle = 'rgba(10,10,15,.05)'; ctx.fillRect(0,0,c.width,c.height);
  ctx.fillStyle = '#00ff41'; ctx.font = '12px Fira Code';
  drops.forEach((y, i) => {
    ctx.fillText(chars[Math.floor(Math.random()*chars.length)], i*14, y*14);
    if (y*14 > c.height && Math.random() > .975) drops[i] = 0;
    drops[i]++;
  });
}
setInterval(draw, 50);
</script>
</body>
</html>
