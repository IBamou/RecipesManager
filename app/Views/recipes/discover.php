<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><i class="fas fa-compass" style="color:var(--gold);margin-right:.5rem;"></i> Discover</h1>
    <div class="sub">Explore recipes from the community</div>
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
      <i class="fas fa-compass"></i>
      <h3>No recipes found</h3>
      <p>Be the first to share a recipe with the community!</p>
      <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold"><i class="fas fa-plus"></i> Share Your Recipe</a>
    </div></div>
  <?php else: ?>
    <div class="grid grid-auto" id="discover-grid">
      <?php 
      $favoriteIdsArray = $favoriteIds ?? [];
      foreach ($recipes as $i => $recipe): 
        $isFavorited = in_array($recipe['id'], $favoriteIdsArray);
      ?>
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
              <i class="fas fa-eye"></i> View
            </a>
            <button class="btn <?php echo $isFavorited ? 'btn-gold' : 'btn-ghost'; ?> btn-sm btn-icon favorite-btn" 
                    data-recipe-id="<?php echo $recipe['id']; ?>" 
                    title="<?php echo $isFavorited ? 'Remove from favorites' : 'Add to favorites'; ?>"
                    onclick="toggleFavorite(this)">
              <i class="fas fa-star" style="<?php echo $isFavorited ? 'color:var(--gold);' : ''; ?>"></i>
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

function toggleFavorite(btn) {
  const recipeId = btn.getAttribute('data-recipe-id');
  const icon = btn.querySelector('i');
  
  fetch('<?php echo BASE_URL; ?>/favorites/toggle', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: 'recipe_id=' + recipeId
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      if (data.favorited) {
        btn.classList.remove('btn-ghost');
        btn.classList.add('btn-gold');
        icon.style.color = 'var(--gold)';
        btn.setAttribute('title', 'Remove from favorites');
      } else {
        btn.classList.remove('btn-gold');
        btn.classList.add('btn-ghost');
        icon.style.color = '';
        btn.setAttribute('title', 'Add to favorites');
      }
    } else {
      alert(data.message || 'Please login to add favorites');
      window.location.href = '<?php echo BASE_URL; ?>/auth/login';
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Failed to update favorite');
  });
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
