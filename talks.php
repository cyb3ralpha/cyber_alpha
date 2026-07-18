<?php
$page = 'talks';
$title = 'Talks & Events';
$description = 'Conference talks, keynotes, workshops, and webinars by Cyber Alpha — Abdullah Ismail.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>talks</span></div>
    <h1 class="page-title reveal glitch" data-text="Talks & Events">Talks &amp; Events</h1>
    <p class="page-subtitle reveal">// grep "cyber_alpha" conference_schedule.ics — Keynotes, workshops &amp; webinars</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="stats-grid reveal" style="grid-template-columns:repeat(4,1fr);margin-bottom:48px">
      <div class="stat-item"><div class="stat-number" data-count="38">0</div><div class="stat-label">Talks Given</div></div>
      <div class="stat-item"><div class="stat-number" data-count="18">0</div><div class="stat-label">Countries</div></div>
      <div class="stat-item"><div class="stat-number" data-count="15000">0</div><div class="stat-label">Total Audience</div></div>
      <div class="stat-item"><div class="stat-number" data-count="12">0</div><div class="stat-label">Workshops</div></div>
    </div>

    <!-- Upcoming Talks -->
    <div class="section-label reveal" style="margin-bottom:24px">// upcoming_events --scheduled</div>
    <div style="display:flex;flex-direction:column;gap:16px;margin-bottom:48px">
      <?php
      $upcoming = [
        ['title'=>'AI Jailbreaking in Production: Beyond the Lab','event'=>'DEF CON 35','type'=>'Conference Talk','date'=>'Aug 8, 2026','location'=>'Las Vegas, NV, USA','format'=>'In-Person','duration'=>'45 min','color'=>'var(--primary)','icon'=>'fa-microphone'],
        ['title'=>'Zero-Day Research Methodology: From Discovery to Disclosure','event'=>'Black Hat USA 2026','type'=>'Briefing','date'=>'Aug 5, 2026','location'=>'Las Vegas, NV, USA','format'=>'In-Person','duration'=>'60 min','color'=>'var(--secondary)','icon'=>'fa-shield-halved'],
        ['title'=>'Building Secure AI Systems: A Practitioner\'s Guide','event'=>'RSA Conference 2027','type'=>'Keynote','date'=>'Feb 12, 2027','location'=>'San Francisco, CA, USA','format'=>'In-Person','duration'=>'30 min','color'=>'var(--accent)','icon'=>'fa-robot'],
      ];
      foreach($upcoming as $talk): ?>
      <div class="card card-hover reveal" style="border-color:<?= $talk['color'] ?>;border-left:3px solid <?= $talk['color'] ?>">
        <div style="display:flex;align-items:flex-start;gap:16px;flex-wrap:wrap">
          <div style="width:48px;height:48px;background:color-mix(in srgb, <?= $talk['color'] ?> 12%, transparent);border:1px solid <?= $talk['color'] ?>;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0">
            <i class="fa <?= $talk['icon'] ?>" style="color:<?= $talk['color'] ?>"></i>
          </div>
          <div style="flex:1">
            <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;margin-bottom:8px">
              <span class="tag" style="background:color-mix(in srgb, #00ff41 10%, transparent);border-color:#00ff41;color:#00ff41">Upcoming</span>
              <span class="tag" style="border-color:<?= $talk['color'] ?>;color:<?= $talk['color'] ?>"><?= $talk['type'] ?></span>
              <span class="tag"><?= $talk['format'] ?></span>
            </div>
            <h3 style="color:var(--text-bright);font-size:1.05rem;margin-bottom:6px"><?= $talk['title'] ?></h3>
            <div style="display:flex;gap:16px;flex-wrap:wrap">
              <span style="color:var(--secondary);font-family:var(--font-mono);font-size:0.82rem"><i class="fa fa-calendar" style="margin-right:4px"></i><?= $talk['date'] ?></span>
              <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-location-dot" style="margin-right:4px"></i><?= $talk['location'] ?></span>
              <span style="color:var(--text-muted);font-size:0.82rem"><i class="fa fa-clock" style="margin-right:4px"></i><?= $talk['duration'] ?></span>
              <span style="color:var(--primary);font-weight:600;font-size:0.82rem"><?= $talk['event'] ?></span>
            </div>
          </div>
          <a href="/contact" class="btn btn-outline btn-sm">Invite to Speak</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Past Talks -->
    <div class="section-label reveal" style="margin-bottom:24px">// past_talks --with-slides --with-video</div>
    <div class="grid grid-2" style="margin-bottom:48px">
      <?php
      $past = [
        ['title'=>'Web Cache Poisoning at Scale: New Attack Primitives','event'=>'USENIX Security 2026','date'=>'Jan 2026','location'=>'Boston, MA','views'=>'24,100','icon'=>'fa-globe','color'=>'var(--primary)','slides'=>true,'video'=>true,'desc'=>'Presented three novel web cache poisoning techniques discovered during a large-scale study of Fortune 500 applications.'],
        ['title'=>'Adversarial AI: Fooling ML-Based Security Systems','event'=>'Black Hat Europe 2025','date'=>'Dec 2025','location'=>'London, UK','views'=>'18,700','icon'=>'fa-robot','color'=>'var(--secondary)','slides'=>true,'video'=>true,'desc'=>'Demonstrated live evasion of six commercial AI-powered security products using adversarial examples and model inversion.'],
        ['title'=>'OSINT at Scale: Mapping Nation-State Infrastructure','event'=>'DEF CON 33','date'=>'Aug 2025','location'=>'Las Vegas, NV','views'=>'31,400','icon'=>'fa-magnifying-glass','color'=>'var(--accent)','slides'=>true,'video'=>true,'desc'=>'Methodology for mapping internet-exposed infrastructure attributed to nation-state threat actors using open-source data.'],
        ['title'=>'The Bug Bounty Mindset: How to Think Like an Attacker','event'=>'Nullcon 2025','date'=>'Mar 2025','location'=>'Goa, India','views'=>'12,800','icon'=>'fa-bug','color'=>'var(--primary)','slides'=>true,'video'=>false,'desc'=>'Interactive workshop on developing the attacker mindset for web application security testing and bug bounty hunting.'],
        ['title'=>'Building Your First Malware Analysis Lab','event'=>'SecurityFest 2024','date'=>'Oct 2024','location'=>'Gothenburg, Sweden','views'=>'9,200','icon'=>'fa-flask','color'=>'var(--secondary)','slides'=>true,'video'=>true,'desc'=>'Hands-on workshop building a safe, isolated malware analysis environment using free tools and open-source software.'],
        ['title'=>'CTF as a Learning Tool: Competitive Security Education','event'=>'Hack In The Box 2024','date'=>'Jul 2024','location'=>'Amsterdam, Netherlands','views'=>'7,600','icon'=>'fa-flag','color'=>'var(--accent)','slides'=>true,'video'=>false,'desc'=>'Keynote on using CTF competitions as structured learning vehicles for both beginners and advanced security professionals.'],
      ];
      foreach($past as $talk): ?>
      <div class="card card-hover reveal">
        <div style="display:flex;align-items:flex-start;gap:12px;margin-bottom:14px">
          <div style="width:40px;height:40px;background:color-mix(in srgb, <?= $talk['color'] ?> 12%, transparent);border:1px solid <?= $talk['color'] ?>;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
            <i class="fa <?= $talk['icon'] ?>" style="color:<?= $talk['color'] ?>"></i>
          </div>
          <div>
            <h4 style="color:var(--text-bright);font-size:0.95rem;line-height:1.4;margin-bottom:4px"><?= $talk['title'] ?></h4>
            <div style="color:<?= $talk['color'] ?>;font-family:var(--font-mono);font-size:0.78rem"><?= $talk['event'] ?></div>
          </div>
        </div>
        <p style="color:var(--text-muted);font-size:0.82rem;line-height:1.6;margin-bottom:12px"><?= $talk['desc'] ?></p>
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
          <div style="display:flex;gap:12px;flex-wrap:wrap">
            <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-calendar"></i> <?= $talk['date'] ?></span>
            <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-location-dot"></i> <?= $talk['location'] ?></span>
            <span style="color:var(--text-muted);font-size:0.78rem"><i class="fa fa-eye"></i> <?= $talk['views'] ?></span>
          </div>
          <div style="display:flex;gap:8px">
            <?php if($talk['slides']): ?><a href="#" class="btn btn-ghost btn-sm"><i class="fa fa-presentation-screen"></i> Slides</a><?php endif; ?>
            <?php if($talk['video']): ?><a href="#" class="btn btn-outline btn-sm"><i class="fa fa-play"></i> Watch</a><?php endif; ?>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Workshops -->
    <div class="section-label reveal" style="margin-bottom:24px">// workshops --hands-on</div>
    <div class="grid grid-3">
      <?php
      $workshops = [
        ['title'=>'Web Application Hacking Bootcamp','duration'=>'Full Day (8h)','capacity'=>30,'price'=>'Free','icon'=>'fa-globe','color'=>'var(--primary)'],
        ['title'=>'OSINT Investigation Workshop','duration'=>'Half Day (4h)','capacity'=>20,'price'=>'Free','icon'=>'fa-magnifying-glass','color'=>'var(--secondary)'],
        ['title'=>'Malware Analysis Fundamentals','duration'=>'Full Day (8h)','capacity'=>15,'price'=>'Free','icon'=>'fa-bug','color'=>'var(--accent)'],
      ];
      foreach($workshops as $ws): ?>
      <div class="card card-hover reveal">
        <div class="card-icon"><i class="fa <?= $ws['icon'] ?>" style="color:<?= $ws['color'] ?>"></i></div>
        <h3 class="card-title"><?= $ws['title'] ?></h3>
        <div class="tags" style="margin-bottom:12px">
          <span class="tag"><?= $ws['duration'] ?></span>
          <span class="tag">Max <?= $ws['capacity'] ?> attendees</span>
          <span class="tag" style="border-color:#00ff41;color:#00ff41"><?= $ws['price'] ?></span>
        </div>
        <a href="/contact" class="btn btn-outline btn-sm" style="width:100%;justify-content:center">Request Workshop</a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Speaking CTA -->
<section class="section" style="background:var(--surface);text-align:center">
  <div class="container reveal">
    <div class="section-label">// invite --speaker</div>
    <h2 class="section-title">Invite Cyber Alpha to Speak</h2>
    <p class="section-subtitle">Available for conferences, corporate training, university lectures, and online webinars. Topics include web security, AI, OSINT, and CTF methodology.</p>
    <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;margin-top:24px">
      <a href="/contact" class="btn btn-primary"><i class="fa fa-microphone"></i> Book a Talk</a>
      <a href="/contact" class="btn btn-outline">Request Workshop</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
