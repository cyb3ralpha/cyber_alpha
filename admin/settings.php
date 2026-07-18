<?php
require __DIR__ . '/auth.php';
requireAuth();

$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = readJson('settings.json');
    $updated = array_merge($current, [
        'site_name'          => trim($_POST['site_name']),
        'tagline'            => trim($_POST['tagline']),
        'owner_name'         => trim($_POST['owner_name']),
        'owner_email'        => trim($_POST['owner_email']),
        'github'             => trim($_POST['github']),
        'linkedin'           => trim($_POST['linkedin']),
        'twitter'            => trim($_POST['twitter']),
        'discord'            => trim($_POST['discord']),
        'youtube'            => trim($_POST['youtube']),
        'available_for_hire' => isset($_POST['available_for_hire']),
        'hero_subtitle'      => trim($_POST['hero_subtitle']),
        'hero_description'   => trim($_POST['hero_description']),
        'stats_articles'     => trim($_POST['stats_articles']),
        'stats_projects'     => trim($_POST['stats_projects']),
        'stats_students'     => trim($_POST['stats_students']),
        'stats_ctf_wins'     => trim($_POST['stats_ctf_wins']),
        'stats_bug_bounties' => trim($_POST['stats_bug_bounties']),
    ]);
    writeJson('settings.json', $updated);
    $msg = 'Settings saved successfully.';
}

$s = readJson('settings.json');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Settings — Cyber Alpha Admin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/admin/css/admin.css">
</head>
<body>

<?php include __DIR__ . '/partials/sidebar.php'; ?>

<div class="main">
  <div class="topbar">
    <div class="page-title"><span>~/admin</span>/settings</div>
    <div class="topbar-right">
      <button form="settingsForm" type="submit" class="btn btn-primary btn-sm">💾 Save All</button>
    </div>
  </div>

  <div class="content">

    <?php if ($msg): ?>
      <div class="alert alert-success" style="margin-bottom:20px">✓ <?= htmlspecialchars($msg) ?></div>
    <?php endif; ?>

    <form method="POST" id="settingsForm">
      <div class="grid-2">

        <div>
          <!-- Site Identity -->
          <div class="card" style="margin-bottom:24px">
            <div class="card-header"><div class="card-title">Site Identity</div></div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Site Name</label>
                <input type="text" name="site_name" class="form-control" value="<?= htmlspecialchars($s['site_name'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label class="form-label">Tagline</label>
                <input type="text" name="tagline" class="form-control" value="<?= htmlspecialchars($s['tagline'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label class="form-label">Owner Name</label>
                <input type="text" name="owner_name" class="form-control" value="<?= htmlspecialchars($s['owner_name'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label class="form-label">Owner Email</label>
                <input type="email" name="owner_email" class="form-control" value="<?= htmlspecialchars($s['owner_email'] ?? '') ?>">
              </div>
              <div class="form-check">
                <label class="toggle">
                  <input type="checkbox" name="available_for_hire" <?= !empty($s['available_for_hire']) ? 'checked' : '' ?>>
                  <span class="toggle-slider"></span>
                </label>
                <span class="form-check-label">Available for hire / collaboration</span>
              </div>
            </div>
          </div>

          <!-- Hero Section -->
          <div class="card">
            <div class="card-header"><div class="card-title">Hero Section</div></div>
            <div class="card-body">
              <div class="form-group">
                <label class="form-label">Typing Subtitle (e.g. Cybersecurity_)</label>
                <input type="text" name="hero_subtitle" class="form-control" value="<?= htmlspecialchars($s['hero_subtitle'] ?? '') ?>">
              </div>
              <div class="form-group">
                <label class="form-label">Hero Description</label>
                <textarea name="hero_description" class="form-control" rows="4"><?= htmlspecialchars($s['hero_description'] ?? '') ?></textarea>
              </div>
            </div>
          </div>
        </div>

        <div>
          <!-- Social Links -->
          <div class="card" style="margin-bottom:24px">
            <div class="card-header"><div class="card-title">Social Links</div></div>
            <div class="card-body">
              <?php foreach (['github' => '🐙 GitHub', 'linkedin' => '💼 LinkedIn', 'twitter' => '🐦 Twitter', 'discord' => '💬 Discord', 'youtube' => '▶ YouTube'] as $key => $label): ?>
                <div class="form-group">
                  <label class="form-label"><?= $label ?></label>
                  <input type="url" name="<?= $key ?>" class="form-control" value="<?= htmlspecialchars($s[$key] ?? '') ?>" placeholder="https://…">
                </div>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Stats -->
          <div class="card">
            <div class="card-header"><div class="card-title">Homepage Stats</div></div>
            <div class="card-body">
              <?php
              $statFields = [
                'stats_articles'     => 'Articles Written',
                'stats_projects'     => 'Projects',
                'stats_students'     => 'Students Helped',
                'stats_ctf_wins'     => 'CTF Wins',
                'stats_bug_bounties' => 'Bug Bounties',
              ];
              foreach ($statFields as $key => $label):
              ?>
                <div class="form-group">
                  <label class="form-label"><?= $label ?></label>
                  <input type="text" name="<?= $key ?>" class="form-control" value="<?= htmlspecialchars($s[$key] ?? '') ?>" placeholder="150+">
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Password -->
      <div class="card" style="margin-top:0">
        <div class="card-header"><div class="card-title">Admin Password</div></div>
        <div class="card-body">
          <p style="font-size:.82rem;color:var(--text-muted);font-family:var(--font-mono);margin-bottom:12px">
            Set the <code style="color:var(--primary)">ADMIN_PASSWORD</code> environment variable in your Vercel project settings to change the admin password securely. The current default is <code style="color:var(--warning)">CyberAlpha@2024</code>.
          </p>
          <a href="https://vercel.com/dashboard" target="_blank" class="btn btn-secondary btn-sm">↗ Open Vercel Dashboard</a>
        </div>
      </div>

    </form>
  </div>
</div>

<?php include __DIR__ . '/partials/toast.php'; ?>
</body>
</html>
