<?php
$page = 'research';
$title = 'Research Center';
$description = 'Cybersecurity and AI research papers, vulnerability disclosures, and technical publications by Cyber Alpha.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>research</span></div>
    <h1 class="page-title reveal glitch" data-text="Research Center">Research Center</h1>
    <p class="page-subtitle reveal">// cat research/*.pdf | grep "novel_findings" — Original security research &amp; CVEs</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="stats-grid reveal" style="grid-template-columns:repeat(4,1fr);margin-bottom:48px">
      <div class="stat-item"><div class="stat-number" data-count="18">0</div><div class="stat-label">Papers Published</div></div>
      <div class="stat-item"><div class="stat-number" data-count="12">0</div><div class="stat-label">CVEs Assigned</div></div>
      <div class="stat-item"><div class="stat-number" data-count="6">0</div><div class="stat-label">Conferences</div></div>
      <div class="stat-item"><div class="stat-number" data-count="340">0</div><div class="stat-label">Citations</div></div>
    </div>

    <!-- CVE Disclosures -->
    <div class="section-label reveal" style="margin-bottom:24px">// cve_disclosures --mine</div>
    <div class="grid grid-2" style="margin-bottom:48px">
      <?php
      $cves = [
        ['id'=>'CVE-2026-1337','severity'=>'Critical','cvss'=>'9.8','title'=>'Remote Code Execution in Popular CMS Platform','target'=>'WordPress Plugin (10M+ installs)','desc'=>'A SQL injection vulnerability in a widely-used WordPress authentication plugin allowed unauthenticated attackers to execute arbitrary SQL queries, leading to full database compromise and RCE via SQL stacking.','status'=>'Patched','bounty'=>'$8,500','color'=>'#ff4444'],
        ['id'=>'CVE-2026-0891','severity'=>'High','cvss'=>'8.1','title'=>'JWT Algorithm Confusion in Enterprise SSO','target'=>'Enterprise SSO Product','desc'=>'Algorithm confusion attack allowing an attacker to forge valid JWT tokens by switching from RS256 to HS256, effectively bypassing authentication for the entire SSO ecosystem.','status'=>'Patched','bounty'=>'$5,200','color'=>'#ff8800'],
        ['id'=>'CVE-2025-4421','severity'=>'High','cvss'=>'7.8','title'=>'Path Traversal in Cloud Storage API','target'=>'Cloud Storage Provider','desc'=>'Directory traversal vulnerability in the REST API file management endpoint allowed authenticated users to access files outside their allocated storage bucket.','status'=>'Patched','bounty'=>'$3,800','color'=>'#ff8800'],
        ['id'=>'CVE-2025-2201','severity'=>'Critical','cvss'=>'9.4','title'=>'Pre-auth RCE in Network Management System','target'=>'Enterprise NMS (Confidential)','desc'=>'Unauthenticated remote code execution via a deserialization vulnerability in the Java-based web management interface. Affected enterprise network management systems globally.','status'=>'Patched','bounty'=>'$12,000','color'=>'#ff4444'],
        ['id'=>'CVE-2025-0774','severity'=>'Medium','cvss'=>'6.5','title'=>'SSRF in Payment Processing Platform','target'=>'FinTech Platform (Confidential)','desc'=>'Server-side request forgery vulnerability in the webhook validation mechanism allowed attackers to reach internal cloud metadata services and extract IAM credentials.','status'=>'Patched','bounty'=>'$2,400','color'=>'#ffb000'],
        ['id'=>'CVE-2024-8831','severity'=>'High','cvss'=>'8.8','title'=>'Stored XSS to Account Takeover Chain','target'=>'Social Platform (100M+ users)','desc'=>'Multi-step exploitation chain using stored XSS in SVG file uploads to extract CSRF tokens and hijack user sessions, including admin accounts.','status'=>'Patched','bounty'=>'$4,100','color'=>'#ff8800'],
      ];
      foreach($cves as $cve): ?>
      <div class="card card-hover reveal" style="border-color:<?= $cve['color'] ?>20">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;margin-bottom:12px">
          <div>
            <div style="font-family:var(--font-mono);font-size:0.85rem;color:<?= $cve['color'] ?>;margin-bottom:4px">
              <i class="fa fa-triangle-exclamation"></i> <?= $cve['id'] ?>
            </div>
            <h4 style="color:var(--text-bright);font-size:0.95rem"><?= $cve['title'] ?></h4>
          </div>
          <div style="text-align:right;flex-shrink:0">
            <div style="background:<?= $cve['color'] ?>20;border:1px solid <?= $cve['color'] ?>;color:<?= $cve['color'] ?>;border-radius:6px;padding:2px 10px;font-size:0.75rem;font-family:var(--font-mono);margin-bottom:4px"><?= $cve['severity'] ?></div>
            <div style="color:var(--text-muted);font-size:0.75rem">CVSS: <?= $cve['cvss'] ?></div>
          </div>
        </div>
        <div style="color:var(--primary);font-size:0.78rem;font-family:var(--font-mono);margin-bottom:8px"><i class="fa fa-bullseye"></i> <?= $cve['target'] ?></div>
        <p style="color:var(--text-muted);font-size:0.82rem;line-height:1.6;margin-bottom:12px"><?= $cve['desc'] ?></p>
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;border-top:1px solid var(--border);padding-top:12px">
          <div style="display:flex;gap:12px;flex-wrap:wrap">
            <span class="tag" style="border-color:#00ff41;color:#00ff41"><?= $cve['status'] ?></span>
            <span style="color:#ffb000;font-size:0.82rem"><i class="fa fa-dollar-sign"></i> <?= $cve['bounty'] ?> bounty</span>
          </div>
          <a href="#" class="btn btn-ghost btn-sm">Read Advisory →</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Research Papers -->
    <div class="section-label reveal" style="margin-bottom:24px">// research_papers --published</div>
    <div style="display:flex;flex-direction:column;gap:20px;margin-bottom:48px">
      <?php
      $papers = [
        ['title'=>'Adversarial Machine Learning in Intrusion Detection Systems: A Comprehensive Survey','venue'=>'IEEE Security & Privacy 2026','date'=>'Jun 2026','citations'=>48,'type'=>'Survey Paper','abstract'=>'A systematic review of adversarial attacks against ML-based IDS systems, covering evasion attacks, poisoning attacks, and defensive strategies. Includes a novel taxonomy of attack vectors and a benchmark evaluation framework.','icon'=>'fa-file-pdf','color'=>'var(--primary)'],
        ['title'=>'Cache Deception at Scale: A Study of Web Cache Vulnerabilities in Fortune 500 Applications','venue'=>'USENIX Security 2026','date'=>'Apr 2026','citations'=>29,'type'=>'Research Paper','abstract'=>'Empirical study of web cache poisoning and cache deception vulnerabilities discovered across 150 enterprise web applications. Introduces three novel attack primitives not previously documented.','icon'=>'fa-file-pdf','color'=>'var(--secondary)'],
        ['title'=>'LLM Jailbreaking: Taxonomy, Techniques, and Mitigations','venue'=>'CCS 2025','date'=>'Nov 2025','citations'=>112,'type'=>'Research Paper','abstract'=>'First comprehensive taxonomy of LLM jailbreaking techniques with empirical evaluation across 8 major LLM deployments. Proposes a defense framework achieving 94% jailbreak detection rate.','icon'=>'fa-file-pdf','color'=>'var(--accent)'],
        ['title'=>'Blockchain Transaction Deanonymization via Graph Neural Networks','venue'=>'Financial Cryptography 2025','date'=>'Mar 2025','citations'=>67,'type'=>'Research Paper','abstract'=>'Novel GNN-based approach for clustering and deanonymizing cryptocurrency wallets with 89% accuracy, significantly outperforming existing heuristic methods.','icon'=>'fa-file-pdf','color'=>'var(--primary)'],
        ['title'=>'Post-Quantum Cryptography Migration: Challenges and Best Practices for Enterprise Systems','venue'=>'NDSS 2025','date'=>'Feb 2025','citations'=>34,'type'=>'Position Paper','abstract'=>'Practical guide for enterprise migration from classical to post-quantum cryptographic systems, covering CRYSTALS-Kyber, CRYSTALS-Dilithium, and SPHINCS+ implementations.','icon'=>'fa-file-pdf','color'=>'var(--secondary)'],
      ];
      foreach($papers as $paper): ?>
      <div class="card card-hover reveal">
        <div style="display:flex;align-items:flex-start;gap:16px">
          <div style="width:44px;height:44px;background:color-mix(in srgb, <?= $paper['color'] ?> 12%, transparent);border:1px solid <?= $paper['color'] ?>;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <i class="fa <?= $paper['icon'] ?>" style="color:<?= $paper['color'] ?>"></i>
          </div>
          <div style="flex:1">
            <div style="display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin-bottom:8px">
              <span class="tag" style="border-color:<?= $paper['color'] ?>;color:<?= $paper['color'] ?>"><?= $paper['type'] ?></span>
              <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-calendar"></i> <?= $paper['date'] ?></span>
              <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-quote-right"></i> <?= $paper['citations'] ?> citations</span>
            </div>
            <h3 style="color:var(--text-bright);font-size:1rem;line-height:1.4;margin-bottom:8px"><?= $paper['title'] ?></h3>
            <div style="color:var(--secondary);font-size:0.82rem;font-family:var(--font-mono);margin-bottom:10px"><?= $paper['venue'] ?></div>
            <p style="color:var(--text-muted);font-size:0.84rem;line-height:1.6;margin-bottom:12px"><?= $paper['abstract'] ?></p>
            <div style="display:flex;gap:10px">
              <a href="#" class="btn btn-outline btn-sm"><i class="fa fa-file-pdf"></i> Read Paper</a>
              <a href="#" class="btn btn-ghost btn-sm"><i class="fa fa-quote-right"></i> Cite</a>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Ongoing Research -->
    <div class="section-label reveal" style="margin-bottom:24px">// ongoing_research --in-progress</div>
    <div class="grid grid-3">
      <?php
      $ongoing = [
        ['title'=>'AI-Powered Social Engineering Detection','progress'=>68,'color'=>'var(--primary)','desc'=>'Building an ML classifier for detecting AI-generated phishing and social engineering content.'],
        ['title'=>'Quantum-Resistant Blockchain Protocols','progress'=>42,'color'=>'var(--secondary)','desc'=>'Designing post-quantum secure consensus mechanisms for distributed ledger systems.'],
        ['title'=>'Zero-Trust Architecture for IoT Networks','progress'=>55,'color'=>'var(--accent)','desc'=>'Framework for implementing zero-trust security in resource-constrained IoT environments.'],
      ];
      foreach($ongoing as $item): ?>
      <div class="card reveal">
        <h4 style="color:var(--text-bright);margin-bottom:8px;font-size:0.95rem"><?= $item['title'] ?></h4>
        <p style="color:var(--text-muted);font-size:0.82rem;margin-bottom:16px"><?= $item['desc'] ?></p>
        <div style="margin-bottom:8px;display:flex;justify-content:space-between;font-size:0.8rem">
          <span style="color:var(--text-muted)">Progress</span>
          <span style="color:<?= $item['color'] ?>"><?= $item['progress'] ?>%</span>
        </div>
        <div class="skill-bar">
          <div class="skill-fill" data-pct="<?= $item['progress'] ?>" style="background:<?= $item['color'] ?>"></div>
        </div>
        <div style="margin-top:12px;color:var(--text-muted);font-size:0.78rem">
          <i class="fa fa-flask" style="color:<?= $item['color'] ?>"></i> In Progress
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" style="background:var(--surface);text-align:center">
  <div class="container reveal">
    <div class="section-label">// collaborate --research</div>
    <h2 class="section-title">Research Collaboration</h2>
    <p class="section-subtitle">Interested in co-authoring a paper or sponsoring research? Let's connect.</p>
    <a href="/contact" class="btn btn-primary" style="margin-top:24px">Propose Research Collaboration</a>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
