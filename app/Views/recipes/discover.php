<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><i class="fas fa-compass" style="color:var(--gold);margin-right:.5rem;"></i> Discover</h1>
    <div class="sub">Explore recipes from the community</div>
  </div>
  <div class="header-right">
    <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-gold btn-sm" style="margin-left:1rem;">
      <i class="fas fa-plus"></i> Share Recipe
    </a>
  </div>
</div>

<div class="page-body">
  <!-- Discover controls: page-level filters -->
  <div class="discover-controls" style="display:flex;gap:.5rem;flex-wrap:wrap;margin:1rem 0 1.5rem;">
    <input id="ds-name" class="form-control" type="text" placeholder="Search by name" style="min-width:260px;" onkeyup="if(event.key==='Enter') ds_applyFilters()">
    <select id="ds-cat" class="form-control" style="min-width:200px;">
      <option value="">All Categories</option>
      <?php foreach ($categories as $cat): ?>
        <option value="<?php echo htmlspecialchars($cat['name']); ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
      <?php endforeach; ?>
    </select>
    <button type="button" class="btn btn-outline btn-sm" onclick="ds_search()">Search</button>
    <button type="button" class="btn btn-outline btn-sm" onclick="ds_applyFilters()">Apply Filters</button>
    <button type="button" class="btn btn-outline btn-sm" onclick="ds_clearFilters()">Clear</button>
  </div>

  <?php if (!empty($categories)): ?>
  <div style="display:flex;gap:.5rem;flex-wrap:wrap;margin-bottom:2rem;">
    <button type="button" class="badge badge-gold" onclick="ds_clearFilters()" style="border:none;cursor:pointer;padding:.4rem .9rem;font-size:.75rem;">All</button>
    <?php foreach ($categories as $cat): ?>
      <button type="button" class="badge" onclick="document.getElementById('ds-cat').value='<?php echo htmlspecialchars($cat['name']); ?>'; ds_applyFilters();" style="border:none;cursor:pointer;padding:.4rem .9rem;font-size:.75rem;background:var(--surface-2);">
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
            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">
              <i class="fas fa-eye"></i> View
            </a>
            <button class="btn <?php echo $isFavorited ? 'btn-gold' : 'btn-ghost'; ?> btn-sm btn-icon" 
                    title="<?php echo $isFavorited ? 'Remove from favorites' : 'Add to favorites'; ?>" 
                    onclick="toggleFavorite(this)" 
                    data-recipe-id="<?php echo $recipe['id']; ?>">
              <i class="fas fa-star" style="<?php echo $isFavorited ? 'color:var(--gold);' : ''; ?>"></i>
            </button>
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
function ds_applyFilters() {
  const name = (document.getElementById('ds-name')?.value || '').toLowerCase();
  const category = document.getElementById('ds-cat')?.value || '';
  document.querySelectorAll('[data-recipe-disc]').forEach(card => {
    const t = card.querySelector('.recipe-card-title')?.innerText.toLowerCase() ?? '';
    const cat = card.getAttribute('data-category') ?? '';
    const nameOk = t.includes(name);
    const catOk = category === '' || cat === category;
    card.style.display = (nameOk && catOk) ? '' : 'none';
  });
}
function ds_clearFilters() {
  const nameEl = document.getElementById('ds-name');
  const catEl = document.getElementById('ds-cat');
  if (nameEl) nameEl.value = '';
  if (catEl) catEl.value = '';
  document.querySelectorAll('[data-recipe-disc]').forEach(card => card.style.display = '');
}
function toggleFavorite(btn) {
  const recipeId = btn.getAttribute('data-recipe-id');
  fetch('<?php echo BASE_URL; ?>/favorites/toggle', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: 'recipe_id=' + recipeId
  }).then(r => r.json()).then(data => {
    if (data.success) {
      const icon = btn.querySelector('i');
      if (data.favorited) {
        icon.style.color = 'var(--gold)';
        btn.classList.remove('btn-ghost');
        btn.classList.add('btn-gold');
        btn.setAttribute('title', 'Remove from favorites');
      } else {
        icon.style.color = '';
        btn.classList.remove('btn-gold');
        btn.classList.add('btn-ghost');
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
