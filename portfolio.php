<?php
$page = 'portfolio';
$title = 'Portfolio';
$description = 'Professional portfolio of Abdullah Ismail — Cyber Alpha. Security consulting, AI development, and education work.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>portfolio</span></div>
    <h1 class="page-title reveal glitch" data-text="Portfolio">Portfolio</h1>
    <p class="page-subtitle reveal">// cat resume.json | jq '.experience[] | .highlights'</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <!-- Download Resume -->
    <div class="card reveal" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;margin-bottom:40px;border-color:var(--primary)">
      <div>
        <h3 style="color:var(--text-bright);margin-bottom:4px">Abdullah Ismail — Resume / CV</h3>
        <p style="color:var(--text-muted);font-size:0.85rem">Updated July 2026 · PDF · 2 pages</p>
      </div>
      <div style="display:flex;gap:12px">
        <a href="#" class="btn btn-primary"><i class="fa fa-download"></i> Download CV</a>
        <a href="/contact" class="btn btn-outline">Hire Me</a>
      </div>
    </div>

    <!-- Services -->
    <div class="section-label reveal" style="margin-bottom:24px">// services_offered</div>
    <div class="grid grid-3" style="margin-bottom:48px">
      <?php
      $services = [
        ['title'=>'Penetration Testing','icon'=>'fa-terminal','color'=>'var(--primary)','price'=>'From $150/hr','desc'=>'Web app, network, mobile, and cloud penetration testing with professional reporting and remediation guidance.','items'=>['OWASP Top 10','API Security','Network Pentesting','Cloud Security','Social Engineering','Red Team Ops']],
        ['title'=>'Security Consulting','icon'=>'fa-shield-halved','color'=>'var(--secondary)','price'=>'From $200/hr','desc'=>'Strategic security advisory for startups and enterprises — architecture review, threat modeling, and security program development.','items'=>['Architecture Review','Threat Modeling','Security Program Design','CISO Advisory','Vendor Assessment','Compliance Guidance']],
        ['title'=>'AI Security Development','icon'=>'fa-robot','color'=>'var(--accent)','price'=>'Project-based','desc'=>'Building ML-powered security tools — threat detection, anomaly analysis, phishing classifiers, and automated security pipelines.','items'=>['Threat Detection ML','Anomaly Detection','Security Automation','LLM Integration','MLSecOps','Custom Tooling']],
        ['title'=>'Security Training','icon'=>'fa-graduation-cap','color'=>'var(--primary)','price'=>'From $2,000/day','desc'=>'Corporate security training, hands-on workshops, and custom curriculum development for developer and security teams.','items'=>['Secure Coding','Pentest Basics','Phishing Awareness','Red Team Training','CTF Coaching','SAST/DAST Training']],
        ['title'=>'Code Review & Audit','icon'=>'fa-code','color'=>'var(--secondary)','price'=>'From $100/hr','desc'=>'In-depth source code security review for web apps, APIs, and mobile applications. SAST analysis plus manual review.','items'=>['SAST Analysis','Manual Code Review','API Security Audit','Dependency Audit','Secrets Detection','SBOM Generation']],
        ['title'=>'Speaking & Keynotes','icon'=>'fa-microphone','color'=>'var(--accent)','price'=>'Contact for quote','desc'=>'Conference talks, corporate keynotes, university guest lectures, and online webinars on cybersecurity and AI topics.','items'=>['Conference Talks','Corporate Keynotes','University Lectures','Webinars','Podcast Appearances','Panel Discussions']],
      ];
      foreach($services as $svc): ?>
      <div class="card card-hover reveal">
        <div class="card-icon"><i class="fa <?= $svc['icon'] ?>" style="color:<?= $svc['color'] ?>"></i></div>
        <h3 class="card-title"><?= $svc['title'] ?></h3>
        <p class="card-desc"><?= $svc['desc'] ?></p>
        <div style="margin:12px 0">
          <?php foreach($svc['items'] as $item): ?>
          <div style="font-size:0.8rem;color:var(--text-dim);display:flex;align-items:center;gap:6px;padding:3px 0">
            <i class="fa fa-check" style="color:<?= $svc['color'] ?>;font-size:0.65rem"></i> <?= $item ?>
          </div>
          <?php endforeach; ?>
        </div>
        <div style="border-top:1px solid var(--border);padding-top:12px;margin-top:4px;display:flex;justify-content:space-between;align-items:center">
          <span style="color:<?= $svc['color'] ?>;font-family:var(--font-mono);font-size:0.85rem"><?= $svc['price'] ?></span>
          <a href="/contact" class="btn btn-outline btn-sm">Inquire</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Notable Clients / Engagements -->
    <div class="section-label reveal" style="margin-bottom:24px">// notable_engagements --anonymized</div>
    <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:48px">
      <?php
      $engagements = [
        ['type'=>'Red Team Engagement','industry'=>'Financial Services','scope'=>'Full infrastructure red team assessment for a European bank with 50k+ employees. Simulated APT attack chain including phishing, lateral movement, and data exfiltration.','outcome'=>'Identified 23 critical findings, all remediated. Helped avoid potential €50M+ regulatory fine.','icon'=>'fa-landmark','color'=>'var(--primary)'],
        ['type'=>'AI Security Audit','industry'=>'Healthcare Technology','scope'=>'Security audit of an AI-powered medical diagnosis platform. Reviewed ML model security, data pipeline integrity, and adversarial robustness of diagnostic models.','outcome'=>'Found 3 critical model vulnerabilities. Improved adversarial robustness by 67% post-remediation.','icon'=>'fa-hospital','color'=>'var(--secondary)'],
        ['type'=>'Security Training Program','industry'=>'Government Agency','scope'=>'Designed and delivered a 3-month security awareness and technical training program for 200+ IT staff at a national government cybersecurity agency.','outcome'=>'Phishing click rate reduced by 82%. Team certified in penetration testing fundamentals.','icon'=>'fa-building-columns','color'=>'var(--accent)'],
        ['type'=>'Penetration Test','industry'=>'E-Commerce Platform','scope'=>'Black-box web application and API penetration test for a platform processing $500M+ in annual transactions.','outcome'=>'Discovered authentication bypass affecting all user accounts. Critical patch deployed within 48 hours.','icon'=>'fa-cart-shopping','color'=>'var(--primary)'],
      ];
      foreach($engagements as $eng): ?>
      <div class="card card-hover reveal">
        <div style="display:flex;align-items:flex-start;gap:16px">
          <div style="width:44px;height:44px;background:color-mix(in srgb, <?= $eng['color'] ?> 12%, transparent);border:1px solid <?= $eng['color'] ?>;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <i class="fa <?= $eng['icon'] ?>" style="color:<?= $eng['color'] ?>"></i>
          </div>
          <div>
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:8px">
              <span class="tag" style="border-color:<?= $eng['color'] ?>;color:<?= $eng['color'] ?>"><?= $eng['type'] ?></span>
              <span class="tag"><?= $eng['industry'] ?></span>
              <span class="tag" style="border-color:#00ff41;color:var(--text-muted)">Completed</span>
            </div>
            <p style="color:var(--text-muted);font-size:0.85rem;line-height:1.6;margin-bottom:10px"><strong style="color:var(--text-bright)">Scope:</strong> <?= $eng['scope'] ?></p>
            <p style="color:#00ff41;font-size:0.82rem;font-family:var(--font-mono)"><i class="fa fa-check-circle"></i> <?= $eng['outcome'] ?></p>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Testimonials -->
    <div class="section-label reveal" style="margin-bottom:24px">// client_testimonials</div>
    <div class="grid grid-3">
      <?php
      $testimonials = [
        ['name'=>'Sarah K.','role'=>'CISO, FinTech Startup','text'=>'Abdullah\'s security audit was transformative. He found critical vulnerabilities our internal team had missed for months. Professional, thorough, and communicative throughout.','icon'=>'fa-quote-left','color'=>'var(--primary)'],
        ['name'=>'Marcus R.','role'=>'CTO, Healthcare AI Company','text'=>'The ML security review was exceptional. His understanding of both AI systems and security made the engagement uniquely valuable. Highly recommend for any AI product team.','icon'=>'fa-quote-left','color'=>'var(--secondary)'],
        ['name'=>'Prof. Amira S.','role'=>'University Department Head','text'=>'Abdullah delivered the best cybersecurity workshop our students have experienced. His ability to make complex concepts accessible while keeping it technically rigorous is rare.','icon'=>'fa-quote-left','color'=>'var(--accent)'],
      ];
      foreach($testimonials as $t): ?>
      <div class="card reveal" style="position:relative">
        <i class="fa <?= $t['icon'] ?>" style="color:<?= $t['color'] ?>;font-size:1.8rem;opacity:0.3;position:absolute;top:20px;right:20px"></i>
        <p style="color:var(--text-muted);font-style:italic;line-height:1.7;margin-bottom:16px">"<?= $t['text'] ?>"</p>
        <div>
          <div style="color:var(--text-bright);font-weight:600"><?= $t['name'] ?></div>
          <div style="color:<?= $t['color'] ?>;font-size:0.82rem;font-family:var(--font-mono)"><?= $t['role'] ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section" style="background:var(--surface);text-align:center">
  <div class="container reveal">
    <div class="section-label">// next_step --contact</div>
    <h2 class="section-title">Ready to Work Together?</h2>
    <p class="section-subtitle">Let's discuss your security needs. Initial consultation is always free.</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
      <a href="/contact" class="btn btn-primary">./start_conversation.sh</a>
      <a href="#" class="btn btn-outline"><i class="fa fa-download"></i> Download CV</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
