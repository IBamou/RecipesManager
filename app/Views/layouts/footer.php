<?php if (isset($_SESSION['user'])): ?>
  </div><!-- /main-wrap -->
</div><!-- /app-shell -->
<?php else: ?>
</main>
<footer class="pub-footer">
  <div class="pub-logo font-serif"><i class="fas fa-fire-flame-curved text-gold"></i> Wasafat</div>
  <nav class="pub-footer-links">
    <a href="#">Privacy</a>
    <a href="#">Terms</a>
    <a href="#">Instagram</a>
  </nav>
  <div style="font-size:.78rem;color:var(--muted);">&copy; <?php echo date('Y'); ?> Wasafat</div>
</footer>
<?php endif; ?>

</body>
</html>
