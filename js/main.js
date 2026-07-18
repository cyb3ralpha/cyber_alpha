/* ============================================================
   CYBER ALPHA — Main JavaScript
   ============================================================ */

/* ── THEME SYSTEM ── */
const themes = ['green','amber','blue','purple','red'];
let currentTheme = localStorage.getItem('ca-theme') || 'green';

function applyTheme(theme) {
  currentTheme = theme;
  document.documentElement.setAttribute('data-theme', theme);
  localStorage.setItem('ca-theme', theme);
  document.querySelectorAll('.theme-dot').forEach(d => {
    d.classList.toggle('active', d.dataset.theme === theme);
  });
}
applyTheme(currentTheme);

document.querySelectorAll('.theme-dot').forEach(dot => {
  dot.addEventListener('click', () => applyTheme(dot.dataset.theme));
});

/* ── NAVBAR SCROLL ── */
const navbar = document.querySelector('.navbar');
if (navbar) {
  window.addEventListener('scroll', () => {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  });
}

/* ── HAMBURGER ── */
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');
if (hamburger && mobileMenu) {
  hamburger.addEventListener('click', () => {
    mobileMenu.classList.toggle('open');
    const spans = hamburger.querySelectorAll('span');
    if (mobileMenu.classList.contains('open')) {
      spans[0].style.transform = 'rotate(45deg) translateY(7px)';
      spans[1].style.opacity = '0';
      spans[2].style.transform = 'rotate(-45deg) translateY(-7px)';
    } else {
      spans.forEach(s => { s.style.transform = ''; s.style.opacity = ''; });
    }
  });
}

/* Mark active nav */
(function() {
  const page = location.pathname.split('/').pop().replace('.php','') || 'index';
  document.querySelectorAll('.nav-link').forEach(l => {
    const href = l.getAttribute('href') || '';
    const lpage = href.replace('.php','').replace('/','').replace('index','') || 'index';
    if (lpage === page || (page === 'index' && lpage === 'index')) l.classList.add('active');
  });
})();

/* ── READING PROGRESS ── */
const progressBar = document.querySelector('.reading-progress-fill');
if (progressBar) {
  window.addEventListener('scroll', () => {
    const h = document.documentElement;
    const pct = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
    progressBar.style.width = Math.min(pct, 100) + '%';
  });
}

/* ── COUNTER ANIMATION ── */
function animateCounter(el, target, duration = 2000) {
  const start = performance.now();
  const isDecimal = target % 1 !== 0;
  const step = ts => {
    const p = Math.min((ts - start) / duration, 1);
    const ease = 1 - Math.pow(1 - p, 3);
    el.textContent = isDecimal
      ? (target * ease).toFixed(1)
      : Math.floor(target * ease).toLocaleString();
    if (p < 1) requestAnimationFrame(step);
  };
  requestAnimationFrame(step);
}
const counters = document.querySelectorAll('[data-count]');
if (counters.length) {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        animateCounter(e.target, parseFloat(e.target.dataset.count));
        obs.unobserve(e.target);
      }
    });
  }, { threshold: 0.4 });
  counters.forEach(c => obs.observe(c));
}

/* ── SKILL BARS ── */
document.querySelectorAll('.skill-fill').forEach(bar => {
  const pct = bar.dataset.pct || '0';
  bar.style.width = '0';
  const obs = new IntersectionObserver(entries => {
    if (entries[0].isIntersecting) {
      setTimeout(() => bar.style.width = pct + '%', 200);
      obs.disconnect();
    }
  });
  obs.observe(bar);
});

/* ── SCROLL REVEAL ── */
const reveals = document.querySelectorAll('.reveal');
if (reveals.length) {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.08, rootMargin: '0px 0px -40px 0px' });
  reveals.forEach(el => obs.observe(el));
}

/* ── TYPING ANIMATION ── */
class Typer {
  constructor(el, words, speed = 80, pause = 2000) {
    this.el = el; this.words = words; this.speed = speed; this.pause = pause;
    this.wi = 0; this.ci = 0; this.deleting = false; this.run();
  }
  run() {
    const word = this.words[this.wi];
    if (!this.deleting) {
      this.el.textContent = word.substring(0, ++this.ci);
      if (this.ci === word.length) {
        this.deleting = true;
        setTimeout(() => this.run(), this.pause);
        return;
      }
    } else {
      this.el.textContent = word.substring(0, --this.ci);
      if (this.ci === 0) {
        this.deleting = false;
        this.wi = (this.wi + 1) % this.words.length;
      }
    }
    setTimeout(() => this.run(), this.deleting ? this.speed / 2 : this.speed);
  }
}

