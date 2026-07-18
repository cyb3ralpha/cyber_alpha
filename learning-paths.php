<?php
$page = 'learning-paths';
$title = 'Learning Paths';
$description = 'Structured cybersecurity and AI learning roadmaps by Cyber Alpha — from beginner to expert.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>learning_paths</span></div>
    <h1 class="page-title reveal glitch" data-text="Learning Paths">Learning Paths</h1>
    <p class="page-subtitle reveal">// ./start_learning.sh --guided --structured --free</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <!-- Stats Row -->
    <div class="stats-grid reveal" style="grid-template-columns:repeat(4,1fr);margin-bottom:48px">
      <div class="stat-item"><div class="stat-number" data-count="8">0</div><div class="stat-label">Learning Paths</div></div>
      <div class="stat-item"><div class="stat-number" data-count="245">0</div><div class="stat-label">Total Lessons</div></div>
      <div class="stat-item"><div class="stat-number" data-count="12000">0</div><div class="stat-label">Learners</div></div>
      <div class="stat-item"><div class="stat-number" data-count="100">0</div><div class="stat-label">% Free</div></div>
    </div>

    <!-- Filter -->
    <div class="filter-tabs reveal" style="margin-bottom:40px">
      <button class="filter-tab active" data-filter="all" data-target=".path-card">All Paths</button>
      <button class="filter-tab" data-filter="beginner" data-target=".path-card">Beginner</button>
      <button class="filter-tab" data-filter="intermediate" data-target=".path-card">Intermediate</button>
      <button class="filter-tab" data-filter="advanced" data-target=".path-card">Advanced</button>
    </div>

    <?php
    $paths = [
      [
        'id'=>'ethical-hacking',
        'title'=>'Ethical Hacking Bootcamp',
        'level'=>'beginner',
        'badge'=>'Beginner → Advanced',
        'icon'=>'fa-terminal',
        'color'=>'var(--primary)',
        'hours'=>'120h',
        'lessons'=>42,
        'students'=>4200,
        'desc'=>'The most comprehensive ethical hacking path available — free. Start from zero Linux knowledge and progress to advanced exploitation, privilege escalation, and real-world pentesting methodologies.',
        'modules'=>[
          ['Linux Fundamentals & Command Line Mastery', 8],
          ['Networking for Hackers: TCP/IP, DNS, HTTP', 6],
          ['Reconnaissance & OSINT Techniques', 5],
          ['Vulnerability Scanning with Nmap & Nikto', 4],
          ['Exploitation Fundamentals with Metasploit', 7],
          ['Web Application Hacking (OWASP Top 10)', 6],
          ['Post-Exploitation & Privilege Escalation', 4],
          ['Report Writing & Responsible Disclosure', 2],
        ],
        'tools'=>['Kali Linux','Metasploit','Burp Suite','Nmap','John the Ripper','Aircrack-ng'],
      ],
      [
        'id'=>'web-security',
        'title'=>'Web Application Security',
        'level'=>'intermediate',
        'badge'=>'Intermediate',
        'icon'=>'fa-globe',
        'color'=>'var(--secondary)',
        'hours'=>'80h',
        'lessons'=>28,
        'students'=>3100,
        'desc'=>'Master web application security from both attacker and defender perspectives. OWASP Top 10 deep dives, Burp Suite mastery, API security testing, and real bug bounty workflows.',
        'modules'=>[
          ['OWASP Top 10 — Complete 2025 Edition', 10],
          ['SQL Injection: From Basic to Blind & OOB', 4],
          ['XSS, CSRF, and Client-Side Attacks', 4],
          ['Authentication & Authorization Flaws', 3],
          ['API Security Testing', 3],
          ['Burp Suite Pro Mastery', 2],
          ['Bug Bounty Workflow & Reporting', 2],
        ],
        'tools'=>['Burp Suite','sqlmap','XSSHunter','ffuf','Postman','HackBar'],
      ],
      [
        'id'=>'ai-security',
        'title'=>'AI for Security Professionals',
        'level'=>'intermediate',
        'badge'=>'Intermediate',
        'icon'=>'fa-robot',
        'color'=>'var(--accent)',
        'hours'=>'100h',
        'lessons'=>35,
        'students'=>1800,
        'desc'=>'Apply machine learning to threat detection, malware classification, anomaly detection, and adversarial AI. Build real security tools powered by Python and modern ML frameworks.',
        'modules'=>[
          ['Python for Security Automation', 6],
          ['Machine Learning Fundamentals', 8],
          ['Network Traffic Analysis with ML', 5],
          ['Malware Classification with Deep Learning', 6],
          ['NLP for Threat Intelligence', 4],
          ['Adversarial Machine Learning', 4],
          ['Deploying ML Security Models', 2],
        ],
        'tools'=>['Python','TensorFlow','Scikit-learn','Pandas','Jupyter','MISP'],
      ],
      [
        'id'=>'malware-analysis',
        'title'=>'Malware Analysis & Reverse Engineering',
        'level'=>'advanced',
        'badge'=>'Advanced',
        'icon'=>'fa-bug',
        'color'=>'var(--primary)',
        'hours'=>'90h',
        'lessons'=>22,
        'students'=>980,
        'desc'=>'Advanced static and dynamic malware analysis. Learn to defeat obfuscation, unpack executables, analyze assembly code, and write detection signatures for real malware families.',
        'modules'=>[
          ['Windows Internals for Analysts', 4],
          ['x86/x64 Assembly Fundamentals', 5],
          ['Static Analysis with Ghidra & IDA', 5],
          ['Dynamic Analysis with x64dbg', 4],
          ['Defeating Obfuscation & Packing', 2],
          ['Analyzing Real-World Ransomware', 2],
        ],
        'tools'=>['Ghidra','x64dbg','PEStudio','IDA Free','Cuckoo Sandbox','YARA'],
      ],
      [
        'id'=>'osint',
        'title'=>'OSINT & Digital Forensics',
        'level'=>'beginner',
        'badge'=>'Beginner',
        'icon'=>'fa-magnifying-glass',
        'color'=>'var(--secondary)',
        'hours'=>'60h',
        'lessons'=>24,
        'students'=>2700,
        'desc'=>'Open-source intelligence gathering from scratch. Learn to investigate people, organizations, and infrastructure using legal, freely available tools and public data sources.',
        'modules'=>[
          ['OSINT Mindset & Legal Boundaries', 2],
          ['Google Dorks & Advanced Search', 3],
          ['Social Media Intelligence (SOCMINT)', 4],
          ['Infrastructure & Domain Reconnaissance', 4],
          ['Image & Geolocation OSINT', 3],
          ['Maltego & Link Analysis', 3],
          ['Building Automated OSINT Pipelines', 5],
        ],
        'tools'=>['Maltego','Shodan','Recon-ng','SpiderFoot','theHarvester','OSINT Framework'],
      ],
      [
        'id'=>'network-security',
        'title'=>'Network Security & Defense',
        'level'=>'intermediate',
        'badge'=>'Intermediate',
        'icon'=>'fa-network-wired',
        'color'=>'var(--accent)',
        'hours'=>'70h',
        'lessons'=>28,
        'students'=>1500,
        'desc'=>'Network security from both attacker and defender perspectives. Packet analysis, intrusion detection, firewall configuration, VPN security, and network forensics.',
        'modules'=>[
          ['Network Protocols Deep Dive', 5],
          ['Packet Capture & Wireshark Mastery', 4],
          ['Network Attacks & Mitigation', 5],
          ['IDS/IPS Configuration & Tuning', 4],
          ['Firewall & Network Segmentation', 4],
          ['Network Forensics & Log Analysis', 6],
        ],
        'tools'=>['Wireshark','Zeek','Snort','nmap','Tcpdump','Security Onion'],
      ],
    ];

    foreach($paths as $path): ?>
    <div class="card path-card reveal" data-category="<?= $path['level'] ?>" style="margin-bottom:32px">
      <div class="path-header">
        <div class="path-icon-wrap" style="background:color-mix(in srgb, <?= $path['color'] ?> 15%, transparent);border:1px solid <?= $path['color'] ?>;border-radius:12px;width:56px;height:56px;display:flex;align-items:center;justify-content:center;font-size:1.5rem;flex-shrink:0">
          <i class="fa <?= $path['icon'] ?>" style="color:<?= $path['color'] ?>"></i>
        </div>
        <div class="path-meta">
          <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:6px">
            <h3 style="font-size:1.2rem;color:var(--text-bright);font-weight:700"><?= $path['title'] ?></h3>
            <span class="tag" style="border-color:<?= $path['color'] ?>;color:<?= $path['color'] ?>"><?= $path['badge'] ?></span>
          </div>
          <div style="display:flex;gap:16px;flex-wrap:wrap">
            <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-book"></i> <?= $path['lessons'] ?> lessons</span>
            <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-clock"></i> <?= $path['hours'] ?></span>
            <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-users"></i> <?= number_format($path['students']) ?> learners</span>
            <span style="color:#00ff41;font-size:0.82rem"><i class="fa fa-tag"></i> 100% Free</span>
          </div>
        </div>
        <button class="btn btn-primary" onclick="togglePath('<?= $path['id'] ?>')">Start Path</button>
      </div>
      <p style="color:var(--text-muted);line-height:1.7;margin:16px 0"><?= $path['desc'] ?></p>

      <details id="path-<?= $path['id'] ?>">
        <summary style="cursor:pointer;color:<?= $path['color'] ?>;font-family:var(--font-mono);font-size:0.85rem;padding:8px 0;list-style:none">
          <i class="fa fa-chevron-right" style="margin-right:6px;transition:transform 0.2s"></i>
          View Curriculum (<?= count($path['modules']) ?> modules)
        </summary>
        <div style="margin-top:16px">
          <div class="path-modules">
            <?php foreach($path['modules'] as $i => [$mod, $lessons]): ?>
            <div class="path-module" style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)">
              <div style="width:28px;height:28px;border-radius:50%;background:color-mix(in srgb, <?= $path['color'] ?> 15%, transparent);border:1px solid <?= $path['color'] ?>;display:flex;align-items:center;justify-content:center;font-family:var(--font-mono);font-size:0.75rem;color:<?= $path['color'] ?>;flex-shrink:0">
                <?= $i + 1 ?>
              </div>
              <span style="flex:1;font-size:0.88rem"><?= $mod ?></span>
              <span style="color:var(--text-muted);font-size:0.78rem"><?= $lessons ?> lessons</span>
              <i class="fa fa-lock" style="color:var(--text-muted);font-size:0.75rem"></i>
            </div>
            <?php endforeach; ?>
          </div>
          <div style="margin-top:16px">
            <div style="color:var(--text-muted);font-size:0.82rem;margin-bottom:10px">Tools You'll Use:</div>
            <div class="tags">
              <?php foreach($path['tools'] as $tool): ?>
              <span class="tag"><?= $tool ?></span>
              <?php endforeach; ?>
            </div>
          </div>
          <div style="margin-top:16px;display:flex;gap:12px">
            <a href="/contact" class="btn btn-primary btn-sm">Enroll Free</a>
            <a href="/knowledge-hub" class="btn btn-outline btn-sm">Related Articles</a>
          </div>
        </div>
      </details>
    </div>
    <?php endforeach; ?>
  </div>
</section>

<!-- Mentorship CTA -->
<section class="section" style="background:var(--surface);text-align:center">
  <div class="container reveal">
    <div class="section-label">// mentorship --1on1</div>
    <h2 class="section-title">Want 1-on-1 Mentorship?</h2>
    <p class="section-subtitle">Personal guidance, code reviews, career advice, and accountability from Cyber Alpha directly.</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
      <a href="/contact" class="btn btn-primary">Apply for Mentorship</a>
      <a href="/contact" class="btn btn-outline">Ask a Question</a>
    </div>
  </div>
</section>

<script>
function togglePath(id) {
  const d = document.getElementById('path-' + id);
  if (d) d.open = !d.open;
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
