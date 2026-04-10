<?php require __DIR__ . '/../layouts/header.php'; ?>

<!-- HERO GREETING -->
<div class="dashboard-hero">
  <h1>Welcome back, <?php echo htmlspecialchars(explode(' ', $_SESSION['user']['name'] ?? 'Chef')[0]); ?> 👨‍🍳</h1>
  <p>Here's a snapshot of your culinary universe.</p>
</div>

<div class="page-body">

  <!-- STATS -->
  <div class="grid grid-4 mb-2" style="margin-bottom:2.5rem;">
    <div class="stat-card fade-up">
      <div class="stat-icon"><i class="fas fa-utensils"></i></div>
      <div><div class="stat-num"><?php echo $totalRecipes ?? 0; ?></div><div class="stat-label">Recipes</div></div>
      <i class="fas fa-utensils bg-icon"></i>
    </div>
    <div class="stat-card fade-up" style="animation-delay:.1s">
      <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
      <div><div class="stat-num"><?php echo $totalCategories ?? 0; ?></div><div class="stat-label">Categories</div></div>
      <i class="fas fa-layer-group bg-icon"></i>
    </div>
    <div class="stat-card fade-up" style="animation-delay:.2s">
      <div class="stat-icon"><i class="fas fa-clock"></i></div>
      <div><div class="stat-num"><?php echo $totalTime ?? 0; ?><small style="font-size:1rem;">m</small></div><div class="stat-label">Cooking Time</div></div>
      <i class="fas fa-clock bg-icon"></i>
    </div>
    <div class="stat-card fade-up" style="animation-delay:.3s">
      <div class="stat-icon"><i class="fas fa-star"></i></div>
      <div><div class="stat-num"><?php echo $easyRecipes ?? 0; ?></div><div class="stat-label">Easy Recipes</div></div>
      <i class="fas fa-star bg-icon"></i>
    </div>
  </div>

  <!-- DISCOVER BANNER -->
  <div class="discover-banner fade-up" style="animation-delay:.4s">
    <div class="discover-banner-bg"></div>
    <div class="discover-banner-overlay"></div>
    <div class="discover-banner-content">
      <div class="hero-tag" style="margin-bottom:.75rem;"><i class="fas fa-compass"></i> Community</div>
      <h2>Discover the Atlas Mountains</h2>
      <p>Explore the hidden culinary secrets of Berber villages.</p>
      <a href="<?php echo BASE_URL; ?>/recipes/discover" class="btn btn-gold">
        <i class="fas fa-compass"></i> Explore Recipes
      </a>
    </div>
  </div>

  <!-- RECENT RECIPES -->
  <div class="dashboard-section fade-up" style="animation-delay:.5s">
    <div class="section-header">
      <h2>Your Recent Recipes</h2>
      <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-outline btn-sm">View All</a>
    </div>

    <?php if (empty($recentRecipes)): ?>
      <div class="empty-state">
        <i class="fas fa-utensils"></i>
        <h3>No recipes yet</h3>
        <p>Start sharing your culinary creations with the world.</p>
        <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold"><i class="fas fa-plus"></i> Create Recipe</a>
      </div>
    <?php else: ?>
      <div class="grid grid-auto">
        <?php foreach ($recentRecipes as $recipe): ?>
          <div class="recipe-card">
            <?php if (!empty($recipe['image_url'])): ?>
              <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" class="recipe-card-img" alt="<?php echo htmlspecialchars($recipe['name']); ?>">
            <?php else: ?>
              <div class="recipe-card-img-placeholder"><i class="fas fa-bowl-food"></i></div>
            <?php endif; ?>
            <div class="recipe-badge">
              <span class="badge"><?php echo htmlspecialchars($recipe['difficulty'] ?? 'Easy'); ?></span>
              <span class="badge"><?php echo ($recipe['preparation_time'] ?? 0) + ($recipe['cooking_time'] ?? 0); ?>m</span>
            </div>
            <div class="recipe-card-body">
              <div class="recipe-card-title"><?php echo htmlspecialchars($recipe['name']); ?></div>
              <div class="recipe-card-desc"><?php echo htmlspecialchars(substr($recipe['description'] ?? '', 0, 80)); ?>...</div>
            </div>
            <div class="recipe-card-actions">
              <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">View</a>
              <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-ghost btn-sm btn-icon"><i class="fas fa-pen"></i></a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

</div><!-- /page-body -->

<?php require __DIR__ . '/../layouts/footer.php'; ?>
