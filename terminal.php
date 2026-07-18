<?php
$page = 'terminal';
$title = 'Terminal';
$description = 'Interactive terminal emulator — Cyber Alpha. Try bash commands, neofetch, and easter eggs.';
require __DIR__ . '/includes/header.php';
?>

<section class="page-hero" style="padding-bottom:24px">
  <div class="container">
    <div class="breadcrumb reveal"><a href="/">~/home</a> <span>/</span> <span>terminal_</span></div>
    <h1 class="page-title reveal glitch" data-text="Terminal">Terminal<span style="color:var(--primary)">_</span></h1>
    <p class="page-subtitle reveal">// bash — interactive session — visitor@cyberalpha.dev</p>
  </div>
</section>

<section style="padding:0 0 40px">
  <div class="container">
    <!-- Hints bar -->
    <div class="card reveal" style="margin-bottom:20px;padding:12px 20px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px">
      <div style="display:flex;gap:16px;flex-wrap:wrap;font-size:0.8rem;color:var(--text-muted)">
        <span><kbd style="background:var(--surface-2);border:1px solid var(--border);padding:2px 6px;border-radius:4px;font-family:var(--font-mono)">Tab</kbd> Autocomplete</span>
        <span><kbd style="background:var(--surface-2);border:1px solid var(--border);padding:2px 6px;border-radius:4px;font-family:var(--font-mono)">↑↓</kbd> History</span>
        <span><kbd style="background:var(--surface-2);border:1px solid var(--border);padding:2px 6px;border-radius:4px;font-family:var(--font-mono)">Ctrl+L</kbd> Clear</span>
        <span><kbd style="background:var(--surface-2);border:1px solid var(--border);padding:2px 6px;border-radius:4px;font-family:var(--font-mono)">Ctrl+C</kbd> Cancel</span>
      </div>
      <div style="display:flex;gap:10px;flex-wrap:wrap;font-size:0.8rem">
        <span style="color:var(--text-muted)">Try:</span>
        <?php foreach(['help','neofetch','skills','projects','hack','matrix','nmap localhost'] as $cmd): ?>
        <button onclick="runTermCmd('<?= $cmd ?>')" style="background:none;border:1px solid var(--border);color:var(--primary);font-family:var(--font-mono);font-size:0.75rem;padding:2px 8px;border-radius:4px;cursor:pointer;transition:all 0.2s" onmouseover="this.style.borderColor='var(--primary)'" onmouseout="this.style.borderColor='var(--border)'"><?= $cmd ?></button>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Full-Page Terminal -->
    <div id="fullTerminalContainer" class="reveal"></div>
  </div>
</section>

<!-- Tips section -->
<section class="section" style="background:var(--surface)">
  <div class="container">
    <div class="section-header reveal">
      <div class="section-label">// terminal_commands</div>
      <h2 class="section-title" style="font-size:1.4rem">Command Reference</h2>
    </div>
    <div class="grid grid-3">
      <?php
      $cmdGroups = [
        ['title'=>'Profile Commands','color'=>'var(--primary)','cmds'=>[
          ['whoami','Show user info'],
          ['neofetch','System &amp; profile (like neofetch)'],
          ['about','About Cyber Alpha'],
          ['skills','Technical skills with bars'],
          ['projects','Featured projects'],
          ['contact','Contact information'],
        ]],
        ['title'=>'System Commands','color'=>'var(--secondary)','cmds'=>[
          ['ls [path]','List directory contents'],
          ['cd [dir]','Change directory'],
          ['cat [file]','View file contents'],
          ['pwd','Print working directory'],
          ['echo [text]','Print to terminal'],
          ['history','Show command history'],
          ['clear / Ctrl+L','Clear terminal'],
        ]],
        ['title'=>'Hacker Tools','color'=>'var(--accent)','cmds'=>[
          ['nmap [host]','Network scan (simulated)'],
          ['ping [host]','Ping with output'],
          ['curl [url]','HTTP request (simulated)'],
          ['hashcat','Password cracking demo'],
          ['python3','Python REPL (simulated)'],
          ['hack','[ CLASSIFIED ] 🔐'],
          ['matrix','Toggle matrix rain'],
        ]],
        ['title'=>'Terminal Config','color'=>'var(--primary)','cmds'=>[
          ['theme green','Switch to green theme'],
          ['theme amber','Switch to amber/retro'],
          ['theme blue','Switch to cyber blue'],
          ['theme white','Switch to white theme'],
          ['theme matrix','Matrix rain theme'],
          ['banner','Show ASCII banner'],
          ['man [cmd]','Show command manual'],
        ]],
        ['title'=>'Filesystem','color'=>'var(--secondary)','cmds'=>[
          ['ls ~/articles','View articles'],
          ['ls ~/projects','View projects'],
          ['ls ~/research','View research'],
          ['ls ~/resources','View resources'],
          ['cat about.txt','Read about file'],
          ['cat skills.json','View skills JSON'],
          ['cd ..','Go up directory'],
        ]],
        ['title'=>'Fun &amp; Easter Eggs','color'=>'var(--accent)','cmds'=>[
          ['hack','⚠️ Classified operation'],
          ['uname -a','Full system info'],
          ['date','Current timestamp'],
          ['banner','Cyber Alpha ASCII art'],
          ['neofetch','Full system + ASCII'],
          ['ping 8.8.8.8','Ping Google DNS'],
          ['curl api','API status'],
        ]],
      ];
      foreach($cmdGroups as $grp): ?>
      <div class="card reveal">
        <h4 style="color:<?= $grp['color'] ?>;font-family:var(--font-mono);font-size:0.85rem;margin-bottom:14px;border-bottom:1px solid var(--border);padding-bottom:8px"><?= $grp['title'] ?></h4>
        <?php foreach($grp['cmds'] as [$cmd,$desc]): ?>
        <div style="display:flex;gap:10px;padding:4px 0;font-size:0.8rem">
          <code style="color:<?= $grp['color'] ?>;min-width:120px;font-size:0.78rem;white-space:nowrap"><?= $cmd ?></code>
          <span style="color:var(--text-muted)"><?= $desc ?></span>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script>
// Boot the full-page terminal
document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById('fullTerminalContainer');
  if (container && typeof CyberAlphaTerminal !== 'undefined') {
    window.fullTerm = new CyberAlphaTerminal(container, { theme: 'green', fullPage: true });
    // Make terminal tall
    const term = container.querySelector('.terminal');
    if (term) term.style.height = 'calc(100vh - 360px)';
    const body = container.querySelector('#termBody');
    if (body) body.style.height = 'calc(100vh - 460px)';
  }
});

function runTermCmd(cmd) {
  if (window.fullTerm) {
    window.fullTerm.input.value = cmd;
    window.fullTerm.input.focus();
    // Auto-execute
    const event = new KeyboardEvent('keydown', { key: 'Enter', bubbles: true });
    window.fullTerm.input.dispatchEvent(event);
  }
}
</script>

<?php require __DIR__ . '/includes/footer.php'; ?>
