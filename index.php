<?php
$page = 'home';
$title = 'Home';
$description = 'Abdullah Ismail — Cyber Alpha. Cybersecurity expert, AI researcher, and software developer. Knowledge hub, learning paths, projects and more.';
require __DIR__ . '/includes/header.php';
?>

<!-- HERO -->
<section class="hero">
  <div class="container">
    <div class="hero-inner">
      <div class="hero-content reveal">
        <div class="hero-label">
          <span class="hero-label-dot"></span>
          <span>Available for hire &amp; collaboration</span>
        </div>
        <div class="hero-greeting">$ whoami</div>
        <h1 class="hero-title glitch" data-text="Cyber Alpha">Cyber Alpha</h1>
        <div class="hero-subtitle">
          <span style="color:var(--text-muted)">// </span>
          <span id="heroTyper" style="color:var(--primary)"></span><span class="cursor-blink">_</span>
        </div>
        <p class="hero-bio">
          Abdullah Ismail — cybersecurity researcher, AI engineer, and educator. I break things to understand them, then teach others how to defend them. Turning complexity into clarity since 2017.
        </p>
        <div class="hero-actions">
          <a href="/projects" class="btn btn-primary">./explore_projects</a>
          <a href="/knowledge-hub" class="btn btn-outline">cat knowledge_hub.md</a>
          <a href="/terminal" class="btn btn-ghost">open terminal_</a>
        </div>
        <div class="hero-social">
          <a href="https://github.com/cyberalpha" class="social-link" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
          <a href="https://linkedin.com/in/cyberalpha" class="social-link" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
          <a href="https://twitter.com/CyberAlpha_dev" class="social-link" target="_blank" title="Twitter/X"><i class="fab fa-twitter"></i></a>
          <a href="https://discord.gg/cyberalpha" class="social-link" target="_blank" title="Discord"><i class="fab fa-discord"></i></a>
          <a href="https://youtube.com/@cyberalpha" class="social-link" target="_blank" title="YouTube"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <div class="hero-avatar-wrap reveal">
        <div class="avatar-container">
          <div class="avatar-orbit orbit-1"></div>
          <div class="avatar-orbit orbit-2"></div>
          <div class="avatar-orbit orbit-3"></div>
          <div class="avatar-glow-ring"></div>
          <div class="avatar-circle">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="160" height="160">
              <circle cx="100" cy="70" r="45" fill="var(--primary)" opacity="0.15"/>
              <circle cx="100" cy="68" r="32" fill="var(--primary)" opacity="0.25"/>
              <text x="100" y="85" text-anchor="middle" font-size="52" fill="var(--primary)">👤</text>
              <text x="100" y="150" text-anchor="middle" font-family="Fira Code,monospace" font-size="11" fill="var(--primary)" opacity="0.9">CYBER_ALPHA</text>
              <text x="100" y="165" text-anchor="middle" font-family="Fira Code,monospace" font-size="8" fill="var(--text-muted)">Abdullah Ismail</text>
            </svg>
          </div>
          <div class="avatar-badge">
            <span style="color:var(--primary)">●</span> Online
          </div>
        </div>
        <!-- Terminal preview card -->
        <div class="hero-term-preview card" style="margin-top:24px;font-size:0.78rem">
          <div style="color:var(--text-muted);margin-bottom:8px">// quick_stats.json</div>
          <div><span style="color:var(--secondary)">articles:</span> <span style="color:var(--primary)" data-count="150">0</span>+</div>
          <div><span style="color:var(--secondary)">projects:</span> <span style="color:var(--primary)" data-count="40">0</span>+</div>
          <div><span style="color:var(--secondary)">students_helped:</span> <span style="color:var(--primary)" data-count="12000">0</span>+</div>
          <div><span style="color:var(--secondary)">ctf_wins:</span> <span style="color:var(--primary)" data-count="87">0</span></div>
          <div><span style="color:var(--secondary)">bug_bounties:</span> <span style="color:var(--primary)" data-count="34">0</span></div>
          <div style="margin-top:8px;color:var(--text-muted)">status: <span style="color:#00ff41">● active</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STATS BANNER -->
