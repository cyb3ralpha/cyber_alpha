<?php
$page = 'resources';
$title = 'Resource Library';
$description = 'Free cybersecurity resources, cheat sheets, tools, scripts, and templates by Cyber Alpha.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>resources</span></div>
    <h1 class="page-title reveal glitch" data-text="Resource Library">Resource Library</h1>
    <p class="page-subtitle reveal">// ls -la ~/resources/ | sort -k5 -rn &nbsp;→ Free downloads, tools &amp; references</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <!-- Search + Filter -->
    <div class="hub-controls reveal">
      <div class="search-wrap">
        <i class="fa fa-magnifying-glass search-icon"></i>
        <input type="text" class="form-input search-input" placeholder="find /resources -name '*.pdf'" data-search />
      </div>
      <div class="filter-tabs">
        <button class="filter-tab active" data-filter="all" data-target="[data-searchable]">All</button>
        <button class="filter-tab" data-filter="cheatsheet" data-target="[data-searchable]">Cheat Sheets</button>
        <button class="filter-tab" data-filter="tool" data-target="[data-searchable]">Tools</button>
        <button class="filter-tab" data-filter="template" data-target="[data-searchable]">Templates</button>
        <button class="filter-tab" data-filter="mindmap" data-target="[data-searchable]">Mind Maps</button>
        <button class="filter-tab" data-filter="script" data-target="[data-searchable]">Scripts</button>
      </div>
    </div>

    <!-- Resource Categories -->
    <?php
    $categories = [
      [
        'title'=>'Cheat Sheets',
        'icon'=>'fa-file-lines',
        'color'=>'var(--primary)',
        'filter'=>'cheatsheet',
        'items'=>[
          ['name'=>'Ultimate Linux Command Cheat Sheet','desc'=>'200+ essential commands for pentesters and sysadmins, from basics to advanced.','size'=>'2.1 MB','format'=>'PDF','downloads'=>'14,200','icon'=>'fa-file-pdf'],
          ['name'=>'Metasploit Framework Reference','desc'=>'Complete Metasploit command reference with examples for exploitation and post-exploitation.','size'=>'1.8 MB','format'=>'PDF','downloads'=>'11,500','icon'=>'fa-file-pdf'],
          ['name'=>'OWASP Top 10 Quick Reference 2025','desc'=>'Concise one-page reference for all OWASP Top 10 vulnerabilities with payload examples.','size'=>'800 KB','format'=>'PDF','downloads'=>'18,900','icon'=>'fa-file-pdf'],
          ['name'=>'SQL Injection Payload List','desc'=>'Comprehensive SQL injection payloads for MySQL, MSSQL, PostgreSQL, Oracle, and SQLite.','size'=>'400 KB','format'=>'TXT','downloads'=>'22,100','icon'=>'fa-file-code'],
          ['name'=>'Nmap Cheat Sheet & Scan Types','desc'=>'All Nmap scan modes, timing templates, scripts, and output formats in one sheet.','size'=>'600 KB','format'=>'PDF','downloads'=>'16,800','icon'=>'fa-file-pdf'],
          ['name'=>'Burp Suite Pro Shortcuts & Workflows','desc'=>'Power-user shortcuts, scanner configuration, and intercepting proxy setup guide.','size'=>'1.2 MB','format'=>'PDF','downloads'=>'9,400','icon'=>'fa-file-pdf'],
        ],
      ],
      [
        'title'=>'Custom Tools & Scripts',
        'icon'=>'fa-code',
        'color'=>'var(--secondary)',
        'filter'=>'tool',
        'items'=>[
          ['name'=>'AutoRecon Enhanced','desc'=>'Automated multi-threaded recon tool that chains Nmap, Gobuster, Nikto, and custom scripts.','size'=>'Python','format'=>'GitHub','downloads'=>'8,300','icon'=>'fa-code'],
          ['name'=>'SubdoScanner','desc'=>'Subdomain enumeration tool with bruteforcing, certificate transparency, and DNS permutation.','size'=>'Python','format'=>'GitHub','downloads'=>'5,600','icon'=>'fa-code'],
          ['name'=>'PhishKit Detector','desc'=>'Automated detector for phishing kits hiding in web servers using signature matching.','size'=>'Python','format'=>'GitHub','downloads'=>'3,200','icon'=>'fa-code'],
          ['name'=>'JWT Forge','desc'=>'JWT manipulation tool for testing algorithm confusion, key confusion, and claim injection.','size'=>'Python','format'=>'GitHub','downloads'=>'4,100','icon'=>'fa-code'],
          ['name'=>'Network Flow Analyzer','desc'=>'Parse and visualize network traffic flows from PCAP files with anomaly highlighting.','size'=>'Python','format'=>'GitHub','downloads'=>'2,900','icon'=>'fa-code'],
          ['name'=>'OSINT Spider','desc'=>'Automated OSINT data collection across 40+ public sources with relationship mapping.','size'=>'Python','format'=>'GitHub','downloads'=>'6,700','icon'=>'fa-code'],
        ],
      ],
      [
        'title'=>'Report Templates',
        'icon'=>'fa-file-contract',
        'color'=>'var(--accent)',
        'filter'=>'template',
        'items'=>[
          ['name'=>'Penetration Test Report Template','desc'=>'Professional pentest report template used by security firms. Includes executive summary, findings, and remediation sections.','size'=>'3.4 MB','format'=>'DOCX','downloads'=>'12,700','icon'=>'fa-file-word'],
          ['name'=>'Bug Bounty Report Template','desc'=>'CVSS scoring guide, reproduction steps, impact assessment, and clean reporting format accepted by HackerOne/Bugcrowd.','size'=>'1.1 MB','format'=>'MD','downloads'=>'9,800','icon'=>'fa-file-code'],
          ['name'=>'Security Audit Checklist','desc'=>'Comprehensive 200-point security audit checklist for web apps, APIs, networks, and cloud.','size'=>'800 KB','format'=>'XLSX','downloads'=>'7,300','icon'=>'fa-file-excel'],
          ['name'=>'Incident Response Playbook','desc'=>'Step-by-step IR playbook for common attack scenarios: ransomware, data breach, insider threat.','size'=>'2.2 MB','format'=>'PDF','downloads'=>'5,600','icon'=>'fa-file-pdf'],
        ],
      ],
      [
        'title'=>'Mind Maps',
        'icon'=>'fa-diagram-project',
        'color'=>'var(--primary)',
        'filter'=>'mindmap',
        'items'=>[
          ['name'=>'Web Hacking Mind Map 2026','desc'=>'Complete visual guide to web application attack vectors, from recon to exploitation.','size'=>'4.2 MB','format'=>'PNG','downloads'=>'21,400','icon'=>'fa-image'],
          ['name'=>'Network Security Mind Map','desc'=>'Network attack types, protocols, tools, and defenses mapped visually for reference.','size'=>'3.8 MB','format'=>'PNG','downloads'=>'14,100','icon'=>'fa-image'],
          ['name'=>'OSINT Investigation Flow','desc'=>'Visual flowchart for running structured OSINT investigations from a target name/email/domain.','size'=>'2.9 MB','format'=>'PNG','downloads'=>'11,800','icon'=>'fa-image'],
          ['name'=>'Privilege Escalation Cheatsheet','desc'=>'Linux & Windows privilege escalation techniques mapped as a decision tree.','size'=>'3.1 MB','format'=>'PNG','downloads'=>'17,600','icon'=>'fa-image'],
        ],
      ],
      [
        'title'=>'Python Scripts',
        'icon'=>'fa-python',
        'color'=>'var(--secondary)',
        'filter'=>'script',
        'items'=>[
          ['name'=>'Port Scanner with Banner Grabbing','desc'=>'Fast multithreaded TCP port scanner with service banner identification — Nmap alternative.','size'=>'Python','format'=>'GitHub','downloads'=>'7,200','icon'=>'fa-code'],
          ['name'=>'Password Strength Analyzer','desc'=>'Entropy-based password strength analyzer with common pattern detection and suggestions.','size'=>'Python','format'=>'GitHub','downloads'=>'4,500','icon'=>'fa-code'],
          ['name'=>'Log4Shell Mass Scanner','desc'=>'Detection script for Log4Shell vulnerable endpoints across internal networks.','size'=>'Python','format'=>'GitHub','downloads'=>'3,800','icon'=>'fa-code'],
          ['name'=>'Hash Identifier & Cracker','desc'=>'Automatically identifies hash types and tries dictionary attacks via hashcat integration.','size'=>'Python','format'=>'GitHub','downloads'=>'5,100','icon'=>'fa-code'],
        ],
      ],
    ];

    foreach($categories as $cat): ?>
    <div style="margin-bottom:48px">
      <div class="section-label reveal" style="display:flex;align-items:center;gap:10px;margin-bottom:24px">
        <i class="fa <?= $cat['icon'] ?>" style="color:<?= $cat['color'] ?>"></i>
        // <?= strtolower(str_replace(' ','_',$cat['title'])) ?>
        <h2 style="font-size:1.1rem;color:var(--text-bright);font-weight:600;margin:0"><?= $cat['title'] ?></h2>
      </div>
      <div class="grid grid-3">
        <?php foreach($cat['items'] as $item): ?>
        <div class="card card-hover reveal" data-category="<?= $cat['filter'] ?>" data-searchable>
          <div style="display:flex;align-items:flex-start;gap:14px;margin-bottom:12px">
            <div style="width:40px;height:40px;background:color-mix(in srgb, <?= $cat['color'] ?> 12%, transparent);border:1px solid <?= $cat['color'] ?>;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <i class="fa <?= $item['icon'] ?>" style="color:<?= $cat['color'] ?>"></i>
            </div>
            <div>
              <h4 style="color:var(--text-bright);font-size:0.92rem;margin-bottom:4px"><?= $item['name'] ?></h4>
              <div style="display:flex;gap:8px">
                <span class="tag" style="font-size:0.7rem"><?= $item['format'] ?></span>
                <span style="color:var(--text-muted);font-size:0.75rem"><?= $item['size'] ?></span>
              </div>
            </div>
          </div>
          <p style="color:var(--text-muted);font-size:0.82rem;line-height:1.5;margin-bottom:14px"><?= $item['desc'] ?></p>
          <div style="display:flex;justify-content:space-between;align-items:center">
            <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-download" style="margin-right:4px"></i><?= $item['downloads'] ?></span>
            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-download"></i> Download</a>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <?php endforeach; ?>

    <!-- Request a resource -->
    <div class="card reveal" style="text-align:center;padding:40px;border-color:var(--primary)">
      <i class="fa fa-plus-circle" style="font-size:2rem;color:var(--primary);margin-bottom:16px"></i>
      <h3 style="font-size:1.2rem;margin-bottom:8px">Can't find what you need?</h3>
      <p style="color:var(--text-muted);margin-bottom:20px">Request a specific cheat sheet, tool, or template — I'll create it and add it to the library.</p>
      <a href="/contact" class="btn btn-outline">Request a Resource</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
