<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($pageTitle ?? 'Wasafat'); ?></title>
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
      <span class="brand-name">Wasafat</span>
      <span class="brand-sub">Moroccan Recipes</span>
    </div>

    <!-- Nav -->
    <?php
    $uri_path = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '';
    $uri_path = rtrim($uri_path, '/');
    $uri_path = str_replace('/recipesManager', '', $uri_path);
    
    $on_recipes = strpos($uri_path, '/recipes') === 0;
    ?>
    <nav class="sidebar-nav">
      <div class="nav-section">
        <div class="nav-section-title">Menu</div>
        <a href="<?php echo BASE_URL; ?>/dashboard" class="nav-link<?php echo ($uri_path === '/dashboard' ? ' active' : ''); ?>">
          <i class="fas fa-house"></i> Dashboard
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes" class="nav-link<?php echo ($uri_path === '/recipes' || $on_recipes ? ' active' : ''); ?>">
          <i class="fas fa-book"></i> My Recipes
        </a>
        <a href="<?php echo BASE_URL; ?>/categories" class="nav-link<?php echo ($uri_path === '/categories' ? ' active' : ''); ?>">
          <i class="fas fa-layer-group"></i> Categories
        </a>
        <a href="<?php echo BASE_URL; ?>/discover" class="nav-link<?php echo ($uri_path === '/discover' ? ' active' : ''); ?>">
          <i class="fas fa-compass"></i> Discover
        </a>
        <a href="<?php echo BASE_URL; ?>/favorites" class="nav-link<?php echo ($uri_path === '/favorites' ? ' active' : ''); ?>">
          <i class="fas fa-star"></i> Favorites
        </a>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">Account</div>
        <a href="<?php echo BASE_URL; ?>/profile" class="nav-link<?php echo ($uri_path === '/profile' ? ' active' : ''); ?>">
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
        <?php 
        $name = $_SESSION['user']['name'] ?? 'Chef';
        $initials = strtoupper(substr($name, 0, 1) . (strpos($name, ' ') !== false ? substr($name, strpos($name, ' ') + 1, 1) : ''));
        ?>
        <div style="width:36px;height:36px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:.9rem;color:#120d00;"><?php echo htmlspecialchars($initials); ?></div>
        <div>
          <div class="name"><?php echo htmlspecialchars(explode(' ', $name)[0]); ?></div>
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
    Wasafat <span>Recipes</span>
  </a>
  <nav class="pub-nav">
    <a href="<?php echo BASE_URL; ?>" class="btn btn-ghost btn-sm">Home</a>
    <a href="<?php echo BASE_URL; ?>/auth/login" class="btn btn-outline btn-sm">Login</a>
    <a href="<?php echo BASE_URL; ?>/auth/signup" class="btn btn-gold btn-sm">Get Started</a>
  </nav>
</header>
<main>
<?php endif; ?>
