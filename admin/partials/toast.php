<div class="toast-container" id="toastContainer"></div>
<script>
function showToast(msg, type = 'success') {
  const t = document.createElement('div');
  t.className = `toast toast-${type}`;
  t.innerHTML = `<span class="toast-icon">${type === 'success' ? '✓' : '⚠'}</span> ${msg}`;
  document.getElementById('toastContainer').appendChild(t);
  setTimeout(() => t.remove(), 3500);
}
<?php if (!empty($msg)): ?>
document.addEventListener('DOMContentLoaded', () => showToast(<?= json_encode(htmlspecialchars($msg)) ?>));
<?php endif; ?>
</script>
