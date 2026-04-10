<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up — Marrakech Food Lovers</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>

<div class="auth-wrap">

  <!-- LEFT -->
  <div class="auth-aside" style="background-image:url('https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=900&auto=format&fit=crop&q=80');background-size:cover;background-position:center;">
    <div class="auth-aside-overlay"></div>
    <div class="auth-aside-content">
      <div class="hero-tag" style="margin-bottom:1rem;"><i class="fas fa-star"></i> Join 5,000+ Chefs</div>
      <h2>Start Your<br>Culinary Journey.</h2>
      <p>Create an account to share authentic Moroccan recipes and discover the magic of Marrakech cuisine.</p>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="auth-main">
    <div class="auth-box">

      <div class="logo">
        <i class="fas fa-fire-flame-curved" style="color:var(--gold);"></i>
        Marrakech <span>Food</span>
      </div>

      <h1>Create account</h1>
      <p class="subtitle">Already have one? <a href="<?php echo BASE_URL; ?>/auth/login">Sign in</a></p>

      <?php if (!empty($error)): ?>
        <div class="alert alert-error"><i class="fas fa-circle-exclamation"></i> <?php echo htmlspecialchars($error); ?></div>
      <?php endif; ?>
      <?php if (!empty($success)): ?>
        <div class="alert alert-success"><i class="fas fa-circle-check"></i> <?php echo htmlspecialchars($success); ?></div>
      <?php endif; ?>

      <form method="POST" action="<?php echo BASE_URL; ?>/auth/signup">
        <div class="form-group">
          <label class="form-label" for="name">Full Name</label>
          <input type="text" id="name" name="name" class="form-control" placeholder="Youssef Al-Fassi" required autofocus>
        </div>
        <div class="form-group">
          <label class="form-label" for="email">Email Address</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="you@example.com" required>
        </div>
        <div class="form-row form-row-2">
          <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
          </div>
          <div class="form-group">
            <label class="form-label" for="confirmPassword">Confirm</label>
            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="••••••••" required>
          </div>
        </div>
        <button type="submit" class="btn btn-gold" style="width:100%;justify-content:center;padding:.9rem;font-size:1rem;margin-top:.5rem;">
          <i class="fas fa-user-plus"></i> Create Account
        </button>
      </form>

      <div class="auth-switch">
        Already a member? <a href="<?php echo BASE_URL; ?>/auth/login">Sign in</a>
      </div>

    </div>
  </div>

</div>

</body>
</html>
