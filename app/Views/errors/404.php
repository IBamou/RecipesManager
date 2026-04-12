<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 — Page Not Found | Wasafat</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>

<div class="error-page">
  <!-- subtle food background -->
  <div style="position:fixed;inset:0;background:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1400&auto=format&fit=crop&q=30') center/cover;opacity:.06;pointer-events:none;"></div>

  <div style="position:relative;z-index:2;text-align:center;">
    <div style="font-size:9rem;font-family:var(--font-serif);line-height:1;color:rgba(201,151,58,.15);margin-bottom:-2rem;user-select:none;">404</div>

    <div class="err-icon"><i class="fas fa-bowl-food"></i></div>

    <h1 style="font-size:2.5rem;margin-bottom:.75rem;">Lost in the Medina</h1>
    <p>The page you're looking for has vanished into the spice-scented alleyways of Marrakech.</p>

    <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
      <a href="<?php echo BASE_URL; ?>" class="btn btn-gold">
        <i class="fas fa-house"></i> Back to Home
      </a>
      <?php if (isset($_SESSION['user'])): ?>
        <a href="<?php echo BASE_URL; ?>/dashboard" class="btn btn-outline">
          <i class="fas fa-gauge"></i> Dashboard
        </a>
      <?php else: ?>
        <a href="<?php echo BASE_URL; ?>/auth/login" class="btn btn-outline">
          <i class="fas fa-right-to-bracket"></i> Sign In
        </a>
      <?php endif; ?>
    </div>

    <p style="margin-top:3rem;font-size:.78rem;color:var(--muted);">
      <i class="fas fa-map-pin" style="color:var(--gold);"></i>
      Wasafat &mdash; Crafted with spice & code.
    </p>
  </div>
</div>

</body>
</html>
