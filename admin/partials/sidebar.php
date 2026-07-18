<?php
$contacts = readJson('contacts.json');
$unread   = count(array_filter($contacts, fn($c) => !$c['read']));
$cur      = basename($_SERVER['PHP_SELF'], '.php');
?>
<aside class="sidebar">
  <div class="sidebar-logo">
    <div class="brand">⬡ cyber_alpha</div>
    <div class="sub">// admin panel v2.0</div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section">Overview</div>

    <a href="/admin/dashboard" class="nav-item <?= $cur==='dashboard'?'active':'' ?>">
      <span class="icon">⊞</span> Dashboard
    </a>

    <div class="nav-section">Content</div>

    <a href="/admin/articles" class="nav-item <?= in_array($cur,['articles','article-editor'])?'active':'' ?>">
      <span class="icon">📝</span> Articles
    </a>
    <a href="/admin/projects" class="nav-item <?= $cur==='projects'?'active':'' ?>">
      <span class="icon">🚀</span> Projects
    </a>
    <a href="/admin/talks" class="nav-item <?= $cur==='talks'?'active':'' ?>">
      <span class="icon">🎙</span> Talks & Events
    </a>
    <a href="/admin/research" class="nav-item <?= $cur==='research'?'active':'' ?>">
      <span class="icon">🔬</span> Research
    </a>

    <div class="nav-section">Learning</div>

    <a href="/admin/learning-paths" class="nav-item <?= $cur==='learning-paths'?'active':'' ?>">
      <span class="icon">🗺</span> Learning Paths
    </a>
    <a href="/admin/resources" class="nav-item <?= $cur==='resources'?'active':'' ?>">
      <span class="icon">📚</span> Resources
    </a>

    <div class="nav-section">Inbox</div>

    <a href="/admin/contacts" class="nav-item <?= $cur==='contacts'?'active':'' ?>">
      <span class="icon">✉</span> Messages
      <?php if ($unread): ?>
        <span class="badge"><?= $unread ?></span>
      <?php endif; ?>
    </a>

    <div class="nav-section">System</div>

    <a href="/admin/settings" class="nav-item <?= $cur==='settings'?'active':'' ?>">
      <span class="icon">⚙</span> Settings
    </a>
    <a href="/" target="_blank" class="nav-item">
      <span class="icon">↗</span> View Site
    </a>
  </nav>

  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="user-avatar">CA</div>
      <div class="user-info">
        <div class="name">Abdullah Ismail</div>
        <div class="role">// root@cyberalpha</div>
      </div>
      <a href="/admin/logout" class="logout-btn" title="Logout">⏻</a>
    </div>
  </div>
</aside>
