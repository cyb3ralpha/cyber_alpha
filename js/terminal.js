/* ============================================================
   CYBER ALPHA — Terminal Emulator (Full Featured)
   ============================================================ */

class CyberAlphaTerminal {
  constructor(containerEl, options = {}) {
    this.container = containerEl;
    this.theme = options.theme || localStorage.getItem('term-theme') || 'green';
    this.history = [];
    this.historyIndex = -1;
    this.cwd = '/home/cyberalpha';
    this.user = 'visitor';
    this.host = 'cyberalpha.dev';
    this.suggestions = [];
    this.commands = this.getCommands();
    this.init();
  }

  getCommands() {
    return {
      help: { desc: 'Show available commands', fn: () => this.help() },
      whoami: { desc: 'Display current user info', fn: () => this.whoami() },
      neofetch: { desc: 'System & profile info (like neofetch)', fn: () => this.neofetch() },
      about: { desc: 'About Abdullah Ismail / Cyber Alpha', fn: () => this.about() },
      skills: { desc: 'List technical skills', fn: () => this.skills() },
      projects: { desc: 'Show projects', fn: () => this.projects() },
      contact: { desc: 'Contact information', fn: () => this.contact() },
      ls: { desc: 'List directory contents', fn: (args) => this.ls(args) },
      cat: { desc: 'Display file contents', fn: (args) => this.cat(args) },
      cd: { desc: 'Change directory', fn: (args) => this.cd(args) },
      pwd: { desc: 'Print working directory', fn: () => this.pwd() },
      clear: { desc: 'Clear terminal screen', fn: () => this.clear() },
      echo: { desc: 'Print text to terminal', fn: (args) => this.echo(args) },
      date: { desc: 'Show current date and time', fn: () => this.dateCmd() },
      uname: { desc: 'Print system information', fn: (args) => this.uname(args) },
      ping: { desc: 'Ping a host', fn: (args) => this.ping(args) },
      curl: { desc: 'Fetch a URL (simulated)', fn: (args) => this.curlCmd(args) },
      nmap: { desc: 'Network scan (simulated)', fn: (args) => this.nmap(args) },
      hashcat: { desc: 'Password cracking (simulated)', fn: () => this.hashcat() },
      python3: { desc: 'Python interpreter (simulated)', fn: () => this.python3() },
      git: { desc: 'Git commands (simulated)', fn: (args) => this.git(args) },
      hack: { desc: '[ CLASSIFIED ]', fn: () => this.hack() },
      matrix: { desc: 'Toggle matrix rain effect', fn: () => this.matrixCmd() },
      theme: { desc: 'Change terminal theme: theme [green|amber|blue|white|matrix]', fn: (args) => this.changeTheme(args) },
      banner: { desc: 'Show Cyber Alpha banner', fn: () => this.banner() },
      exit: { desc: 'Close terminal', fn: () => this.exit() },
      man: { desc: 'Show manual page for a command', fn: (args) => this.man(args) },
      history: { desc: 'Show command history', fn: () => this.showHistory() },
    };
  }

  init() {
    this.render();
    this.bindEvents();
    this.container.setAttribute('data-term-theme', this.theme);
    // Print banner on first load
    setTimeout(() => {
      this.printBanner();
      this.printLine("Type <span style='color:var(--term-primary)'>help</span> for available commands.", 'info');
      this.printLine('', 'output');
      this.focusInput();
    }, 100);
  }

