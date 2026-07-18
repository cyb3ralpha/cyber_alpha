<?php
$page = 'about';
$title = 'About';
$description = 'About Abdullah Ismail — Cyber Alpha. Cybersecurity expert, AI researcher, and educator.';
require __DIR__ . '/includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal">
      <a href="/">~/home</a> <span>/</span> <span>about</span>
    </div>
    <h1 class="page-title reveal glitch" data-text="About Me">About Me</h1>
    <p class="page-subtitle reveal">// man cyberalpha — the complete manual page</p>
  </div>
</section>

<!-- BIO SECTION -->
<section class="section">
  <div class="container">
    <div class="about-grid">
      <!-- Avatar + Quick Info -->
      <div class="about-sidebar reveal">
        <div class="about-avatar">
          <div class="avatar-container" style="margin:0 auto">
            <div class="avatar-glow-ring"></div>
            <div class="avatar-circle">
              <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" width="140" height="140">
                <circle cx="100" cy="70" r="45" fill="var(--primary)" opacity="0.15"/>
                <circle cx="100" cy="68" r="32" fill="var(--primary)" opacity="0.25"/>
                <text x="100" y="85" text-anchor="middle" font-size="52" fill="var(--primary)">👤</text>
                <text x="100" y="150" text-anchor="middle" font-family="Fira Code,monospace" font-size="11" fill="var(--primary)" opacity="0.9">CYBER_ALPHA</text>
              </svg>
            </div>
          </div>
        </div>

        <div class="card" style="margin-top:24px">
          <div style="color:var(--text-muted);font-size:0.8rem;margin-bottom:12px">// identity.json</div>
          <div class="about-info-row"><span style="color:var(--secondary)">name:</span> Abdullah Ismail</div>
          <div class="about-info-row"><span style="color:var(--secondary)">alias:</span> <span style="color:var(--primary)">Cyber Alpha</span></div>
          <div class="about-info-row"><span style="color:var(--secondary)">location:</span> 🌍 Global</div>
          <div class="about-info-row"><span style="color:var(--secondary)">status:</span> <span style="color:#00ff41">● Active</span></div>
          <div class="about-info-row"><span style="color:var(--secondary)">years_exp:</span> 6+</div>
          <div class="about-info-row"><span style="color:var(--secondary)">languages:</span> AR / EN</div>
          <div class="about-info-row"><span style="color:var(--secondary)">available:</span> <span style="color:var(--primary)">true</span></div>
        </div>

        <div class="card" style="margin-top:16px">
          <div style="color:var(--text-muted);font-size:0.8rem;margin-bottom:12px">// certifications</div>
          <?php
          $certs = ['CEH — Certified Ethical Hacker','OSCP — Offensive Security','CompTIA Security+','eJPT — eLearnSecurity','AWS Security Specialty','CCNA Security'];
          foreach($certs as $c): ?>
          <div style="padding:6px 0;border-bottom:1px solid var(--border);font-size:0.83rem;display:flex;align-items:center;gap:8px">
            <i class="fa fa-certificate" style="color:var(--primary);font-size:0.7rem"></i> <?= $c ?>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="about-social-links" style="margin-top:20px;display:flex;gap:12px;flex-wrap:wrap">
          <a href="https://github.com/cyberalpha" class="btn btn-outline btn-sm" target="_blank"><i class="fab fa-github"></i> GitHub</a>
          <a href="https://linkedin.com/in/cyberalpha" class="btn btn-outline btn-sm" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a>
          <a href="/contact" class="btn btn-primary btn-sm">Hire Me</a>
        </div>
      </div>

      <!-- Main Bio -->
      <div class="about-main reveal">
        <div class="card" style="margin-bottom:24px">
          <div class="section-label" style="margin-bottom:16px">// bio --verbose</div>
          <p style="margin-bottom:16px;line-height:1.8">
            I'm <strong style="color:var(--text-bright)">Abdullah Ismail</strong>, known online as <strong style="color:var(--primary)">Cyber Alpha</strong>. I'm a cybersecurity professional, AI researcher, and software developer with over 6 years of experience in offensive security, vulnerability research, and security education.
          </p>
          <p style="margin-bottom:16px;line-height:1.8">
            My journey started with CTF competitions and bug bounty hunting, which led me deep into understanding how systems work — and how they break. I've reported vulnerabilities to major organizations, won multiple CTF competitions, and developed security tools used by thousands of researchers worldwide.
          </p>
          <p style="margin-bottom:16px;line-height:1.8">
            Beyond offensive work, I'm passionate about <strong style="color:var(--secondary)">AI in cybersecurity</strong> — building models that detect threats, predict attacks, and automate defensive operations. I believe the future of security is at the intersection of human expertise and machine intelligence.
          </p>
          <p style="line-height:1.8">
            My mission is simple: <strong style="color:var(--primary)">democratize cybersecurity education</strong>. Through this platform, I share everything I learn — articles, learning paths, tools, research, and talks — completely free, to help build the next generation of security professionals.
          </p>
        </div>

        <!-- Timeline -->
        <div class="section-label" style="margin-bottom:20px">// career --timeline</div>
        <div class="timeline">
          <?php
          $timeline = [
            ['year'=>'2026','title'=>'Senior Security Researcher','org'=>'Independent / Freelance','desc'=>'Leading advanced penetration testing engagements, AI security research, and international conference talks.'],
            ['year'=>'2024','title'=>'Security Engineer','org'=>'Tech Corp (Confidential)','desc'=>'Built internal red team infrastructure, developed automated vulnerability scanning pipelines, and led security training programs.'],
            ['year'=>'2022','title'=>'Bug Bounty Full-Time','org'=>'HackerOne / Bugcrowd','desc'=>'Transitioned to full-time bug bounty hunting. Reported 34+ critical vulnerabilities across Fortune 500 companies.'],
            ['year'=>'2021','title'=>'First Conference Talk','org'=>'Cyber Security Summit','desc'=>'Delivered first major conference talk on advanced OSINT techniques to an audience of 500+ security professionals.'],
            ['year'=>'2019','title'=>'Started Cyber Alpha','org'=>'cyberalpha.dev','desc'=>'Launched this platform to share security knowledge, tools, and research with the global cybersecurity community.'],
            ['year'=>'2017','title'=>'First CTF Win','org'=>'Regional Hacking Championship','desc'=>'Won first regional CTF competition at age 17. The spark that started everything.'],
          ];
          foreach($timeline as $item): ?>
          <div class="timeline-item">
            <div class="timeline-year"><?= $item['year'] ?></div>
            <div class="timeline-content card">
              <h4 style="color:var(--text-bright);margin-bottom:4px"><?= $item['title'] ?></h4>
              <div style="color:var(--primary);font-size:0.82rem;margin-bottom:8px;font-family:var(--font-mono)"><?= $item['org'] ?></div>
              <p style="color:var(--text-muted);font-size:0.88rem"><?= $item['desc'] ?></p>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SKILLS -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// skills --all --verbose</div>
      <h2 class="section-title">Technical Skills</h2>
    </div>
    <div class="grid grid-2">
      <?php
      $skillGroups = [
        ['cat'=>'Offensive Security','color'=>'var(--primary)','items'=>[
          ['Penetration Testing',95],['Web App Security',92],['Network Security',88],['Malware Analysis',82],['Exploit Development',78],['Social Engineering',85],
        ]],
        ['cat'=>'Programming & Dev','color'=>'var(--secondary)','items'=>[
          ['Python',95],['JavaScript / Node.js',85],['Bash / Shell',92],['C / C++',72],['Go',68],['PHP',80],
        ]],
        ['cat'=>'AI & Machine Learning','color'=>'var(--accent)','items'=>[
          ['TensorFlow / PyTorch',82],['Scikit-learn',88],['NLP / LLMs',78],['Data Analysis',85],['MLOps',72],['Adversarial AI',75],
        ]],
        ['cat'=>'Tools & Platforms','color'=>'var(--primary)','items'=>[
          ['Kali Linux / Parrot',98],['Burp Suite',95],['Metasploit',90],['Ghidra / IDA',78],['Wireshark',92],['AWS / Cloud Security',80],
        ]],
      ];
      foreach($skillGroups as $grp): ?>
      <div class="card reveal">
        <h3 style="color:<?= $grp['color'] ?>;font-family:var(--font-mono);font-size:0.9rem;margin-bottom:20px"><?= $grp['cat'] ?></h3>
        <?php foreach($grp['items'] as [$skill, $pct]): ?>
        <div class="skill-item">
          <div class="skill-header">
            <span class="skill-name"><?= $skill ?></span>
            <span class="skill-pct" style="color:<?= $grp['color'] ?>"><?= $pct ?>%</span>
          </div>
          <div class="skill-bar">
            <div class="skill-fill" data-pct="<?= $pct ?>" style="background:<?= $grp['color'] ?>"></div>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- PHILOSOPHY -->
