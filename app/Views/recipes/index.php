<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1>My Recipes</h1>
    <div class="sub">Your personal culinary collection</div>
  </div>
  <div class="header-right">
    <div class="search-wrap">
      <i class="fas fa-search"></i>
      <input type="search" placeholder="Search recipes..." oninput="filterCards(this.value,'recipe-card-item')">
    </div>
    <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold">
      <i class="fas fa-plus"></i> New Recipe
    </a>
  </div>
</div>

<div class="page-body">
  <?php if (empty($recipes)): ?>
    <div class="grid"><div class="empty-state">
      <i class="fas fa-book-open"></i>
      <h3>No recipes yet</h3>
      <p>Start building your cookbook by publishing your first recipe.</p>
      <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold"><i class="fas fa-plus"></i> Create Your First Recipe</a>
    </div></div>
  <?php else: ?>
    <div class="grid grid-auto">
      <?php foreach ($recipes as $i => $recipe): ?>
        <div class="recipe-card fade-up" data-recipe-card-item style="animation-delay:<?php echo $i * 0.07; ?>s">

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
            <div class="recipe-card-meta">
              <span><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?></span>
              <span><i class="fas fa-clock"></i> <?php echo ($recipe['preparation_time'] ?? 0) + ($recipe['cooking_time'] ?? 0); ?> min</span>
            </div>
          </div>

          <div class="recipe-card-actions">
            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">
              <i class="fas fa-eye"></i> View
            </a>
            <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-ghost btn-sm btn-icon" title="Edit">
              <i class="fas fa-pen"></i>
            </a>
            <form method="POST" action="<?php echo BASE_URL; ?>/recipes/delete" onsubmit="return confirm('Delete this recipe permanently?');">
              <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
              <button type="submit" class="btn btn-danger btn-sm btn-icon" title="Delete"><i class="fas fa-trash"></i></button>
            </form>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
function filterCards(q, attr) {
  const lower = q.toLowerCase();
  document.querySelectorAll('[data-' + attr + ']').forEach(card => {
    card.style.display = card.innerText.toLowerCase().includes(lower) ? '' : 'none';
  });
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