  render() {
    this.container.innerHTML = `
    <div class="terminal" data-term-theme="${this.theme}" id="termMain">
      <div class="terminal-titlebar">
        <div class="terminal-dots">
          <div class="terminal-dot-red" title="Close"></div>
          <div class="terminal-dot-yellow" title="Minimize"></div>
          <div class="terminal-dot-green-btn" title="Maximize"></div>
        </div>
        <div class="terminal-title">visitor@cyberalpha.dev — bash</div>
        <div class="terminal-theme-picker">
          ${['green','amber','blue','white','matrix'].map(t =>
            `<div class="term-theme-btn" data-ttheme="${t}" title="${t}"
              style="background:${this.themeColor(t)}"
              ${this.theme===t?'class="term-theme-btn active"':'class="term-theme-btn"'}></div>`
          ).join('')}
        </div>
      </div>
      <div class="terminal-body" id="termBody"></div>
      <div class="term-prompt-line" id="termPromptLine">
        <span class="term-prompt-user">${this.user}</span>
        <span class="term-prompt-at">@</span>
        <span class="term-prompt-host">${this.host}</span>
        <span class="term-prompt-sym"> </span>
        <span class="term-prompt-path" id="termPath">${this.cwd}</span>
        <span class="term-prompt-sym">&nbsp;$&nbsp;</span>
        <input class="term-input" id="termInput" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" aria-label="Terminal input" />
      </div>
    </div>`;
    this.body = this.container.querySelector('#termBody');
    this.input = this.container.querySelector('#termInput');
    this.termMain = this.container.querySelector('#termMain');
    this.pathEl = this.container.querySelector('#termPath');
    this.updateThemeColors();
  }

  themeColor(t) {
    const c = { green:'#00ff41', amber:'#ffb000', blue:'#00d4ff', white:'#f0f0f0', matrix:'#00ff00' };
    return c[t] || '#00ff41';
  }

  updateThemeColors() {
    if (this.termMain) this.termMain.setAttribute('data-term-theme', this.theme);
    const primary = this.themeColor(this.theme);
    if (this.termMain) {
      this.termMain.style.setProperty('--term-primary', primary);
      this.termMain.style.background = this.theme === 'amber' ? '#0f0800' : this.theme === 'blue' ? '#000a1a' : this.theme === 'white' ? '#0d0d0d' : '#0a0a0f';
    }
  }

  bindEvents() {
    this.input?.addEventListener('keydown', e => {
      if (e.key === 'Enter') {
        const cmd = this.input.value.trim();
        this.input.value = '';
        this.execute(cmd);
      } else if (e.key === 'ArrowUp') {
        e.preventDefault();
        if (this.historyIndex < this.history.length - 1) {
          this.historyIndex++;
          this.input.value = this.history[this.history.length - 1 - this.historyIndex] || '';
        }
      } else if (e.key === 'ArrowDown') {
        e.preventDefault();
        if (this.historyIndex > 0) {
          this.historyIndex--;
          this.input.value = this.history[this.history.length - 1 - this.historyIndex] || '';
        } else { this.historyIndex = -1; this.input.value = ''; }
      } else if (e.key === 'Tab') {
        e.preventDefault();
        this.autocomplete();
      } else if (e.key === 'l' && e.ctrlKey) {
        e.preventDefault(); this.clear();
      } else if (e.key === 'c' && e.ctrlKey) {
        e.preventDefault(); this.printLine('^C', 'warn'); this.input.value = '';
      }
    });

    this.container.querySelector('.terminal-dot-red')?.addEventListener('click', () => this.exit());
    this.container.querySelector('.terminal-dot-green-btn')?.addEventListener('click', () => {
      const panel = document.getElementById('floatingTerminal');
      if (panel) {
        panel.style.height = panel.style.height === '80vh' ? '' : '80vh';
      }
    });

    this.container.querySelectorAll('.term-theme-btn').forEach(btn => {
      btn.addEventListener('click', () => this.changeTheme([btn.dataset.ttheme]));
    });

    this.container.addEventListener('click', () => this.input?.focus());
  }

  focusInput() { this.input?.focus(); }

  printLine(html, cls = 'output') {
    if (!this.body) return;
    const line = document.createElement('div');
    line.className = `term-line ${cls}`;
    line.innerHTML = html;
    this.body.appendChild(line);
    this.body.scrollTop = this.body.scrollHeight;
  }

  printPrompt(cmd) {
    const primary = this.themeColor(this.theme);
    this.printLine(
      `<span style="color:#00ff41">${this.user}</span><span style="color:#555">@</span><span style="color:#00d4ff">${this.host}</span> <span style="color:#7c3aed">${this.cwd}</span> <span style="color:${primary}">$</span> <span style="color:#c8c8d0">${this.escHtml(cmd)}</span>`,
      'prompt'
    );
  }

