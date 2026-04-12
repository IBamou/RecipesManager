<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><i class="fas fa-star" style="color:var(--gold);margin-right:.5rem;"></i> My Favorites</h1>
    <div class="sub">Your personal collection of beloved recipes</div>
  </div>
  <div class="header-right">
    <form method="GET" action="" style="display:flex;gap:0;">
      <input type="search" name="q" placeholder="Search favorites..." value="<?php echo htmlspecialchars($_GET['q'] ?? ''); ?>" style="background:var(--surface-2);border:1px solid var(--border);border-radius:8px 0 0 8px;color:var(--text);padding:.6rem .8rem;font-size:.85rem;width:200px;">
      <button type="submit" class="btn btn-gold btn-sm" style="border-radius:0 8px 8px 0;">
        <i class="fas fa-search"></i>
      </button>
    </form>
    <a href="<?php echo BASE_URL; ?>/discover" class="btn btn-outline btn-sm">
      <i class="fas fa-compass"></i> Discover More
    </a>
  </div>
</div>

<div class="page-body">
  <?php if (empty($favorites)): ?>
    <div class="grid"><div class="empty-state">
      <i class="fas fa-star"></i>
      <h3>No favorites yet</h3>
      <p>Start exploring and save recipes you love by clicking the star icon.</p>
    </div></div>
  <?php else: ?>
    <div class="grid grid-auto">
      <?php foreach ($favorites as $i => $recipe): ?>
        <div class="recipe-card fade-up" data-recipe-card-item style="animation-delay:<?php echo $i * 0.07; ?>s">

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
            <button class="btn btn-gold btn-sm btn-icon favorite-btn" 
                    data-recipe-id="<?php echo $recipe['id']; ?>" 
                    title="Remove from favorites"
                    onclick="toggleFavorite(this)"
                    style="background:var(--gold);color:#120d00;">
              <i class="fas fa-star"></i>
            </button>
          </div>

        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
function toggleFavorite(btn) {
  const recipeId = btn.getAttribute('data-recipe-id');
  
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
      const card = btn.closest('.recipe-card');
      if (data.favorited) {
        btn.querySelector('i').style.color = 'var(--gold)';
      } else {
        card.style.opacity = '0';
        card.style.transform = 'scale(0.8)';
        setTimeout(() => {
          card.remove();
          checkEmptyState();
        }, 300);
      }
    } else {
      alert(data.message || 'Something went wrong');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Failed to update favorite');
  });
}

function checkEmptyState() {
  const grid = document.querySelector('.grid');
  if (grid && grid.querySelectorAll('.recipe-card').length === 0) {
    grid.innerHTML = `
      <div class="empty-state">
        <i class="fas fa-star"></i>
        <h3>No favorites yet</h3>
        <p>Start exploring and save recipes you love by clicking the star icon.</p>
      </div>
    `;
  }
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
