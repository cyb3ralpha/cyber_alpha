<?php
$page = 'contact';
$title = 'Contact';
$description = 'Contact Abdullah Ismail — Cyber Alpha. Available for consulting, speaking, mentorship, and collaboration.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>contact</span></div>
    <h1 class="page-title reveal glitch" data-text="Contact">Contact</h1>
    <p class="page-subtitle reveal">// ./send_message.sh --to cyber_alpha --priority high</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="contact-grid">

      <!-- Left: Info -->
      <div class="contact-info reveal">
        <div class="card" style="margin-bottom:24px">
          <div class="section-label" style="margin-bottom:16px">// availability_status</div>
          <div style="display:flex;align-items:center;gap:10px;padding:12px 0;border-bottom:1px solid var(--border)">
            <span style="width:10px;height:10px;background:#00ff41;border-radius:50%;display:inline-block;animation:blink 1.5s infinite"></span>
            <span style="color:var(--text-bright)">Available for New Projects</span>
          </div>
          <div style="padding:12px 0;border-bottom:1px solid var(--border);display:flex;justify-content:space-between">
            <span style="color:var(--text-muted)">Response Time</span>
            <span style="color:var(--primary);font-family:var(--font-mono)">&lt; 24 hours</span>
          </div>
          <div style="padding:12px 0;border-bottom:1px solid var(--border);display:flex;justify-content:space-between">
            <span style="color:var(--text-muted)">Timezone</span>
            <span style="color:var(--text-bright);font-family:var(--font-mono)">UTC (Flexible)</span>
          </div>
          <div style="padding:12px 0;display:flex;justify-content:space-between">
            <span style="color:var(--text-muted)">Languages</span>
            <span style="color:var(--text-bright)">English · Arabic</span>
          </div>
        </div>

        <div class="card" style="margin-bottom:24px">
          <div class="section-label" style="margin-bottom:16px">// contact_channels</div>
          <?php
          $channels = [
            ['icon'=>'fa-envelope','label'=>'Email','value'=>'contact@cyberalpha.dev','href'=>'mailto:contact@cyberalpha.dev','color'=>'var(--primary)'],
            ['icon'=>'fab fa-linkedin','label'=>'LinkedIn','value'=>'/in/cyberalpha','href'=>'https://linkedin.com/in/cyberalpha','color'=>'#0077b5'],
            ['icon'=>'fab fa-github','label'=>'GitHub','value'=>'@cyberalpha','href'=>'https://github.com/cyberalpha','color'=>'var(--text-bright)'],
            ['icon'=>'fab fa-twitter','label'=>'Twitter/X','value'=>'@CyberAlpha_dev','href'=>'https://twitter.com/CyberAlpha_dev','color'=>'#1DA1F2'],
            ['icon'=>'fab fa-discord','label'=>'Discord','value'=>'CyberAlpha#0001','href'=>'https://discord.gg/cyberalpha','color'=>'#7289DA'],
            ['icon'=>'fab fa-youtube','label'=>'YouTube','value'=>'@cyberalpha','href'=>'https://youtube.com/@cyberalpha','color'=>'#ff0000'],
          ];
          foreach($channels as $ch): ?>
          <a href="<?= $ch['href'] ?>" target="_blank" rel="noopener" style="display:flex;align-items:center;gap:14px;padding:10px 0;border-bottom:1px solid var(--border);text-decoration:none;transition:all 0.2s" class="contact-channel-link">
            <div style="width:36px;height:36px;background:color-mix(in srgb, <?= $ch['color'] ?> 12%, transparent);border:1px solid <?= $ch['color'] ?>;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
              <i class="<?= $ch['icon'] ?>" style="color:<?= $ch['color'] ?>"></i>
            </div>
            <div>
              <div style="color:var(--text-muted);font-size:0.75rem"><?= $ch['label'] ?></div>
              <div style="color:var(--text-bright);font-size:0.9rem;font-family:var(--font-mono)"><?= $ch['value'] ?></div>
            </div>
            <i class="fa fa-arrow-up-right-from-square" style="color:var(--text-muted);font-size:0.75rem;margin-left:auto"></i>
          </a>
          <?php endforeach; ?>
        </div>

        <div class="card">
          <div class="section-label" style="margin-bottom:16px">// open_to</div>
          <?php
          $openTo = [
            ['icon'=>'fa-shield-halved','text'=>'Security Consulting','color'=>'var(--primary)'],
            ['icon'=>'fa-microphone','text'=>'Speaking & Keynotes','color'=>'var(--secondary)'],
            ['icon'=>'fa-users','text'=>'Mentorship Programs','color'=>'var(--accent)'],
            ['icon'=>'fa-code-branch','text'=>'Open Source Collaboration','color'=>'var(--primary)'],
            ['icon'=>'fa-graduation-cap','text'=>'Security Training','color'=>'var(--secondary)'],
            ['icon'=>'fa-pen-nib','text'=>'Technical Writing','color'=>'var(--accent)'],
          ];
          foreach($openTo as $item): ?>
          <div style="display:flex;align-items:center;gap:10px;padding:7px 0;font-size:0.85rem">
            <i class="fa <?= $item['icon'] ?>" style="color:<?= $item['color'] ?>;width:16px;text-align:center"></i>
            <span><?= $item['text'] ?></span>
          </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right: Form -->
      <div class="contact-form-wrap reveal">
        <div class="card">
          <div class="section-label" style="margin-bottom:20px">// compose_message</div>

          <form class="ajax-form contact-form" action="/api/contact" method="POST">
            <!-- Type selector -->
            <div class="form-group">
              <label class="form-label">Message Type</label>
              <div class="type-grid">
                <?php
                $types = [
                  ['val'=>'consulting','label'=>'Consulting','icon'=>'fa-shield-halved'],
                  ['val'=>'speaking','label'=>'Speaking','icon'=>'fa-microphone'],
                  ['val'=>'mentorship','label'=>'Mentorship','icon'=>'fa-users'],
                  ['val'=>'general','label'=>'General','icon'=>'fa-comment'],
                  ['val'=>'bug','label'=>'Bug Report','icon'=>'fa-bug'],
                  ['val'=>'collaboration','label'=>'Collaboration','icon'=>'fa-handshake'],
                ];
                foreach($types as $t): ?>
                <label class="type-option">
                  <input type="radio" name="type" value="<?= $t['val'] ?>" <?= $t['val']==='general'?'checked':'' ?> />
                  <div class="type-box">
                    <i class="fa <?= $t['icon'] ?>"></i>
                    <span><?= $t['label'] ?></span>
                  </div>
                </label>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="cName">Name *</label>
                <input type="text" id="cName" name="name" placeholder="Your name" required class="form-input" />
              </div>
              <div class="form-group">
                <label class="form-label" for="cEmail">Email *</label>
                <input type="email" id="cEmail" name="email" placeholder="your@email.com" required class="form-input" />
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="cSubject">Subject</label>
              <input type="text" id="cSubject" name="subject" placeholder="What's this about?" class="form-input" />
            </div>

            <div class="form-group">
              <label class="form-label" for="cMsg">Message *</label>
              <textarea id="cMsg" name="message" rows="6" placeholder="Describe what you'd like to discuss, your project details, timeline, and any relevant context..." required class="form-input"></textarea>
            </div>

            <div class="form-group" style="display:flex;align-items:center;gap:12px;font-size:0.82rem;color:var(--text-muted)">
              <input type="checkbox" id="cConsent" required style="accent-color:var(--primary)" />
              <label for="cConsent">I agree that my data will be used only to respond to this message, and will not be shared with third parties.</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px">
              <i class="fa fa-paper-plane"></i> ./send_message.sh
            </button>
          </form>
        </div>

        <!-- Newsletter signup -->
        <div class="card" style="margin-top:20px">
          <div class="section-label" style="margin-bottom:12px">// newsletter --subscribe</div>
          <p style="color:var(--text-muted);font-size:0.85rem;margin-bottom:16px">Get weekly security insights, CTF writeups, and new tools in your inbox. Free, forever.</p>
          <form class="ajax-form" action="/api/subscribe" style="display:flex;gap:12px;flex-wrap:wrap">
            <input type="text" name="name" placeholder="Your name (optional)" class="form-input" style="flex:1;min-width:140px" />
            <input type="email" name="email" placeholder="your@email.com" required class="form-input" style="flex:2;min-width:180px" />
            <button type="submit" class="btn btn-outline" style="white-space:nowrap">Subscribe</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// faq --common-questions</div>
      <h2 class="section-title">Common Questions</h2>
    </div>
    <div class="grid grid-2">
      <?php
      $faqs = [
        ['q'=>'What is your typical response time?','a'=>'I respond to all messages within 24 hours, usually much faster. For urgent security matters, mention "URGENT" in the subject.'],
        ['q'=>'Do you work with startups and small businesses?','a'=>'Absolutely. I work with clients of all sizes, from solo founders to enterprise teams. Rates are flexible for early-stage startups.'],
        ['q'=>'Can you sign an NDA before discussing projects?','a'=>'Yes. Happy to sign NDAs for consulting engagements. Just mention it in your message and I\'ll prepare one promptly.'],
        ['q'=>'Do you offer pro-bono work?','a'=>'I occasionally offer discounted or free services to nonprofits, open source projects, and security researchers with demonstrated need.'],
        ['q'=>'What does your consulting process look like?','a'=>'Initial free consultation → Scope definition → Proposal & agreement → Execution → Report & debrief → Follow-up support.'],
        ['q'=>'Can you be a guest on podcasts or webinars?','a'=>'Yes! I enjoy podcast appearances and webinars. Reach out with your show details and topic ideas.'],
      ];
      foreach($faqs as $faq): ?>
      <div class="card card-hover reveal">
        <h4 style="color:var(--primary);font-family:var(--font-mono);font-size:0.85rem;margin-bottom:8px">
          <i class="fa fa-chevron-right" style="margin-right:6px"></i><?= $faq['q'] ?>
        </h4>
        <p style="color:var(--text-muted);font-size:0.86rem;line-height:1.6"><?= $faq['a'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