<section class="stats-banner">
  <div class="container">
    <div class="stats-grid">
      <div class="stat-item reveal">
        <div class="stat-number" data-count="150">0</div>
        <div class="stat-label">Articles Written</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number" data-count="40">0</div>
        <div class="stat-label">Open Source Projects</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number" data-count="12000">0</div>
        <div class="stat-label">Students Helped</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number" data-count="87">0</div>
        <div class="stat-label">CTF Wins</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number" data-count="34">0</div>
        <div class="stat-label">Bug Bounties</div>
      </div>
      <div class="stat-item reveal">
        <div class="stat-number" data-count="6">0</div>
        <div class="stat-label">Years Active</div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT I DO -->
<section class="section">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// what_i_do</div>
      <h2 class="section-title">Expertise &amp; Focus</h2>
      <p class="section-subtitle">Bridging the gap between offensive security knowledge and defensive real-world application.</p>
    </div>
    <div class="grid grid-3">
      <div class="card card-hover reveal" style="border-color:var(--primary)">
        <div class="card-icon"><i class="fa fa-shield-halved" style="color:var(--primary)"></i></div>
        <h3 class="card-title">Cybersecurity</h3>
        <p class="card-desc">Penetration testing, vulnerability research, CTF competitions, bug bounty hunting, and security consulting. I break systems ethically to make them stronger.</p>
        <div class="tags">
          <span class="tag">Pentesting</span><span class="tag">OSINT</span><span class="tag">Web Security</span><span class="tag">DFIR</span>
        </div>
      </div>
      <div class="card card-hover reveal" style="border-color:var(--secondary)">
        <div class="card-icon"><i class="fa fa-brain" style="color:var(--secondary)"></i></div>
        <h3 class="card-title">AI &amp; Machine Learning</h3>
        <p class="card-desc">Applying machine learning to cybersecurity — threat detection, anomaly analysis, adversarial AI, and building intelligent security tooling.</p>
        <div class="tags">
          <span class="tag">Python</span><span class="tag">TensorFlow</span><span class="tag">LLMs</span><span class="tag">MLSecOps</span>
        </div>
      </div>
      <div class="card card-hover reveal" style="border-color:var(--accent)">
        <div class="card-icon"><i class="fa fa-graduation-cap" style="color:var(--accent)"></i></div>
        <h3 class="card-title">Education</h3>
        <p class="card-desc">Creating structured learning paths, writing in-depth articles, giving talks, and mentoring the next generation of security professionals worldwide.</p>
        <div class="tags">
          <span class="tag">Courses</span><span class="tag">Mentorship</span><span class="tag">Talks</span><span class="tag">Writing</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FEATURED ARTICLES -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// latest_articles</div>
      <h2 class="section-title">From the Knowledge Hub</h2>
      <p class="section-subtitle">Deep dives into security, AI, and the tools that matter.</p>
    </div>
    <div class="grid grid-3">
      <?php
      $articles = [
        ['title'=>'Advanced Web Cache Poisoning in 2026','cat'=>'Web Security','time'=>'12 min read','date'=>'Jul 2026','icon'=>'fa-globe','color'=>'var(--primary)'],
        ['title'=>'Building an AI-Powered Threat Intelligence Platform','cat'=>'AI Security','time'=>'18 min read','date'=>'Jun 2026','icon'=>'fa-robot','color'=>'var(--secondary)'],
        ['title'=>'OSINT Masterclass: Tracking Digital Footprints','cat'=>'OSINT','time'=>'15 min read','date'=>'Jun 2026','icon'=>'fa-magnifying-glass','color'=>'var(--accent)'],
        ['title'=>'Red Team vs Blue Team: A 2026 Perspective','cat'=>'Red Team','time'=>'10 min read','date'=>'May 2026','icon'=>'fa-users','color'=>'var(--primary)'],
        ['title'=>'Zero-Day Research: From Discovery to Disclosure','cat'=>'Vulnerability Research','time'=>'20 min read','date'=>'May 2026','icon'=>'fa-bug','color'=>'var(--secondary)'],
        ['title'=>'Malware Reverse Engineering with Ghidra','cat'=>'Malware Analysis','time'=>'25 min read','date'=>'Apr 2026','icon'=>'fa-code','color'=>'var(--accent)'],
      ];
      foreach($articles as $a): ?>
      <article class="card article-card reveal">
        <div class="article-meta">
          <span class="tag"><?= $a['cat'] ?></span>
          <span style="color:var(--text-muted);font-size:0.78rem"><?= $a['date'] ?></span>
        </div>
        <h3 class="article-title">
          <i class="fa <?= $a['icon'] ?>" style="color:<?= $a['color'] ?>;margin-right:8px"></i>
          <?= $a['title'] ?>
        </h3>
        <div class="article-footer">
          <span style="color:var(--text-muted);font-size:0.8rem"><i class="fa fa-clock" style="margin-right:4px"></i><?= $a['time'] ?></span>
          <a href="/knowledge-hub" class="btn btn-ghost btn-sm">Read →</a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:40px">
      <a href="/knowledge-hub" class="btn btn-outline">cat all_articles | grep -v boring</a>
    </div>
  </div>
