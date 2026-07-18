/* ============================================================
   CYBER ALPHA — Visual Effects (particles, glitch, scanlines)
   ============================================================ */

/* ── SCANLINE INTENSITY CONTROL ── */
function setScanlines(opacity) {
  document.documentElement.style.setProperty('--scanline-opacity', opacity);
  localStorage.setItem('ca-scanlines', opacity);
}
const savedScanlines = localStorage.getItem('ca-scanlines');
if (savedScanlines) setScanlines(savedScanlines);

/* ── GLITCH ON HOVER ── */
document.querySelectorAll('[data-glitch]').forEach(el => {
  el.dataset.text = el.textContent;
  el.addEventListener('mouseenter', () => {
    let iter = 0;
    const chars = '@#$%&*!?<>[]{}|/\\~^';
    const orig = el.dataset.text;
    const id = setInterval(() => {
      el.textContent = orig.split('').map((c, i) => {
        if (i < iter) return orig[i];
        return chars[Math.floor(Math.random() * chars.length)];
      }).join('');
      if (iter >= orig.length) { clearInterval(id); el.textContent = orig; }
      iter += 2;
    }, 40);
  });
});

/* ── CURSOR TRAIL (optional, subtle) ── */
let cursorEnabled = false;
if (cursorEnabled) {
  const trail = [];
  document.addEventListener('mousemove', e => {
    const dot = document.createElement('div');
    dot.style.cssText = `position:fixed;left:${e.clientX}px;top:${e.clientY}px;
      width:4px;height:4px;background:var(--primary);border-radius:50%;
      pointer-events:none;z-index:9996;opacity:0.6;transition:opacity 0.6s;`;
    document.body.appendChild(dot);
    trail.push(dot);
    if (trail.length > 20) trail.shift().remove();
    requestAnimationFrame(() => dot.style.opacity = '0');
    setTimeout(() => dot.remove(), 600);
  });
}

/* ── CRT FLICKER ── */
function crtFlicker() {
  const body = document.body;
  if (Math.random() < 0.02) {
    body.style.opacity = '0.97';
    setTimeout(() => body.style.opacity = '1', 80);
  }
}
setInterval(crtFlicker, 2000);

/* ── NEON HOVER RIPPLE ── */
document.querySelectorAll('.btn-primary,.card').forEach(el => {
  el.addEventListener('mousemove', e => {
    const rect = el.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    el.style.setProperty('--mx', x + 'px');
    el.style.setProperty('--my', y + 'px');
  });
});

/* ── LAZY IMAGE LOADING ── */
const lazyImages = document.querySelectorAll('img[data-src]');
if (lazyImages.length) {
  const imgObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const img = e.target;
        img.src = img.dataset.src;
        img.removeAttribute('data-src');
        imgObs.unobserve(img);
      }
    });
  });
  lazyImages.forEach(img => imgObs.observe(img));
}

/* ── CODE HIGHLIGHTING (simple regex-based) ── */
function highlightCode(el) {
  let code = el.innerHTML;
  // Keywords
  const kw = ['import','from','def','class','return','if','elif','else','for','while','in','not','and','or','True','False','None','print','with','as','try','except','raise','lambda'];
  kw.forEach(k => {
    code = code.replace(new RegExp(`\\b(${k})\\b`, 'g'), `<span class="kw">$1</span>`);
  });
  // Strings
  code = code.replace(/(["'`])(?:(?!\1)[^\\]|\\.)*\1/g, `<span class="str">$&</span>`);
  // Comments
  code = code.replace(/(#.*)$/gm, `<span class="cmt">$1</span>`);
  // Numbers
  code = code.replace(/\b(\d+\.?\d*)\b/g, `<span class="num">$1</span>`);
  el.innerHTML = code;
}
document.querySelectorAll('pre.highlight').forEach(highlightCode);

/* ── KEYBOARD SHORTCUTS ── */
document.addEventListener('keydown', e => {
  // Alt+T = open terminal
  if (e.altKey && e.key === 't') {
    e.preventDefault();
    const panel = document.getElementById('floatingTerminal');
    if (panel) {
      panel.classList.toggle('open');
      if (panel.classList.contains('open')) {
        const inp = panel.querySelector('.term-input');
        if (inp) setTimeout(() => inp.focus(), 50);
      }
    }
  }
  // Alt+M = toggle matrix
  if (e.altKey && e.key === 'm') {
    if (window._matrixToggle) window._matrixToggle();
  }
});

/* ── PRINT KEYBOARD HINT ── */
setTimeout(() => {
  const hint = document.createElement('div');
  hint.style.cssText = `position:fixed;bottom:90px;left:28px;font-family:'Fira Code',monospace;
    font-size:0.68rem;color:rgba(85,85,104,0.6);pointer-events:none;z-index:100;line-height:1.6;`;
  hint.innerHTML = 'Alt+T → Terminal<br>Alt+M → Matrix';
  document.body.appendChild(hint);
  setTimeout(() => { hint.style.transition = 'opacity 1s'; hint.style.opacity = '0'; }, 5000);
  setTimeout(() => hint.remove(), 6000);
}, 3000);
