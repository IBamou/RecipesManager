<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><?php echo htmlspecialchars($category['name'] ?? 'Category'); ?></h1>
    <div class="sub"><?php echo htmlspecialchars($category['description'] ?? ''); ?></div>
  </div>
  <div class="header-right">
    <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    <a href="<?php echo BASE_URL; ?>/categories/edit?id=<?php echo $category['id']; ?>" class="btn btn-gold btn-sm"><i class="fas fa-pen"></i> Edit</a>
  </div>
</div>

<div class="page-body">

  <!-- Category hero strip -->
  <div style="position:relative;height:180px;border-radius:var(--radius);overflow:hidden;margin-bottom:2.5rem;">
    <img src="https://images.unsplash.com/photo-1547592180-85f173990554?w=1200&auto=format&fit=crop&q=80"
         style="width:100%;height:100%;object-fit:cover;display:block;" alt="">
    <div style="position:absolute;inset:0;background:linear-gradient(90deg,rgba(0,0,0,.85) 0%,rgba(0,0,0,.3) 100%);display:flex;align-items:center;padding:2rem;">
      <div>
        <div style="font-size:.75rem;text-transform:uppercase;letter-spacing:2px;color:var(--gold);margin-bottom:.5rem;">
          <i class="fas fa-layer-group"></i> Category
        </div>
        <h2 style="font-family:var(--font-serif);font-size:2rem;"><?php echo htmlspecialchars($category['name'] ?? ''); ?></h2>
        <span style="font-size:.82rem;color:rgba(255,255,255,.6);">
          <i class="fas fa-utensils" style="color:var(--gold);"></i>
          <?php echo count($recipes ?? []); ?> recipe<?php echo count($recipes ?? []) !== 1 ? 's' : ''; ?> in this collection
        </span>
      </div>
    </div>
  </div>

  <!-- Recipes in this category -->
  <?php if (empty($recipes)): ?>
    <div class="grid"><div class="empty-state">
      <i class="fas fa-bowl-food"></i>
      <h3>No recipes in this category yet</h3>
      <p>Be the first to add a recipe to <em><?php echo htmlspecialchars($category['name'] ?? ''); ?></em>.</p>
      <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold"><i class="fas fa-plus"></i> Add Recipe</a>
    </div></div>
  <?php else: ?>
    <div class="section-header">
      <h2>Recipes</h2>
    </div>
    <div class="grid grid-auto">
      <?php foreach ($recipes as $i => $recipe): ?>
        <div class="recipe-card fade-up" style="animation-delay:<?php echo $i * 0.07; ?>s">
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
            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">
              <i class="fas fa-eye"></i> View
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