<section class="section">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// philosophy.txt</div>
      <h2 class="section-title">How I Think</h2>
    </div>
    <div class="grid grid-3">
      <?php
      $values = [
        ['icon'=>'fa-lock-open','color'=>'var(--primary)','title'=>'Hacker Mindset','text'=>'Always asking "how does this work?" and "how can this be broken?" — curiosity is the foundation of security.'],
        ['icon'=>'fa-book-open','color'=>'var(--secondary)','title'=>'Knowledge Sharing','text'=>'Security through obscurity is a myth. Sharing knowledge openly makes us all stronger. Education is defense.'],
        ['icon'=>'fa-handshake','color'=>'var(--accent)','title'=>'Ethical Responsibility','text'=>'With great power comes great responsibility. Offensive knowledge must always serve defensive purposes.'],
        ['icon'=>'fa-infinity','color'=>'var(--primary)','title'=>'Continuous Learning','text'=>'The threat landscape never sleeps. Neither do I. Learning is not a phase — it\'s a lifestyle.'],
        ['icon'=>'fa-users','color'=>'var(--secondary)','title'=>'Community First','text'=>'The cybersecurity community is what makes this field powerful. Lifting others up lifts everyone.'],
        ['icon'=>'fa-code','color'=>'var(--accent)','title'=>'Build to Defend','text'=>'The best defenders understand how to attack. Building tools and breaking them builds intuition.'],
      ];
      foreach($values as $v): ?>
      <div class="card card-hover reveal">
        <div class="card-icon"><i class="fa <?= $v['icon'] ?>" style="color:<?= $v['color'] ?>"></i></div>
        <h3 class="card-title"><?= $v['title'] ?></h3>
        <p class="card-desc"><?= $v['text'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section" style="text-align:center;background:var(--surface)">
  <div class="container reveal">
    <div class="section-label">// next_steps</div>
    <h2 class="section-title">Let's Work Together</h2>
    <p class="section-subtitle">Available for consulting, speaking, mentorship, and collaboration.</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
      <a href="/contact" class="btn btn-primary">./send_message.sh</a>
      <a href="/portfolio" class="btn btn-outline">view portfolio</a>
      <a href="/talks" class="btn btn-ghost">see talks</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
