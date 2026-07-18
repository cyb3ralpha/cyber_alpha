<?php
$page = 'knowledge-hub';
$title = 'Knowledge Hub';
$description = 'Cybersecurity articles, tutorials, writeups, and deep-dives by Cyber Alpha — Abdullah Ismail.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>knowledge_hub</span></div>
    <h1 class="page-title reveal glitch" data-text="Knowledge Hub">Knowledge Hub</h1>
    <p class="page-subtitle reveal">// grep -r "knowledge" /brain --include="*.md" | wc -l → 150+ articles</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <!-- Search & Filter -->
    <div class="hub-controls reveal">
      <div class="search-wrap">
        <i class="fa fa-magnifying-glass search-icon"></i>
        <input type="text" class="form-input search-input" placeholder="grep 'topic' articles/" data-search />
      </div>
      <div class="filter-tabs" style="flex-wrap:wrap">
        <button class="filter-tab active" data-filter="all" data-target="[data-searchable]">All</button>
        <button class="filter-tab" data-filter="web" data-target="[data-searchable]">Web Security</button>
        <button class="filter-tab" data-filter="pentest" data-target="[data-searchable]">Pentesting</button>
        <button class="filter-tab" data-filter="ai" data-target="[data-searchable]">AI Security</button>
        <button class="filter-tab" data-filter="osint" data-target="[data-searchable]">OSINT</button>
        <button class="filter-tab" data-filter="malware" data-target="[data-searchable]">Malware</button>
        <button class="filter-tab" data-filter="ctf" data-target="[data-searchable]">CTF</button>
        <button class="filter-tab" data-filter="network" data-target="[data-searchable]">Network</button>
      </div>
    </div>

    <!-- Featured Article -->
    <div class="featured-article card reveal" style="margin-bottom:40px">
      <div class="featured-badge">
        <i class="fa fa-star"></i> Featured Article
      </div>
      <div class="featured-inner">
        <div>
          <div class="tags" style="margin-bottom:12px">
            <span class="tag tag-primary">AI Security</span>
            <span class="tag">20 min read</span>
            <span class="tag">Jul 2026</span>
          </div>
          <h2 style="font-size:1.6rem;color:var(--text-bright);margin-bottom:12px">Building an AI-Powered Threat Intelligence Platform from Scratch</h2>
          <p style="color:var(--text-muted);line-height:1.8;margin-bottom:20px">A complete walkthrough of designing and deploying a machine learning pipeline that aggregates threat feeds, correlates IOCs, and generates human-readable reports using LLMs. Includes full Python source code.</p>
          <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap">
            <a href="#" class="btn btn-primary">Read Article →</a>
            <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-eye"></i> 14,203 views</span>
            <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-heart"></i> 892 likes</span>
          </div>
        </div>
        <div class="featured-art" style="font-family:var(--font-mono);font-size:0.72rem;color:var(--primary);opacity:0.5;line-height:1.7;min-width:200px">
          <div>$ python3 threat_intel.py</div>
          <div style="color:var(--secondary)">Fetching IOCs...</div>
          <div>[████████████] 100%</div>
          <div style="color:#00ff41">✓ 2,847 indicators</div>
          <div style="color:#00ff41">✓ 142 threat actors</div>
          <div style="color:#00ff41">✓ Report generated</div>
          <div>Output: report_2026.pdf</div>
        </div>
      </div>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-3">
      <?php
      $articles = [
        ['title'=>'Advanced Web Cache Poisoning in 2026','cat'=>'web','label'=>'Web Security','time'=>'12 min','date'=>'Jul 15, 2026','views'=>'8.2k','icon'=>'fa-globe','color'=>'var(--primary)','excerpt'=>'Cache poisoning attacks have evolved significantly. Learn the latest techniques, including CPDoS, parameter cloaking, and fat-GET poisoning with real PoCs.'],
        ['title'=>'OSINT Masterclass: Tracking Digital Footprints','cat'=>'osint','label'=>'OSINT','time'=>'15 min','date'=>'Jul 10, 2026','views'=>'11.4k','icon'=>'fa-magnifying-glass','color'=>'var(--secondary)','excerpt'=>'From Google dorks to Shodan, Maltego to custom scrapers — a complete OSINT workflow for investigators and red teamers.'],
        ['title'=>'CTF Writeup: DEFCON 34 Finals — Web Category','cat'=>'ctf','label'=>'CTF','time'=>'25 min','date'=>'Jul 5, 2026','views'=>'6.8k','icon'=>'fa-flag','color'=>'var(--accent)','excerpt'=>'Detailed walkthrough of all web challenges from DEFCON 34 finals, including the tricky JWT algorithm confusion and GraphQL injection chain.'],
        ['title'=>'Malware Reverse Engineering with Ghidra','cat'=>'malware','label'=>'Malware Analysis','time'=>'25 min','date'=>'Jun 28, 2026','views'=>'9.1k','icon'=>'fa-bug','color'=>'var(--primary)','excerpt'=>'Step-by-step guide to unpacking, deobfuscating, and analyzing modern malware samples using Ghidra and x64dbg.'],
        ['title'=>'Red Team Infrastructure: Building a C2 Framework','cat'=>'pentest','label'=>'Pentesting','time'=>'30 min','date'=>'Jun 20, 2026','views'=>'7.3k','icon'=>'fa-terminal','color'=>'var(--secondary)','excerpt'=>'How to build resilient, attribution-resistant command and control infrastructure for red team operations.'],
        ['title'=>'AI Jailbreaking: Prompt Injection in Production LLMs','cat'=>'ai','label'=>'AI Security','time'=>'18 min','date'=>'Jun 15, 2026','views'=>'15.7k','icon'=>'fa-robot','color'=>'var(--accent)','excerpt'=>'Exploring prompt injection, jailbreaking, and model extraction attacks against ChatGPT, Claude, and enterprise LLM deployments.'],
        ['title'=>'Network Packet Analysis: From Wireshark to Zeek','cat'=>'network','label'=>'Network Security','time'=>'20 min','date'=>'Jun 10, 2026','views'=>'5.6k','icon'=>'fa-network-wired','color'=>'var(--primary)','excerpt'=>'Deep dive into network forensics — capturing, filtering, and extracting intelligence from network traffic at scale.'],
        ['title'=>'Zero-Day Research: Finding &amp; Reporting Responsibly','cat'=>'pentest','label'=>'Vulnerability Research','time'=>'22 min','date'=>'Jun 5, 2026','views'=>'12.3k','icon'=>'fa-shield-halved','color'=>'var(--secondary)','excerpt'=>'The complete lifecycle of a zero-day vulnerability: discovery, exploitation, responsible disclosure, and CVE submission.'],
        ['title'=>'Shodan Mastery: Mapping the Internet\'s Attack Surface','cat'=>'osint','label'=>'OSINT','time'=>'16 min','date'=>'May 28, 2026','views'=>'8.9k','icon'=>'fa-satellite','color'=>'var(--accent)','excerpt'=>'Advanced Shodan queries, filters, and automation scripts for mapping attack surfaces during reconnaissance.'],
        ['title'=>'Android App Pentesting: FRIDA Deep Dive','cat'=>'pentest','label'=>'Mobile Security','time'=>'28 min','date'=>'May 20, 2026','views'=>'6.1k','icon'=>'fa-mobile','color'=>'var(--primary)','excerpt'=>'Hooking Android apps with FRIDA to bypass certificate pinning, extract keys, and analyze runtime behavior.'],
        ['title'=>'Building Defensive Tools with Python','cat'=>'pentest','label'=>'Blue Team','time'=>'14 min','date'=>'May 15, 2026','views'=>'4.8k','icon'=>'fa-shield','color'=>'var(--secondary)','excerpt'=>'Automating log analysis, threat hunting, and IOC correlation using Python scripts any SOC analyst can use.'],
        ['title'=>'Blockchain Forensics: Tracing Crypto Transactions','cat'=>'osint','label'=>'Digital Forensics','time'=>'19 min','date'=>'May 10, 2026','views'=>'7.2k','icon'=>'fa-link','color'=>'var(--accent)','excerpt'=>'Techniques for tracing cryptocurrency transactions, de-anonymizing wallets, and supporting law enforcement investigations.'],
      ];
      foreach($articles as $a): ?>
      <article class="card article-card reveal" data-category="<?= $a['cat'] ?>" data-searchable>
        <div class="article-meta">
          <span class="tag tag-primary"><?= $a['label'] ?></span>
          <span style="color:var(--text-muted);font-size:0.77rem"><?= $a['date'] ?></span>
        </div>
        <h3 class="article-title">
          <i class="fa <?= $a['icon'] ?>" style="color:<?= $a['color'] ?>;margin-right:8px"></i>
          <?= $a['title'] ?>
        </h3>
        <p style="color:var(--text-muted);font-size:0.84rem;line-height:1.6;margin:10px 0 14px"><?= $a['excerpt'] ?></p>
        <div class="article-footer">
          <div style="display:flex;gap:12px;align-items:center">
            <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-clock"></i> <?= $a['time'] ?></span>
            <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-eye"></i> <?= $a['views'] ?></span>
          </div>
          <a href="#" class="btn btn-ghost btn-sm">Read →</a>
        </div>
      </article>
      <?php endforeach; ?>
    </div>

    <div style="text-align:center;margin-top:48px" class="reveal">
      <a href="#" class="btn btn-outline">Load More Articles</a>
    </div>
  </div>
</section>

<!-- Newsletter inline -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="newsletter-box reveal" style="max-width:600px;margin:0 auto;text-align:center">
      <div class="section-label">// subscribe --articles</div>
      <h3 style="font-size:1.4rem;margin:12px 0">Get Articles in Your Inbox</h3>
      <p style="color:var(--text-muted);margin-bottom:20px">Weekly security insights delivered every Monday morning.</p>
      <form class="ajax-form" action="/api/subscribe" style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
        <input type="email" name="email" placeholder="your@email.com" required class="form-input" style="max-width:280px" />
        <button type="submit" class="btn btn-primary">Subscribe</button>
      </form>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