</section>

<!-- LEARNING PATHS TEASER -->
<section class="section">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// learning_paths</div>
      <h2 class="section-title">Structured Learning</h2>
      <p class="section-subtitle">Curated roadmaps from zero to hero in cybersecurity and AI.</p>
    </div>
    <div class="grid grid-2">
      <?php
      $paths = [
        ['title'=>'Ethical Hacking Bootcamp','level'=>'Beginner → Advanced','lessons'=>42,'time'=>'120h','icon'=>'fa-terminal','color'=>'var(--primary)','desc'=>'Complete roadmap from Linux basics to advanced exploitation techniques.'],
        ['title'=>'Web Application Security','level'=>'Intermediate','lessons'=>28,'time'=>'80h','icon'=>'fa-globe','color'=>'var(--secondary)','desc'=>'OWASP Top 10, Burp Suite mastery, and real-world bug hunting techniques.'],
        ['title'=>'AI for Security Professionals','level'=>'Intermediate','lessons'=>35,'time'=>'100h','icon'=>'fa-robot','color'=>'var(--accent)','desc'=>'Machine learning models for threat detection, anomaly analysis, and more.'],
        ['title'=>'Malware Analysis & Reverse Engineering','level'=>'Advanced','lessons'=>22,'time'=>'90h','icon'=>'fa-bug','color'=>'var(--primary)','desc'=>'Static and dynamic analysis, assembly, and defeating obfuscation.'],
      ];
      foreach($paths as $p): ?>
      <div class="card card-hover reveal" style="display:flex;gap:20px;align-items:flex-start">
        <div class="card-icon" style="flex-shrink:0;width:48px;height:48px;font-size:1.4rem">
          <i class="fa <?= $p['icon'] ?>" style="color:<?= $p['color'] ?>"></i>
        </div>
        <div>
          <h3 class="card-title" style="margin-bottom:6px"><?= $p['title'] ?></h3>
          <p class="card-desc" style="margin-bottom:12px"><?= $p['desc'] ?></p>
          <div class="tags">
            <span class="tag"><?= $p['level'] ?></span>
            <span class="tag"><?= $p['lessons'] ?> lessons</span>
            <span class="tag"><?= $p['time'] ?></span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:40px">
      <a href="/learning-paths" class="btn btn-primary">./start_learning.sh</a>
    </div>
  </div>
</section>

