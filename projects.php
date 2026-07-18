<?php
$page = 'projects';
$title = 'Projects';
$description = 'Open source security tools, AI projects, and software by Cyber Alpha — Abdullah Ismail.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>projects</span></div>
    <h1 class="page-title reveal glitch" data-text="Projects">Projects</h1>
    <p class="page-subtitle reveal">// ls -la ~/projects/ | grep -v "^\." | sort --stars</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="stats-grid reveal" style="grid-template-columns:repeat(4,1fr);margin-bottom:48px">
      <div class="stat-item"><div class="stat-number" data-count="40">0</div><div class="stat-label">Projects</div></div>
      <div class="stat-item"><div class="stat-number" data-count="8200">0</div><div class="stat-label">GitHub Stars</div></div>
      <div class="stat-item"><div class="stat-number" data-count="1400">0</div><div class="stat-label">Forks</div></div>
      <div class="stat-item"><div class="stat-number" data-count="32000">0</div><div class="stat-label">Downloads</div></div>
    </div>

    <div class="filter-tabs reveal" style="margin-bottom:40px">
      <button class="filter-tab active" data-filter="all" data-target=".proj-item">All</button>
      <button class="filter-tab" data-filter="security" data-target=".proj-item">Security</button>
      <button class="filter-tab" data-filter="ai" data-target=".proj-item">AI / ML</button>
      <button class="filter-tab" data-filter="osint" data-target=".proj-item">OSINT</button>
      <button class="filter-tab" data-filter="web" data-target=".proj-item">Web</button>
      <button class="filter-tab" data-filter="forensics" data-target=".proj-item">Forensics</button>
    </div>

    <?php
    $projects = [
      [
        'name'=>'CyberShield',
        'cat'=>'security',
        'lang'=>'Python',
        'stars'=>'2.3k',
        'forks'=>'412',
        'color'=>'var(--primary)',
        'icon'=>'fa-shield-halved',
        'status'=>'Active',
        'version'=>'v3.2.1',
        'desc'=>'Advanced ML-powered network intrusion detection system with real-time alerting, behavioral analysis, and automated response capabilities. Detects 99.7% of known attack patterns.',
        'features'=>['Real-time packet analysis','ML-based anomaly detection','Automated incident response','Dashboard & reporting','SIEM integration','REST API'],
        'tags'=>['Python','TensorFlow','Scapy','FastAPI','PostgreSQL'],
      ],
      [
        'name'=>'VulnScan Pro',
        'cat'=>'security',
        'lang'=>'Python/Go',
        'stars'=>'1.8k',
        'forks'=>'287',
        'color'=>'var(--secondary)',
        'icon'=>'fa-magnifying-glass-chart',
        'status'=>'Active',
        'version'=>'v2.1.0',
        'desc'=>'Automated web vulnerability scanner with full OWASP Top 10 coverage. Generates professional HTML/PDF reports with CVSS scoring and remediation guidance.',
        'features'=>['OWASP Top 10 scanning','Custom payload injection','Authenticated scanning','API security testing','Report generation','CI/CD integration'],
        'tags'=>['Python','Go','Playwright','ReportLab'],
      ],
      [
        'name'=>'AI ThreatHunter',
        'cat'=>'ai',
        'lang'=>'Python/AI',
        'stars'=>'967',
        'forks'=>'143',
        'color'=>'var(--accent)',
        'icon'=>'fa-robot',
        'status'=>'Active',
        'version'=>'v1.5.0',
        'desc'=>'ML-powered threat intelligence aggregator that correlates IOCs from 50+ feeds, classifies threats using NLP, and generates human-readable intelligence reports with LLMs.',
        'features'=>['50+ threat feed integration','NLP-based classification','LLM report generation','IOC correlation engine','MITRE ATT&CK mapping','Webhook alerts'],
        'tags'=>['Python','GPT-4','LangChain','MISP','Redis'],
      ],
      [
        'name'=>'OSINT Spider',
        'cat'=>'osint',
        'lang'=>'Python',
        'stars'=>'743',
        'forks'=>'98',
        'color'=>'var(--primary)',
        'icon'=>'fa-spider',
        'status'=>'Active',
        'version'=>'v2.0.4',
        'desc'=>'Automated OSINT data collection tool that aggregates intelligence from 40+ public sources. Builds relationship graphs for people, organizations, and infrastructure.',
        'features'=>['40+ data sources','Relationship graph visualization','Email/username enumeration','Domain investigation','Export to CSV/JSON/PDF','Proxy rotation'],
        'tags'=>['Python','NetworkX','Selenium','SQLite','Graphviz'],
      ],
      [
        'name'=>'CryptoForensics',
        'cat'=>'forensics',
        'lang'=>'Python',
        'stars'=>'612',
        'forks'=>'87',
        'color'=>'var(--secondary)',
        'icon'=>'fa-link',
        'status'=>'Active',
        'version'=>'v1.3.0',
        'desc'=>'Blockchain forensics and cryptocurrency transaction tracing tool. Supports Bitcoin, Ethereum, and 20+ chains. Used by law enforcement and compliance teams worldwide.',
        'features'=>['Multi-chain support','Transaction graph analysis','Wallet clustering','Exchange identification','Risk scoring','Investigation reports'],
        'tags'=>['Python','Web3.py','NetworkX','Bitcoin RPC','Plotly'],
      ],
      [
        'name'=>'SecureChat',
        'cat'=>'web',
        'lang'=>'JavaScript',
        'stars'=>'534',
        'forks'=>'76',
        'color'=>'var(--accent)',
        'icon'=>'fa-comments',
        'status'=>'Active',
        'version'=>'v1.1.2',
        'desc'=>'End-to-end encrypted messaging platform with zero-knowledge architecture. No server-side message storage. Self-hostable on any VPS in under 5 minutes.',
        'features'=>['E2E encryption (Signal protocol)','Zero-knowledge server','File sharing (encrypted)','Voice/video calls','Self-hosted','Docker ready'],
        'tags'=>['JavaScript','Node.js','WebRTC','Signal Protocol','Docker'],
      ],
      [
        'name'=>'PenTest Toolkit',
        'cat'=>'security',
        'lang'=>'Python',
        'stars'=>'1.1k',
        'forks'=>'189',
        'color'=>'var(--primary)',
        'icon'=>'fa-toolbox',
        'status'=>'Active',
        'version'=>'v4.0.0',
        'desc'=>'All-in-one penetration testing framework combining 25+ tools into a single CLI interface. From recon to reporting, handles the entire pentest lifecycle.',
        'features'=>['25+ integrated tools','Automated workflow engine','Custom script support','Team collaboration','Encrypted reporting','Plugin system'],
        'tags'=>['Python','Click','SQLite','Jinja2','Nmap','Metasploit'],
      ],
      [
        'name'=>'MalwareDB',
        'cat'=>'forensics',
        'lang'=>'Python/React',
        'stars'=>'389',
        'forks'=>'54',
        'color'=>'var(--secondary)',
        'icon'=>'fa-database',
        'status'=>'Beta',
        'version'=>'v0.9.1',
        'desc'=>'Community malware intelligence database with behavioral indicators, YARA rules, and family classification. REST API for tool integration.',
        'features'=>['Malware family classification','YARA rule library','IOC database','Behavioral indicators','REST API','Community submissions'],
        'tags'=>['Python','React','PostgreSQL','YARA','FastAPI'],
      ],
      [
        'name'=>'SubdoScanner',
        'cat'=>'osint',
        'lang'=>'Python',
        'stars'=>'654',
        'forks'=>'92',
        'color'=>'var(--accent)',
        'icon'=>'fa-sitemap',
        'status'=>'Active',
        'version'=>'v2.3.0',
        'desc'=>'Fast subdomain enumeration tool combining bruteforcing, certificate transparency logs, DNS permutation, and passive sources. Finds what other tools miss.',
        'features'=>['CT log enumeration','DNS bruteforce','Permutation engine','Passive sources','Wildcard detection','JSON/CSV output'],
        'tags'=>['Python','asyncio','aiohttp','PostgreSQL'],
      ],
    ];
    ?>

    <div class="grid grid-3">
      <?php foreach($projects as $proj): ?>
      <div class="card card-hover project-card proj-item reveal" data-category="<?= $proj['cat'] ?>">
        <div class="project-header" style="margin-bottom:16px">
          <div style="display:flex;align-items:center;gap:12px">
            <div style="width:44px;height:44px;background:color-mix(in srgb, <?= $proj['color'] ?> 12%, transparent);border:1px solid <?= $proj['color'] ?>;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3rem">
              <i class="fa <?= $proj['icon'] ?>" style="color:<?= $proj['color'] ?>"></i>
            </div>
            <div>
              <h3 style="color:var(--text-bright);font-size:1.05rem;font-weight:700"><?= $proj['name'] ?></h3>
              <span style="font-size:0.75rem;color:var(--text-muted);font-family:var(--font-mono)"><?= $proj['version'] ?></span>
            </div>
          </div>
          <div style="display:flex;flex-direction:column;align-items:flex-end;gap:4px">
            <span class="tag" style="border-color:<?= $proj['status']==='Active'?'#00ff41':'#ffb000' ?>;color:<?= $proj['status']==='Active'?'#00ff41':'#ffb000' ?>">
              <span style="color:<?= $proj['status']==='Active'?'#00ff41':'#ffb000' ?>">●</span> <?= $proj['status'] ?>
            </span>
          </div>
        </div>

        <p style="color:var(--text-muted);font-size:0.83rem;line-height:1.6;margin-bottom:14px"><?= $proj['desc'] ?></p>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:4px;margin-bottom:14px">
          <?php foreach(array_slice($proj['features'],0,4) as $feat): ?>
          <div style="font-size:0.78rem;color:var(--text-dim);display:flex;align-items:center;gap:5px">
            <i class="fa fa-check" style="color:<?= $proj['color'] ?>;font-size:0.65rem"></i> <?= $feat ?>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="tags" style="margin-bottom:14px">
          <?php foreach($proj['tags'] as $tag): ?>
          <span class="tag"><?= $tag ?></span>
          <?php endforeach; ?>
        </div>

        <div style="display:flex;justify-content:space-between;align-items:center;border-top:1px solid var(--border);padding-top:12px">
          <div style="display:flex;gap:14px">
            <span style="color:var(--text-muted);font-size:0.8rem"><i class="fa fa-star" style="color:#ffb000"></i> <?= $proj['stars'] ?></span>
            <span style="color:var(--text-muted);font-size:0.8rem"><i class="fa fa-code-fork" style="color:var(--secondary)"></i> <?= $proj['forks'] ?></span>
          </div>
          <div style="display:flex;gap:8px">
            <a href="https://github.com/cyberalpha" target="_blank" class="btn btn-ghost btn-sm"><i class="fab fa-github"></i></a>
            <a href="#" class="btn btn-outline btn-sm">View</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Collaboration CTA -->
<section class="section" style="background:var(--surface);text-align:center">
  <div class="container reveal">
    <div class="section-label">// collaboration --open</div>
    <h2 class="section-title">Interested in Collaborating?</h2>
    <p class="section-subtitle">All projects are open source. PRs, issues, and ideas welcome. Let's build something great together.</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
      <a href="https://github.com/cyberalpha" class="btn btn-primary" target="_blank"><i class="fab fa-github"></i> GitHub Profile</a>
      <a href="/contact" class="btn btn-outline">Propose Collaboration</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