const typerEl = document.getElementById('heroTyper');
if (typerEl) {
  new Typer(typerEl, [
    'Cybersecurity Expert',
    'AI Researcher',
    'Python Developer',
    'Ethical Hacker',
    'Security Educator',
    'Open Source Contributor',
    'CTF Champion',
    'Bug Bounty Hunter'
  ]);
}

/* ── MATRIX RAIN ── */
let matrixActive = localStorage.getItem('ca-matrix') === 'true';
const matrixCanvas = document.getElementById('matrixCanvas');

function initMatrix() {
  if (!matrixCanvas) return;
  const ctx = matrixCanvas.getContext('2d');
  matrixCanvas.width = window.innerWidth;
  matrixCanvas.height = window.innerHeight;
  const cols = Math.floor(matrixCanvas.width / 16);
  const drops = Array(cols).fill(1);
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%&*<>[]{}|アイウエオカキクケコサシスセソ';

  function draw() {
    ctx.fillStyle = 'rgba(10,10,15,0.05)';
    ctx.fillRect(0, 0, matrixCanvas.width, matrixCanvas.height);
    const primary = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim() || '#00ff41';
    ctx.fillStyle = primary;
    ctx.font = '14px Fira Code, monospace';
    for (let i = 0; i < drops.length; i++) {
      ctx.fillText(chars[Math.floor(Math.random() * chars.length)], i * 16, drops[i] * 16);
      if (drops[i] * 16 > matrixCanvas.height && Math.random() > 0.975) drops[i] = 0;
      drops[i]++;
    }
  }

  let interval;
  function start() { if (matrixActive) interval = setInterval(draw, 50); }
  function stop() { clearInterval(interval); ctx.clearRect(0, 0, matrixCanvas.width, matrixCanvas.height); }

  if (matrixActive) start();
  window.addEventListener('resize', () => {
    matrixCanvas.width = window.innerWidth;
    matrixCanvas.height = window.innerHeight;
    drops.fill(1);
  });

  window._matrixToggle = function() {
    matrixActive = !matrixActive;
    localStorage.setItem('ca-matrix', matrixActive);
    const btn = document.querySelector('.matrix-toggle');
    if (btn) btn.textContent = matrixActive ? '[ matrix: ON ]' : '[ matrix: OFF ]';
    matrixActive ? start() : stop();
  };
  const btn = document.querySelector('.matrix-toggle');
  if (btn) btn.textContent = matrixActive ? '[ matrix: ON ]' : '[ matrix: OFF ]';
}
initMatrix();

/* ── PARTICLES ── */
const pCanvas = document.getElementById('particleCanvas');
if (pCanvas) {
  const ctx = pCanvas.getContext('2d');
  pCanvas.width = window.innerWidth;
  pCanvas.height = window.innerHeight;
  const particles = Array.from({length: 60}, () => ({
    x: Math.random() * pCanvas.width,
    y: Math.random() * pCanvas.height,
    r: Math.random() * 1.5 + 0.5,
    vx: (Math.random() - 0.5) * 0.3,
    vy: (Math.random() - 0.5) * 0.3,
    opacity: Math.random() * 0.4 + 0.1
  }));

  function drawParticles() {
    ctx.clearRect(0, 0, pCanvas.width, pCanvas.height);
    const col = getComputedStyle(document.documentElement).getPropertyValue('--primary').trim() || '#00ff41';
    particles.forEach(p => {
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > pCanvas.width) p.vx *= -1;
      if (p.y < 0 || p.y > pCanvas.height) p.vy *= -1;
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = col;
      ctx.globalAlpha = p.opacity;
      ctx.fill();
    });
    // Draw connections
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx*dx + dy*dy);
        if (dist < 120) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = col;
          ctx.globalAlpha = (1 - dist / 120) * 0.08;
          ctx.lineWidth = 1;
          ctx.stroke();
        }
      }
    }
    ctx.globalAlpha = 1;
    requestAnimationFrame(drawParticles);
  }
  drawParticles();
  window.addEventListener('resize', () => {
    pCanvas.width = window.innerWidth;
    pCanvas.height = window.innerHeight;
  });
}