<!-- FEATURED PROJECTS -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// featured_projects</div>
      <h2 class="section-title">Open Source Work</h2>
    </div>
    <div class="grid grid-3">
      <?php
      $projects = [
        ['name'=>'CyberShield','lang'=>'Python','desc'=>'Advanced ML-powered network intrusion detection system with real-time alerting.','stars'=>'2.3k','icon'=>'fa-shield','color'=>'var(--primary)'],
        ['name'=>'VulnScan Pro','lang'=>'Python/Go','desc'=>'Automated web vulnerability scanner with OWASP coverage and report generation.','stars'=>'1.8k','icon'=>'fa-magnifying-glass','color'=>'var(--secondary)'],
        ['name'=>'AI ThreatHunter','lang'=>'Python/AI','desc'=>'ML-powered threat intelligence aggregator with natural language querying.','stars'=>'967','icon'=>'fa-robot','color'=>'var(--accent)'],
      ];
      foreach($projects as $proj): ?>
      <div class="card card-hover project-card reveal">
        <div class="project-header">
          <i class="fa <?= $proj['icon'] ?>" style="color:<?= $proj['color'] ?>;font-size:1.4rem"></i>
          <div class="project-stars"><i class="fa fa-star" style="color:#ffb000"></i> <?= $proj['stars'] ?></div>
        </div>
        <h3 class="project-name"><?= $proj['name'] ?></h3>
        <p class="project-desc"><?= $proj['desc'] ?></p>
        <div class="tags">
          <span class="tag"><?= $proj['lang'] ?></span>
          <span class="tag">Open Source</span>
        </div>
        <div class="project-links">
          <a href="/projects" class="btn btn-ghost btn-sm"><i class="fab fa-github"></i> GitHub</a>
          <a href="/projects" class="btn btn-outline btn-sm">Details</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div style="text-align:center;margin-top:40px">
      <a href="/projects" class="btn btn-outline">ls -la ~/projects/</a>
    </div>
  </div>
</section>

<!-- NEWSLETTER -->
<section class="section newsletter-section">
  <div class="container">
    <div class="newsletter-box reveal">
      <div class="newsletter-content">
        <div class="section-label">// subscribe --newsletter</div>
        <h2 style="font-size:2rem;margin:12px 0">Stay in the Loop</h2>
        <p style="color:var(--text-muted);max-width:480px">Get weekly security insights, CTF writeups, new tools, and exclusive content delivered to your inbox. No spam. Unsubscribe anytime.</p>
        <form class="newsletter-form ajax-form" action="/api/subscribe" style="margin-top:24px">
          <input type="email" name="email" placeholder="your@email.com" required class="form-input" style="max-width:320px" />
          <button type="submit" class="btn btn-primary">./subscribe.sh</button>
        </form>
        <p style="font-size:0.78rem;color:var(--text-muted);margin-top:12px">
          <i class="fa fa-lock"></i> No spam ever. 2,400+ subscribers.
        </p>
      </div>
      <div class="newsletter-art" style="font-family:var(--font-mono);font-size:0.72rem;color:var(--primary);opacity:0.4;line-height:1.7;display:none">
        <div>$ cat newsletter.sh</div>
        <div>#!/bin/bash</div>
        <div>TOPICS=(</div>
        <div>  "Security News"</div>
        <div>  "CTF Writeups"</div>
        <div>  "New Tools"</div>
        <div>  "Deep Dives"</div>
        <div>)</div>
        <div>send_weekly $TOPICS</div>
      </div>
    </div>
  </div>
</section>

<!-- TERMINAL CTA -->
<section class="section" style="text-align:center">
  <div class="container">
    <div class="reveal">
      <div class="section-label">// interactive_terminal</div>
      <h2 class="section-title">Try the Live Terminal</h2>
      <p class="section-subtitle">An interactive bash-like terminal with real commands, ASCII art, and easter eggs.</p>
      <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
        <a href="/terminal" class="btn btn-primary"><i class="fa fa-terminal"></i> ./open_terminal</a>
        <button class="btn btn-outline" onclick="document.getElementById('floatingTerminal').classList.toggle('open')">
          <i class="fa fa-window-maximize"></i> Float Panel
        </button>
      </div>
      <p style="color:var(--text-muted);font-size:0.82rem;margin-top:16px">
        Try: <code style="color:var(--primary)">neofetch</code> · <code style="color:var(--primary)">skills</code> · <code style="color:var(--primary)">hack</code> · <code style="color:var(--primary)">matrix</code>
      </p>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
