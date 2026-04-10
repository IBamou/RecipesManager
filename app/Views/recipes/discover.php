<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1>Favorites</h1>
    <div class="sub">Discover and explore all community recipes</div>
  </div>
  <div class="header-right">
    <div class="search-wrap">
      <i class="fas fa-search"></i>
      <input type="search" placeholder="Search recipes..." oninput="filterCards(this.value,'recipe-disc')">
    </div>
    <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold">
      <i class="fas fa-plus"></i> Share Recipe
    </a>
  </div>
</div>

<div class="page-body">

  <!-- Category filter pills -->
  <?php if (!empty($categories)): ?>
    <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:2rem;">
      <button class="badge badge-gold" onclick="filterCategory('')" style="border:none;cursor:pointer;padding:.4rem .9rem;font-size:.75rem;">All</button>
      <?php foreach ($categories as $cat): ?>
        <button class="badge" onclick="filterCategory('<?php echo htmlspecialchars($cat['name']); ?>')"
                style="border:none;cursor:pointer;padding:.4rem .9rem;font-size:.75rem;background:var(--surface-2);">
          <?php echo htmlspecialchars($cat['name']); ?>
        </button>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <?php if (empty($recipes)): ?>
    <div class="grid"><div class="empty-state">
      <i class="fas fa-star"></i>
      <h3>No recipes found</h3>
      <p>Be the first to share a recipe with the community!</p>
      <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold"><i class="fas fa-plus"></i> Share Your Recipe</a>
    </div></div>
  <?php else: ?>
    <div class="grid grid-auto" id="discover-grid">
      <?php foreach ($recipes as $i => $recipe): ?>
        <div class="recipe-card fade-up" data-recipe-disc
             data-category="<?php echo htmlspecialchars($recipe['category_name'] ?? ''); ?>"
             style="animation-delay:<?php echo $i * 0.06; ?>s">

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
            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>"
               class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">
              <i class="fas fa-eye"></i> View Recipe
            </a>
            <button class="btn btn-ghost btn-sm btn-icon" title="Favorite" onclick="this.querySelector('i').style.color=this.querySelector('i').style.color?'':'var(--gold)'">
              <i class="fas fa-star"></i>
            </button>
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
function filterCategory(cat) {
  document.querySelectorAll('[data-recipe-disc]').forEach(card => {
    const cardCat = card.getAttribute('data-category') || '';
    card.style.display = (!cat || cardCat === cat) ? '' : 'none';
  });
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
