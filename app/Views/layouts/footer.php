<?php if (isset($_SESSION['user'])): ?>
  </div><!-- /main-wrap -->
</div><!-- /app-shell -->
<?php else: ?>
</main>
<footer class="pub-footer">
  <div class="pub-logo font-serif"><i class="fas fa-fire-flame-curved text-gold"></i> Marrakech Food Lovers</div>
  <nav class="pub-footer-links">
    <a href="#">Privacy</a>
    <a href="#">Terms</a>
    <a href="#">Instagram</a>
  </nav>
  <div style="font-size:.78rem;color:var(--muted);">&copy; <?php echo date('Y'); ?> Marrakech Food Lovers</div>
</footer>
<?php endif; ?>

<script>
// Active nav highlighting
document.addEventListener('DOMContentLoaded', () => {
  const path = window.location.pathname;
  document.querySelectorAll('.nav-link').forEach(link => {
    if (link.href && path.includes(link.getAttribute('href').split('?')[0].replace(window.location.origin,''))) {
      link.classList.add('active');
    }
  });
});
</script>
</body>
</html>
