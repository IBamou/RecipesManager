<?php require __DIR__ . '/../layouts/header.php'; ?>

<!-- PAGE HEADER -->
<div class="page-header">
  <div>
    <h1>Categories</h1>
    <div class="sub">Organize your recipes into curated collections</div>
  </div>
  <div class="header-right">
    <!-- Search -->
    <div class="search-wrap">
      <i class="fas fa-search"></i>
      <input type="search" id="cat-search" placeholder="Search categories..." oninput="filterCards(this.value,'cat-card')">
    </div>
    <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-gold">
      <i class="fas fa-plus"></i> New Category
    </a>
  </div>
</div>

<div class="page-body">
  <?php if (empty($categories)): ?>
    <div class="grid"><div class="empty-state">
      <i class="fas fa-layer-group"></i>
      <h3>No categories yet</h3>
      <p>Create your first category to start organizing your recipes.</p>
      <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-gold"><i class="fas fa-plus"></i> Create Category</a>
    </div></div>
  <?php else: ?>
    <div class="grid grid-auto" id="cat-grid">
      <?php foreach ($categories as $i => $cat): ?>
        <div class="cat-card fade-up" data-cat-card style="animation-delay:<?php echo $i*0.07; ?>s">
          <!-- background image for flavour -->
          <img class="cat-card-img"
               src="https://images.unsplash.com/photo-<?php
                 $imgs=['1547592180-85f173990554','1555939594-58d7cb561ad1','1610832958596-416d18b46a8a','1565557623262-b51831df97bd','1574484284002-952d92456975'];
                 echo $imgs[$i % count($imgs)];
               ?>?w=500&auto=format&fit=crop&q=70" alt="">
          <div class="cat-card-overlay"></div>
          <div class="cat-card-body">
            <div class="cat-card-title"><?php echo htmlspecialchars($cat['name']); ?></div>
            <div class="cat-card-desc"><?php echo htmlspecialchars($cat['description'] ?? 'No description'); ?></div>
            <div class="cat-card-count"><i class="fas fa-utensils"></i> <?php echo $cat['recipe_count'] ?? 0; ?> recipes</div>
            <div class="cat-card-actions">
              <a href="<?php echo BASE_URL; ?>/categories/show?category_id=<?php echo $cat['id']; ?>" class="btn btn-outline btn-sm" style="flex:1;justify-content:center;">
                <i class="fas fa-eye"></i> View
              </a>
              <a href="<?php echo BASE_URL; ?>/categories/edit?id=<?php echo $cat['id']; ?>" class="btn btn-ghost btn-sm btn-icon"><i class="fas fa-pen"></i></a>
              <form method="POST" action="<?php echo BASE_URL; ?>/categories/delete" style="display:inline;" onsubmit="return confirm('Delete this category?');">
                <input type="hidden" name="category_id" value="<?php echo $cat['id']; ?>">
                <button type="submit" class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
function filterCards(q, attr) {
  const lower = q.toLowerCase();
  document.querySelectorAll('[data-'+attr+']').forEach(card => {
    const text = card.innerText.toLowerCase();
    card.style.display = text.includes(lower) ? '' : 'none';
  });
}
</script>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
