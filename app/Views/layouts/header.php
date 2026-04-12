<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle ?? 'Marrakech Food Lovers'); ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
<!-- === APP SHELL === -->
<div class="app-shell">

  <aside class="sidebar">
    <!-- Brand -->
    <div class="sidebar-brand">
      <div class="brand-icon"><i class="fas fa-fire-flame-curved" style="color:#fff;"></i></div>
      <span class="brand-name">Marrakech</span>
      <span class="brand-sub">Food Lovers</span>
    </div>

    <!-- Nav -->
    <?php
    // Exact-path active detection helper
    $uri_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
    $uri_path = rtrim($uri_path, '/');
    function is_active_nav($target, $path) {
      return $path === $target;
    }
    ?>
    <nav class="sidebar-nav">
      <div class="nav-section">
        <div class="nav-section-title">Menu</div>
        <a href="<?php echo BASE_URL; ?>/dashboard" class="nav-link <?php echo (is_active_nav('/dashboard', $uri_path) ? 'active' : ''); ?>">
          <i class="fas fa-house"></i> Dashboard
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes" class="nav-link <?php echo (is_active_nav('/recipes', $uri_path) ? 'active' : ''); ?>">
          <i class="fas fa-book-open"></i> Recipes
        </a>
        <a href="<?php echo BASE_URL; ?>/categories" class="nav-link <?php echo (is_active_nav('/categories', $uri_path) ? 'active' : ''); ?>">
          <i class="fas fa-layer-group"></i> Categories
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes/discover" class="nav-link <?php echo (is_active_nav('/recipes/discover', $uri_path) ? 'active' : ''); ?>">
          <i class="fas fa-compass"></i> Discover
        </a>
        <a href="<?php echo BASE_URL; ?>/favorites" class="nav-link <?php echo (is_active_nav('/favorites', $uri_path) ? 'active' : ''); ?>">
          <i class="fas fa-star"></i> Favorites
        </a>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">Account</div>
        <a href="<?php echo BASE_URL; ?>/profile" class="nav-link <?php echo (is_active_nav('/profile', $uri_path) ? 'active' : ''); ?>">
          <i class="fas fa-user-circle"></i> Profile
        </a>
        <a href="<?php echo BASE_URL; ?>/logout" class="nav-link" style="color:#e74c3c;" onclick="return confirm('Log out?');">
          <i class="fas fa-right-from-bracket"></i> Logout
        </a>
      </div>
    </nav>

    <!-- User foot -->
    <div class="sidebar-footer">
      <div class="user-pill">
        <img src="https://i.pravatar.cc/150?u=<?php echo $_SESSION['user']['id'] ?? 0; ?>" alt="avatar">
        <div>
          <div class="name"><?php echo htmlspecialchars(explode(' ', $_SESSION['user']['name'] ?? 'Chef')[0]); ?></div>
          <div class="role">Home Chef</div>
        </div>
      </div>
      <div style="margin-top:1rem;">
        <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn-start">
          <i class="fas fa-plus"></i> New Recipe
        </a>
      </div>
    </div>
  </aside>

  <!-- Main area -->
  <div class="main-wrap">

<?php else: ?>
<!-- === PUBLIC HEADER === -->
<header class="public-header">
  <a href="<?php echo BASE_URL; ?>" class="pub-logo">
    <i class="fas fa-fire-flame-curved" style="color:var(--gold);"></i>
    Marrakech <span>Food</span>
  </a>
  <nav class="pub-nav">
    <a href="<?php echo BASE_URL; ?>" class="btn btn-ghost btn-sm">Home</a>
    <a href="<?php echo BASE_URL; ?>/auth/login" class="btn btn-outline btn-sm">Login</a>
    <a href="<?php echo BASE_URL; ?>/auth/signup" class="btn btn-gold btn-sm">Get Started</a>
  </nav>
</header>
<main>
<?php endif; ?>
