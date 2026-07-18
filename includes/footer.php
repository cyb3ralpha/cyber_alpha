<!-- FLOATING TERMINAL -->
<div class="terminal-panel" id="floatingTerminal"></div>

<!-- FAB Terminal Button -->
<button class="fab-terminal" id="fabTerminal" title="Open Terminal (Alt+T)">
  <i class="fa fa-terminal"></i>
</button>

<!-- Matrix Toggle -->
<button class="matrix-toggle" onclick="window._matrixToggle && window._matrixToggle()">[ matrix: OFF ]</button>

<!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="footer-grid">
      <div class="footer-brand">
        <div style="font-family:var(--font-mono);font-size:1.1rem;font-weight:700;color:var(--text-bright)">
          <span style="color:var(--primary)">[</span>cyber_alpha<span style="color:var(--primary)">]</span><span style="animation:blink 1s infinite;display:inline-block;width:8px;height:14px;background:var(--primary);margin-left:3px;vertical-align:middle"></span>
        </div>
        <p style="margin-top:12px">Personal platform of <strong style="color:var(--text-bright)">Abdullah Ismail</strong>. Cybersecurity expert, AI researcher, and educator. Building a more secure digital world.</p>
        <div class="hero-social" style="margin-top:16px">
          <a href="https://github.com/cyberalpha" class="social-link" target="_blank" title="GitHub"><i class="fab fa-github"></i></a>
          <a href="https://linkedin.com/in/cyberalpha" class="social-link" target="_blank" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
          <a href="https://twitter.com/CyberAlpha_dev" class="social-link" target="_blank" title="Twitter/X"><i class="fab fa-twitter"></i></a>
          <a href="https://discord.gg/cyberalpha" class="social-link" target="_blank" title="Discord"><i class="fab fa-discord"></i></a>
          <a href="mailto:contact@cyberalpha.dev" class="social-link" title="Email"><i class="fa fa-envelope"></i></a>
        </div>
      </div>
      <div>
        <div class="footer-heading">// explore</div>
        <div class="footer-links">
          <a href="/knowledge-hub">Knowledge Hub</a>
          <a href="/learning-paths">Learning Paths</a>
          <a href="/resources">Resource Library</a>
          <a href="/research">Research Center</a>
        </div>
      </div>
      <div>
        <div class="footer-heading">// work</div>
        <div class="footer-links">
          <a href="/projects">Projects</a>
          <a href="/talks">Talks & Events</a>
          <a href="/portfolio">Portfolio</a>
          <a href="/contact">Hire Me</a>
        </div>
      </div>
      <div>
        <div class="footer-heading">// tools</div>
        <div class="footer-links">
          <a href="/terminal">Live Terminal</a>
          <a href="/resources">Cheat Sheets</a>
          <a href="/knowledge-hub">Articles</a>
          <a href="/contact">Newsletter</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; <?= date('Y') ?> Cyber Alpha — Abdullah Ismail. All rights reserved.</p>
      <p style="color:var(--primary)">$ echo "Built with passion for security &amp; knowledge"</p>
    </div>
  </div>
</footer>

<script src="/js/main.js"></script>
<script src="/js/terminal.js"></script>
<script src="/js/effects.js"></script>
</body>
</html>
