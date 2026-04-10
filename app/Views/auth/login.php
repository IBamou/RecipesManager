<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — Marrakech Food Lovers</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>

<div class="auth-wrap">

  <!-- LEFT: Visual aside -->
  <div class="auth-aside" style="background-image:url('https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=900&auto=format&fit=crop&q=80');background-size:cover;background-position:center;">
    <div class="auth-aside-overlay"></div>
    <div class="auth-aside-content">
      <div class="hero-tag" style="margin-bottom:1rem;"><i class="fas fa-fire-flame-curved"></i> Welcome Back</div>
      <h2>The Spice of<br>Life Awaits.</h2>
      <p>Continue your culinary journey through the vibrant flavors of Morocco.</p>
    </div>
  </div>

  <!-- RIGHT: Form -->
  <div class="auth-main">
    <div class="auth-box">

      <div class="logo">
        <i class="fas fa-fire-flame-curved" style="color:var(--gold);"></i>
        Marrakech <span>Food</span>
      </div>

      <h1>Sign in</h1>
      <p class="subtitle">Don't have an account? <a href="<?php echo BASE_URL; ?>/auth/signup">Create one</a></p>

      <?php if (!empty($error)): ?>
        <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>

      <form method="POST" action="<?php echo BASE_URL; ?>/auth/login">
        <div class="form-group">
          <label class="form-label" for="name_or_email">Email or Username</label>
          <input type="text" id="name_or_email" name="name_or_email" class="form-control" 
                 placeholder="you@example.com" required autofocus>
        </div>
        <div class="form-group">
          <label class="form-label" for="password">Password</label>
          <input type="password" id="password" name="password" class="form-control" 
                 placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn btn-gold btn-lg" style="width:100%;justify-content:center;margin-top:.5rem;">
          <i class="fas fa-right-to-bracket"></i> Sign In
        </button>
      </form>

      <div class="auth-switch">
        New here? <a href="<?php echo BASE_URL; ?>/auth/signup">Join the kitchen</a>
      </div>

    </div>
  </div>

</div>

</body>
</html>