/* ── FLOATING TERMINAL PANEL ── */
const fabBtn = document.getElementById('fabTerminal');
const termPanel = document.getElementById('floatingTerminal');

if (fabBtn && termPanel) {
  fabBtn.addEventListener('click', () => {
    termPanel.classList.toggle('open');
    if (termPanel.classList.contains('open')) {
      const input = termPanel.querySelector('.term-input');
      if (input) setTimeout(() => input.focus(), 50);
    }
  });
  termPanel.querySelector('.terminal-dot-red')?.addEventListener('click', () => {
    termPanel.classList.remove('open');
  });
}

/* ── COPY CODE BUTTONS ── */
document.querySelectorAll('.copy-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const code = btn.closest('.code-block')?.querySelector('pre')?.textContent || '';
    navigator.clipboard.writeText(code).then(() => {
      btn.textContent = 'Copied!';
      btn.style.color = '#00ff41';
      setTimeout(() => { btn.textContent = 'Copy'; btn.style.color = ''; }, 2000);
    });
  });
});

/* ── SEARCH ── */
const searchInput = document.querySelector('[data-search]');
if (searchInput) {
  searchInput.addEventListener('input', () => {
    const q = searchInput.value.toLowerCase();
    document.querySelectorAll('[data-searchable]').forEach(el => {
      el.style.display = el.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
  });
}

/* ── FILTER TABS ── */
document.querySelectorAll('.filter-tab').forEach(tab => {
  tab.addEventListener('click', () => {
    const group = tab.closest('.filter-tabs');
    group?.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
    tab.classList.add('active');
    const filter = tab.dataset.filter;
    const target = tab.dataset.target;
    if (filter && target) {
      document.querySelectorAll(target).forEach(item => {
        const cat = item.dataset.category || '';
        item.style.display = (!filter || filter === 'all' || cat.includes(filter)) ? '' : 'none';
      });
    }
  });
});

/* ── TOAST NOTIFICATIONS ── */
window.showToast = function(msg, type = 'success') {
  const colors = { success: '#00ff41', error: '#ff4444', info: '#00d4ff', warn: '#ffb000' };
  const t = document.createElement('div');
  t.style.cssText = `position:fixed;bottom:100px;right:28px;z-index:9999;
    background:#12121e;border:1px solid ${colors[type]};border-left:3px solid ${colors[type]};
    padding:14px 20px;border-radius:8px;font-family:'Fira Code',monospace;font-size:0.82rem;
    color:${colors[type]};box-shadow:0 8px 32px rgba(0,0,0,0.6);max-width:320px;
    animation:fadeInUp 0.3s ease;`;
  t.textContent = msg;
  document.body.appendChild(t);
  setTimeout(() => t.remove(), 3500);
};

/* ── FORM SUBMIT ── */
document.querySelectorAll('.ajax-form').forEach(form => {
  form.addEventListener('submit', async e => {
    e.preventDefault();
    const btn = form.querySelector('[type="submit"]');
    const originalText = btn.textContent;
    btn.textContent = 'Sending...'; btn.disabled = true;

    const data = Object.fromEntries(new FormData(form));
    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify(data)
      });
      const json = await res.json();
      if (json.ok) {
        showToast(json.message || 'Sent successfully!', 'success');
        form.reset();
      } else {
        showToast(json.error || 'Something went wrong.', 'error');
      }
    } catch {
      showToast('Network error. Please try again.', 'error');
    }
    btn.textContent = originalText; btn.disabled = false;
  });
});

/* ── SMOOTH ANCHOR SCROLL ── */
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    const id = a.getAttribute('href').slice(1);
    const target = document.getElementById(id);
    if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
  });
});

console.log('%c CYBER ALPHA ', 'background:#00ff41;color:#000;font-weight:900;font-size:14px;padding:4px 8px;border-radius:4px;font-family:Fira Code,monospace;', '— Abdullah Ismail');