  escHtml(s) { return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;'); }

  execute(input) {
    if (!input) { this.printLine('', 'output'); return; }
    if (this.history[this.history.length - 1] !== input) this.history.push(input);
    this.historyIndex = -1;
    this.printPrompt(input);
    const parts = input.trim().split(/\s+/);
    const cmd = parts[0].toLowerCase();
    const args = parts.slice(1);
    if (this.commands[cmd]) {
      this.commands[cmd].fn(args);
    } else {
      this.printLine(`bash: ${this.escHtml(cmd)}: command not found. Type <span style="color:var(--term-primary)">help</span> for available commands.`, 'error');
    }
    this.printLine('', 'output');
  }

  autocomplete() {
    const val = this.input.value;
    const matches = Object.keys(this.commands).filter(c => c.startsWith(val));
    if (matches.length === 1) { this.input.value = matches[0]; }
    else if (matches.length > 1) { this.printLine(matches.join('   '), 'info'); }
  }

  clear() { if (this.body) this.body.innerHTML = ''; }

  exit() {
    const panel = document.getElementById('floatingTerminal');
    if (panel) panel.classList.remove('open');
  }

  printBanner() {
    const primary = this.themeColor(this.theme);
    this.printLine(`<span style="color:${primary}">
  ██████╗██╗   ██╗██████╗ ███████╗██████╗      █████╗ ██╗     ██████╗ ██╗  ██╗ █████╗
 ██╔════╝╚██╗ ██╔╝██╔══██╗██╔════╝██╔══██╗    ██╔══██╗██║     ██╔══██╗██║  ██║██╔══██╗
 ██║      ╚████╔╝ ██████╔╝█████╗  ██████╔╝    ███████║██║     ██████╔╝███████║███████║
 ██║       ╚██╔╝  ██╔══██╗██╔══╝  ██╔══██╗    ██╔══██║██║     ██╔═══╝ ██╔══██║██╔══██║
 ╚██████╗   ██║   ██████╔╝███████╗██║  ██║    ██║  ██║███████╗██║     ██║  ██║██║  ██║
  ╚═════╝   ╚═╝   ╚═════╝ ╚══════╝╚═╝  ╚═╝    ╚═╝  ╚═╝╚══════╝╚═╝     ╚═╝  ╚═╝╚═╝  ╚═╝</span>`, 'ascii');
    this.printLine(`<span style="color:#555568">  ─── Personal Platform of Abdullah Ismail ─── v2.0.26 ───</span>`, 'output');
  }

  banner() { this.clear(); this.printBanner(); }

  help() {
    this.printLine('<span style="color:var(--term-primary)">Available Commands:</span>', 'output');
    this.printLine('─'.repeat(60), 'output');
    Object.entries(this.commands).forEach(([name, def]) => {
      this.printLine(
        `  <span style="color:var(--term-primary);display:inline-block;width:120px">${name.padEnd(16)}</span><span style="color:#8892a4">${def.desc}</span>`,
        'output'
      );
    });
    this.printLine('─'.repeat(60), 'output');
    this.printLine('<span style="color:#555568">↑↓ History · Tab Autocomplete · Ctrl+L Clear · Ctrl+C Cancel</span>', 'output');
  }

  whoami() {
    this.printLine(`<span style="color:var(--term-primary)">Abdullah Ismail</span> <span style="color:#555568">alias</span> <span style="color:#00d4ff">Cyber Alpha</span>`, 'output');
    this.printLine(`Role: Cybersecurity Expert | AI Researcher | Software Developer`, 'output');
    this.printLine(`Location: 🌍 Global`, 'output');
    this.printLine(`Status: <span style="color:#00ff41">● Online</span>`, 'output');
  }

  neofetch() {
    const primary = this.themeColor(this.theme);
    const uptime = Math.floor(Math.random() * 9000 + 100);
    const lines = [
      ['OS', 'Kali Linux 2026.1 x86_64 / CyberAlpha OS'],
      ['Host', 'cyberalpha.dev'],
      ['Kernel', '6.9.0-kali3-amd64'],
      ['Uptime', `${uptime} days, 3 hours, 42 mins`],
      ['Shell', 'zsh 5.9 (custom)'],
      ['Terminal', 'Cyber Alpha Terminal v2.0'],
      ['CPU', 'Brain @ 9.99 GHz (unlimited cores)'],
      ['Memory', '∞ GB / ∞ GB (Dedication)'],
      ['GPU', 'NVIDIA RTX 4090 (for deep learning)'],
      ['Languages', 'Python, C, C++, JavaScript, Bash, PHP'],
      ['Specialties', 'Pentesting, AI, Web Security, DFIR'],
      ['Contact', 'contact@cyberalpha.dev'],
    ];

    const ascii = [
      `  ██████╗ ██████╗`,
      ` ██╔════╝██╔══██╗`,
      ` ██║     ███████║`,
      ` ██║     ██╔══██║`,
      ` ╚██████╗██║  ██║`,
      `  ╚═════╝╚═╝  ╚═╝`,
      `  <span style="color:#555">CYBER ALPHA</span>`,
    ];

    lines.forEach((line, i) => {
      const art = ascii[i] || '         ';
      this.printLine(
        `<span style="color:${primary}">${art.padEnd(24)}</span>  <span style="color:${primary}">${line[0]}:</span> <span style="color:#c8c8d0">${line[1]}</span>`,
        'output'
      );
    });
    this.printLine('', 'output');
    this.printLine(`          <span style="background:#ff5f56;padding:0 8px"> </span><span style="background:#ffbd2e;padding:0 8px"> </span><span style="background:#28c840;padding:0 8px"> </span><span style="background:#00d4ff;padding:0 8px"> </span><span style="background:#7c3aed;padding:0 8px"> </span><span style="background:#ff4444;padding:0 8px"> </span>`, 'output');
  }

  about() {
    this.printLine('<span style="color:var(--term-primary)">╔══ ABOUT CYBER ALPHA ══════════════════════════╗</span>', 'output');
    this.printLine('║', 'output');
    this.printLine('║  Name:      <span style="color:#00d4ff">Abdullah Ismail</span>', 'output');
    this.printLine('║  Alias:     <span style="color:var(--term-primary)">Cyber Alpha</span>', 'output');
    this.printLine('║', 'output');
    this.printLine('║  A cybersecurity expert, AI researcher, and', 'output');
    this.printLine('║  software developer passionate about building', 'output');
    this.printLine('║  secure systems and educating the next', 'output');
    this.printLine('║  generation of security professionals.', 'output');
    this.printLine('║', 'output');
    this.printLine('║  Mission: Democratize cybersecurity education.', 'output');
    this.printLine('║  Vision:  A more secure digital world for all.', 'output');
    this.printLine('║', 'output');
    this.printLine('<span style="color:var(--term-primary)">╚══════════════════════════════════════════════╝</span>', 'output');
  }

  skills() {
    const skills = [
      ['Penetration Testing', 95],
      ['Web Application Security', 90],
      ['Python Development', 92],
      ['Artificial Intelligence', 85],
      ['Network Security', 88],
      ['Digital Forensics', 82],
      ['Malware Analysis', 80],
      ['Cloud Security', 78],
      ['DevSecOps', 75],
      ['CTF / Bug Bounty', 90],
    ];
    this.printLine('<span style="color:var(--term-primary)">Technical Skills:</span>', 'output');
    this.printLine('', 'output');
    const primary = this.themeColor(this.theme);
    skills.forEach(([name, level]) => {
      const filled = Math.floor(level / 5);
      const empty = 20 - filled;
      const bar = `<span style="color:${primary}">${'█'.repeat(filled)}</span><span style="color:#1e1e3a">${'░'.repeat(empty)}</span>`;
      this.printLine(`  ${name.padEnd(30)} ${bar} ${level}%`, 'output');
    });
  }

  projects() {
    const projects = [
      ['CyberShield', 'Python', 'Advanced network intrusion detection system with ML'],
      ['VulnScan Pro', 'Python/Go', 'Automated web vulnerability scanner'],
      ['SecureChat', 'JavaScript', 'End-to-end encrypted messaging platform'],
      ['AI ThreatHunter', 'Python/AI', 'ML-powered threat intelligence aggregator'],
      ['CryptoForensics', 'Python', 'Blockchain forensics and tracing tool'],
      ['PenTest Toolkit', 'Python', 'All-in-one penetration testing framework'],
    ];
    this.printLine('<span style="color:var(--term-primary)">Featured Projects:</span>', 'output');
    this.printLine('─'.repeat(70), 'output');
    projects.forEach(([name, tech, desc]) => {
      this.printLine(`  <span style="color:var(--term-primary)">▸ ${name}</span> <span style="color:#555568">[${tech}]</span>`, 'output');
      this.printLine(`    ${desc}`, 'output');
    });
    this.printLine('─'.repeat(70), 'output');
    this.printLine(`  Visit <span style="color:var(--term-primary)">cyberalpha.dev/projects</span> for full details`, 'output');
  }

  contact() {
    this.printLine('<span style="color:var(--term-primary)">Contact Information:</span>', 'output');
    this.printLine('', 'output');
    this.printLine('  📧 Email:    <span style="color:var(--term-primary)">contact@cyberalpha.dev</span>', 'output');
    this.printLine('  💼 LinkedIn: <span style="color:#00d4ff">linkedin.com/in/cyberalpha</span>', 'output');
    this.printLine('  🐙 GitHub:   <span style="color:#a0a0a0">github.com/cyberalpha</span>', 'output');
    this.printLine('  🐦 Twitter:  <span style="color:#1DA1F2">@CyberAlpha_dev</span>', 'output');
    this.printLine('  💬 Discord:  <span style="color:#7289DA">CyberAlpha#0001</span>', 'output');
    this.printLine('', 'output');
    this.printLine('  Available for: Consulting | Speaking | Mentorship | Collaboration', 'output');
  }

  ls(args) {
    const dirs = {
      '/home/cyberalpha': ['articles/','projects/','research/','resources/','talks/','about.txt','skills.json','resume.pdf'],
      '/home/cyberalpha/articles': ['web-security-2026.md','ai-threats.md','pentesting-guide.md','osint-masterclass.md'],
      '/home/cyberalpha/projects': ['cybershield/','vulnscan-pro/','securechat/','ai-threathunter/'],
      '/home/cyberalpha/research': ['ml-security-paper.pdf','threat-intel-report.pdf','zero-day-analysis.pdf'],
      '/home/cyberalpha/resources': ['cheatsheets/','scripts/','templates/','mindmaps/'],
    };
    const path = args[0] || this.cwd;
    const full = path.startsWith('/') ? path : this.cwd + '/' + path;
    const contents = dirs[full] || dirs[this.cwd];
    if (!contents) { this.printLine(`ls: cannot access '${path}': No such file or directory`, 'error'); return; }
    const primary = this.themeColor(this.theme);
    contents.forEach(item => {
      const isDir = item.endsWith('/');
      this.printLine(
        `  <span style="color:${isDir ? '#00d4ff' : '#c8c8d0'}">${item}</span>`,
        'output'
      );
    });
  }

  cat(args) {
    if (!args[0]) { this.printLine('Usage: cat <filename>', 'warn'); return; }
    const files = {
      'about.txt': () => this.about(),
      'skills.json': () => {
        this.printLine('<span style="color:#bd93f9">{</span>', 'output');
        this.printLine('  <span style="color:#f1fa8c">"name"</span><span style="color:#fff">:</span> <span style="color:#50fa7b">"Abdullah Ismail"</span><span style="color:#fff">,</span>', 'output');
        this.printLine('  <span style="color:#f1fa8c">"alias"</span><span style="color:#fff">:</span> <span style="color:#50fa7b">"Cyber Alpha"</span><span style="color:#fff">,</span>', 'output');
        this.printLine('  <span style="color:#f1fa8c">"specialties"</span><span style="color:#fff">:</span> <span style="color:#bd93f9">[</span><span style="color:#50fa7b">"Pentesting"</span><span style="color:#fff">,</span> <span style="color:#50fa7b">"AI"</span><span style="color:#fff">,</span> <span style="color:#50fa7b">"Security"</span><span style="color:#bd93f9">]</span>', 'output');
        this.printLine('<span style="color:#bd93f9">}</span>', 'output');
      },
    };
    const fn = files[args[0]];
    if (fn) fn();
    else this.printLine(`cat: ${args[0]}: No such file or directory`, 'error');
  }

  cd(args) {
    const dirs = ['/home/cyberalpha','/home/cyberalpha/articles','/home/cyberalpha/projects','/home/cyberalpha/research','/home/cyberalpha/resources','/home/cyberalpha/talks'];
    const target = args[0];
    if (!target || target === '~') { this.cwd = '/home/cyberalpha'; }
    else if (target === '..') { this.cwd = this.cwd.split('/').slice(0,-1).join('/') || '/'; }
    else {
      const newPath = target.startsWith('/') ? target : this.cwd + '/' + target.replace(/\/$/,'');
      if (dirs.includes(newPath)) this.cwd = newPath;
      else { this.printLine(`bash: cd: ${target}: No such file or directory`, 'error'); return; }
    }
    if (this.pathEl) this.pathEl.textContent = this.cwd;
  }

  pwd() { this.printLine(this.cwd, 'output'); }

  echo(args) { this.printLine(args.join(' '), 'output'); }

  dateCmd() { this.printLine(new Date().toString(), 'output'); }

  uname(args) {
    if (args.includes('-a')) this.printLine('Linux cyberalpha.dev 6.9.0-kali3-amd64 #1 SMP Kali 6.9.0 x86_64 GNU/Linux', 'output');
    else this.printLine('Linux', 'output');
  }

  ping(args) {
    const host = args[0] || 'cyberalpha.dev';
    this.printLine(`PING ${host}: 56 data bytes`, 'output');
    let i = 0;
    const id = setInterval(() => {
      const ms = (Math.random() * 20 + 5).toFixed(3);
      this.printLine(`64 bytes from ${host}: icmp_seq=${i} ttl=64 time=${ms} ms`, 'success');
      if (++i >= 4) {
        clearInterval(id);
        this.printLine(`--- ${host} ping statistics ---`, 'output');
        this.printLine(`4 packets transmitted, 4 received, 0% packet loss`, 'success');
      }
    }, 400);
  }

  curlCmd(args) {
    const url = args[0] || 'https://cyberalpha.dev';
    this.printLine(`  % Total    % Received % Xferd  Average Speed   Time`, 'output');
    setTimeout(() => {
      this.printLine(`  0     0    0     0    0     0      0      0 --:--:-- --:--:-- --:--:-- 0`, 'output');
      setTimeout(() => {
        this.printLine(`100  1337  100  1337    0     0   9820      0 --:--:-- --:--:-- --:--:--  9909`, 'output');
        this.printLine(`{"status":"ok","message":"Welcome to Cyber Alpha API","version":"2.0"}`, 'success');
      }, 600);
    }, 300);
  }

  nmap(args) {
    const target = args[args.length - 1] || 'cyberalpha.dev';
    this.printLine(`Starting Nmap 7.95 ( https://nmap.org )`, 'output');
    this.printLine(`Nmap scan report for ${target}`, 'output');
    this.printLine(`Host is up (0.0023s latency).`, 'success');
    this.printLine(``, 'output');
    this.printLine(`PORT      STATE SERVICE    VERSION`, 'output');
    this.printLine(`22/tcp    open  ssh        OpenSSH 9.3p1`, 'success');
    this.printLine(`80/tcp    open  http       nginx 1.26.1`, 'success');
    this.printLine(`443/tcp   open  ssl/https  nginx 1.26.1`, 'success');
    this.printLine(`8080/tcp  closed http`, 'error');
    this.printLine(``, 'output');
    this.printLine(`Nmap done: 1 IP address (1 host up) scanned in 2.34 seconds`, 'output');
  }

  hashcat() {
    this.printLine(`hashcat (v6.2.6) starting...`, 'output');
    this.printLine(`* Device #1: NVIDIA RTX 4090, 24320/24560 MB, 128MCU`, 'info');
    this.printLine(``, 'output');
    this.printLine(`Dictionary cache hit:`, 'success');
    this.printLine(`* Filename..: /usr/share/wordlists/rockyou.txt`, 'output');
    this.printLine(`* Passwords.: 14344385`, 'output');
    this.printLine(``, 'output');
    let i = 0;
    const speeds = ['1234.5 MH/s','1289.2 MH/s','1301.8 MH/s'];
    const int = setInterval(() => {
      this.printLine(`Speed.#1.........:  ${speeds[i % speeds.length]} (${i*2}%)`, 'output');
      i++;
      if (i >= 3) { clearInterval(int); this.printLine(`Cracked: password123 → <span style="color:var(--term-primary)">FOUND!</span>`, 'success'); }
    }, 500);
  }

  python3() {
    this.printLine(`Python 3.12.3 (main, Apr 15 2024, 17:43:13)`, 'output');
    this.printLine(`[GCC 13.2.0] on linux`, 'output');
    this.printLine(`Type "help", "copyright", "credits" or "license" for more information.`, 'output');
    this.printLine(`>>> <span style="color:#50fa7b">print</span>(<span style="color:#f1fa8c">"Cyber Alpha is watching 👁️"</span>)`, 'output');
    setTimeout(() => this.printLine(`Cyber Alpha is watching 👁️`, 'success'), 400);
  }

  git(args) {
    const sub = args[0];
    if (sub === 'status') {
      this.printLine(`On branch main`, 'output');
      this.printLine(`Your branch is up to date with 'origin/main'.`, 'success');
      this.printLine(`nothing to commit, working tree clean`, 'output');
    } else if (sub === 'log') {
      const commits = [
        ['a3f9b21','feat: Add AI ThreatHunter module'],
        ['c8d1e94','fix: Patch SQLi in auth module'],
        ['0f2a7b3','docs: Update penetration testing guide'],
        ['d4e8c61','refactor: Optimize scanner performance'],
      ];
      commits.forEach(([hash, msg]) => {
        this.printLine(`<span style="color:#f1fa8c">commit ${hash}</span>`, 'output');
        this.printLine(`Author: Abdullah Ismail &lt;contact@cyberalpha.dev&gt;`, 'output');
        this.printLine(`    ${msg}`, 'output');
        this.printLine('', 'output');
      });
    } else {
      this.printLine(`usage: git <command> [args]`, 'output');
      this.printLine(`Try: git status, git log`, 'info');
    }
  }

  hack() {
    this.printLine(`<span style="color:#ff4444">[ ACCESS DENIED ]</span>`, 'error');
    setTimeout(() => {
      this.printLine(`Initiating counter-intrusion protocols...`, 'warn');
      setTimeout(() => {
        this.printLine(`Just kidding 😄 Ethical hacking only here!`, 'success');
        this.printLine(`Visit <span style="color:var(--term-primary)">cyberalpha.dev/knowledge-hub</span> for real security content.`, 'info');
      }, 1000);
    }, 800);
  }

  matrixCmd() {
    if (window._matrixToggle) window._matrixToggle();
    else this.printLine(`Matrix effect available on the main page.`, 'info');
  }

  changeTheme(args) {
    const validThemes = ['green','amber','blue','white','matrix'];
    const theme = args[0];
    if (!theme || !validThemes.includes(theme)) {
      this.printLine(`Usage: theme [${validThemes.join('|')}]`, 'warn');
      return;
    }
    this.theme = theme;
    localStorage.setItem('term-theme', theme);
    this.updateThemeColors();
    this.container.querySelectorAll('.term-theme-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.ttheme === theme);
    });
    this.printLine(`Theme changed to <span style="color:${this.themeColor(theme)}">${theme}</span>`, 'success');
  }

  man(args) {
    const cmd = args[0];
    if (!cmd) { this.printLine(`Usage: man <command>`, 'warn'); return; }
    const def = this.commands[cmd];
    if (!def) { this.printLine(`No manual entry for ${cmd}`, 'error'); return; }
    this.printLine(`<span style="color:var(--term-primary)">MAN(1) — ${cmd.toUpperCase()}</span>`, 'output');
    this.printLine(`NAME: ${cmd} — ${def.desc}`, 'output');
  }

  showHistory() {
    this.history.forEach((cmd, i) => {
      this.printLine(`  ${String(i + 1).padStart(4)} ${cmd}`, 'output');
    });
  }
}

/* ── INITIALIZE TERMINALS ── */
document.addEventListener('DOMContentLoaded', () => {
  // Floating terminal
  const floatContainer = document.getElementById('floatingTerminal');
  if (floatContainer) {
    window._floatTerm = new CyberAlphaTerminal(floatContainer);
  }

  // Full page terminal
  const pageContainer = document.getElementById('pageTerminal');
  if (pageContainer) {
    window._pageTerm = new CyberAlphaTerminal(pageContainer, {
      theme: localStorage.getItem('term-theme') || 'green'
    });
  }
});
