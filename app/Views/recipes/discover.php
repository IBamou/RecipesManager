<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><i class="fas fa-compass" style="color:var(--gold);margin-right:.5rem;"></i> Discover</h1>
    <div class="sub">Explore recipes from the community</div>
  </div>
  <div class="header-right">
    <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-gold btn-sm">
      <i class="fas fa-book"></i> My Recipes
    </a>
  </div>
</div>

<div class="page-body">
  <!-- Search bar -->
  <div style="margin:1rem 0 1.5rem;">
    <div style="display:flex;gap:.5rem;max-width:1100px;">
      <input id="ds-name" class="form-control" type="text" placeholder="Search recipes..." onkeyup="ds_search()" style="flex:1;">
      <button type="button" class="btn btn-gold btn-sm" onclick="ds_search()">
        <i class="fas fa-search"></i> Search
      </button>
    </div>
  </div>

  <?php if (empty($recipes)): ?>
    <div class="grid"><div class="empty-state">
      <i class="fas fa-compass"></i>
      <h3>No recipes found</h3>
      <p>Be the first to share a recipe with the community!</p>
    </div></div>
  <?php else: ?>
    <div class="grid grid-auto" id="discover-grid">
      <?php 
      $favoriteIdsArray = $favoriteIds ?? [];
      $currentUserId = $_SESSION['user']['id'] ?? 0;
      foreach ($recipes as $i => $recipe): 
        $isFavorited = in_array($recipe['id'], $favoriteIdsArray);
        $isOwner = ($recipe['user_id'] ?? 0) == $currentUserId;
      ?>
        <div class="recipe-card fade-up" data-recipe-disc
             style="animation-delay:<?php echo $i * 0.06; ?>s">

          <?php if (!empty($recipe['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" class="recipe-card-img" alt="<?php echo htmlspecialchars($recipe['name']); ?>">
          <?php else: ?>
            <div class="recipe-card-img-placeholder"><i class="fas fa-bowl-food"></i></div>
          <?php endif; ?>

          <div class="recipe-badge">
            <span class="badge"><?php echo htmlspecialchars($recipe['difficulty'] ?? 'Easy'); ?></span>
            <span class="badge" title="Prep"><i class="fas fa-blender"></i> <?php echo $recipe['preparation_time'] ?? 0; ?></span>
            <span class="badge" title="Cook"><i class="fas fa-fire-burner"></i> <?php echo $recipe['cooking_time'] ?? 0; ?></span>
          </div>

          <div class="recipe-card-body">
            <div class="recipe-card-title"><?php echo htmlspecialchars($recipe['name']); ?></div>
            <div class="recipe-card-desc"><?php echo htmlspecialchars(substr($recipe['description'] ?? '', 0, 80)); ?>...</div>
            <div class="recipe-card-meta">
              <span><i class="fas fa-layer-group"></i> <?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?></span>
              <span title="Prep time"><i class="fas fa-blender"></i> <?php echo $recipe['preparation_time'] ?? 0; ?>m</span>
              <span title="Cook time"><i class="fas fa-fire-burner"></i> <?php echo $recipe['cooking_time'] ?? 0; ?>m</span>
            </div>
          </div>

          <div class="recipe-card-actions" style="padding:0 1rem 1rem;">
            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-gold btn-sm" style="flex:1;justify-content:center;">
              <i class="fas fa-eye"></i> View
            </a>
            <?php if ($isOwner): ?>
            <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-gold btn-sm btn-icon" title="Edit" style="background:var(--gold);color:#120d00;">
              <i class="fas fa-pen"></i>
            </a>
            <?php else: ?>
            <button class="btn <?php echo $isFavorited ? 'btn-gold' : 'btn-ghost'; ?> btn-sm btn-icon" 
                    title="<?php echo $isFavorited ? 'Remove from favorites' : 'Add to favorites'; ?>" 
                    onclick="toggleFavorite(this)" 
                    data-recipe-id="<?php echo $recipe['id']; ?>"
                    style="<?php echo $isFavorited ? 'background:var(--gold);color:#120d00;' : ''; ?>">
              <i class="fas fa-star"></i>
            </button>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
function ds_search() {
  const name = (document.getElementById('ds-name')?.value || '').toLowerCase();
  document.querySelectorAll('[data-recipe-disc]').forEach(card => {
    const t = card.querySelector('.recipe-card-title')?.innerText.toLowerCase() ?? '';
    card.style.display = t.includes(name) ? '' : 'none';
  });
}
function toggleFavorite(btn) {
  const recipeId = btn.getAttribute('data-recipe-id');
  fetch('<?php echo BASE_URL; ?>/favorites/toggle', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'recipe_id=' + recipeId
  }).then(r => r.json()).then(data => {
    if (data.success) {
      if (data.favorited) {
        btn.classList.remove('btn-ghost');
        btn.classList.add('btn-gold');
        btn.style.background = 'var(--gold)';
        btn.style.color = '#120d00';
        btn.setAttribute('title', 'Remove from favorites');
      } else {
        btn.classList.remove('btn-gold');
        btn.classList.add('btn-ghost');
        btn.style.background = '';
        btn.style.color = '';
        btn.setAttribute('title', 'Add to favorites');
      }
    } else {
      alert(data.message || 'Please login to add favorites');
      window.location.href = '<?php echo BASE_URL; ?>/auth/login';
    }
  });
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
