<?php
$page = $page ?? 'home';
$title = $title ?? 'Cyber Alpha';
$description = $description ?? 'Personal platform of Abdullah Ismail — Cybersecurity Expert, AI Researcher & Software Developer.';
?>
<!DOCTYPE html>
<html lang="en" data-theme="green">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="<?= htmlspecialchars($description) ?>" />
<meta name="author" content="Abdullah Ismail — Cyber Alpha" />
<meta name="keywords" content="cybersecurity, ethical hacking, AI, pentesting, Abdullah Ismail, Cyber Alpha" />
<meta property="og:title" content="<?= htmlspecialchars($title) ?>" />
<meta property="og:description" content="<?= htmlspecialchars($description) ?>" />
<meta property="og:type" content="website" />
<meta name="twitter:card" content="summary_large_image" />
<title><?= htmlspecialchars($title) ?> | Cyber Alpha</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
<link rel="stylesheet" href="/css/main.css" />
<link rel="stylesheet" href="/css/terminal.css" />
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>⚡</text></svg>" />
</head>
<body>

<!-- Canvas backgrounds -->
<canvas id="matrixCanvas"></canvas>
<canvas id="particleCanvas"></canvas>

<!-- Reading progress bar -->
<div class="reading-progress"><div class="reading-progress-fill" id="readingProgress"></div></div>

<!-- NAVBAR -->
<nav class="navbar" id="navbar">
  <div class="navbar-inner">
    <a href="/" class="navbar-logo">
      <span class="logo-bracket">[</span>
      <span class="logo-text">cyber_alpha</span>
      <span class="logo-bracket">]</span>
      <span class="logo-cursor"></span>
    </a>
    <nav class="navbar-nav">
      <a href="/" class="nav-link <?= $page==='home' ? 'active' : '' ?>">~/home</a>
      <a href="/knowledge-hub" class="nav-link <?= $page==='knowledge-hub' ? 'active' : '' ?>">knowledge_hub</a>
      <a href="/learning-paths" class="nav-link <?= $page==='learning-paths' ? 'active' : '' ?>">learning_paths</a>
      <a href="/projects" class="nav-link <?= $page==='projects' ? 'active' : '' ?>">projects</a>
      <a href="/research" class="nav-link <?= $page==='research' ? 'active' : '' ?>">research</a>
      <a href="/talks" class="nav-link <?= $page==='talks' ? 'active' : '' ?>">talks</a>
      <a href="/portfolio" class="nav-link <?= $page==='portfolio' ? 'active' : '' ?>">portfolio</a>
      <a href="/contact" class="nav-link <?= $page==='contact' ? 'active' : '' ?>">contact</a>
      <a href="/terminal" class="nav-link <?= $page==='terminal' ? 'active' : '' ?>" style="color:var(--primary)">terminal_</a>
    </nav>
    <div class="navbar-right">
      <div class="theme-picker" title="Switch theme">
        <div class="theme-dot t-green" data-theme="green" title="Hacker Green"></div>
        <div class="theme-dot t-amber" data-theme="amber" title="Retro Amber"></div>
        <div class="theme-dot t-blue" data-theme="blue" title="Cyber Blue"></div>
        <div class="theme-dot t-purple" data-theme="purple" title="Dark Purple"></div>
        <div class="theme-dot t-red" data-theme="red" title="Alert Red"></div>
      </div>
      <a href="/contact" class="btn btn-outline btn-sm">hire_me()</a>
    </div>
    <div class="hamburger" id="hamburger">
      <span></span><span></span><span></span>
    </div>
  </div>
</nav>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
  <a href="/" class="nav-link">~/home</a>
  <a href="/knowledge-hub" class="nav-link">knowledge_hub</a>
  <a href="/learning-paths" class="nav-link">learning_paths</a>
  <a href="/projects" class="nav-link">projects</a>
  <a href="/research" class="nav-link">research</a>
  <a href="/talks" class="nav-link">talks</a>
  <a href="/portfolio" class="nav-link">portfolio</a>
  <a href="/terminal" class="nav-link">terminal_</a>
  <a href="/contact" class="nav-link">contact</a>
  <div class="theme-picker" style="padding:8px 12px;gap:10px">
    <div class="theme-dot t-green" data-theme="green"></div>
    <div class="theme-dot t-amber" data-theme="amber"></div>
    <div class="theme-dot t-blue" data-theme="blue"></div>
    <div class="theme-dot t-purple" data-theme="purple"></div>
    <div class="theme-dot t-red" data-theme="red"></div>
  </div>
</div>
