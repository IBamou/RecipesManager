<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>My Recipes - Marrakech Food Lovers</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"/>
  <link href="<?php echo BASE_URL; ?>/public/css/style.css" rel="stylesheet"/>
</head>
<body>
  <div class="dashboard-layout">
    <aside class="sidebar">
      <div class="sidebar-brand">
        <div class="sidebar-brand-inner">
          <div class="sidebar-brand-icon">🍜</div>
          <div>
            <div class="sidebar-brand-name">Marrakech</div>
            <div class="sidebar-brand-sub">Food Lovers</div>
          </div>
        </div>
      </div>

      <nav class="sidebar-nav">
        <div class="sidebar-nav-label">Main</div>
        <a href="<?php echo BASE_URL; ?>/dashboard" class="sidebar-nav-item">
          <i class="fa fa-house"></i> Dashboard
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes" class="sidebar-nav-item active">
          <i class="fa fa-bowl-food"></i> My Recipes
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes/create" class="sidebar-nav-item">
          <i class="fa fa-plus-circle"></i> Add Recipe
        </a>

        <div class="sidebar-nav-label">Library</div>
        <a href="<?php echo BASE_URL; ?>/categories" class="sidebar-nav-item">
          <i class="fa fa-tags"></i> Categories
        </a>

        <div class="sidebar-nav-label">Account</div>
        <a href="<?php echo BASE_URL; ?>/logout" class="sidebar-nav-item" style="color:rgba(255,100,100,0.8);">
          <i class="fa fa-right-from-bracket"></i> Logout
        </a>
      </nav>

      <div class="sidebar-footer">
        <div class="sidebar-user">
          <div class="sidebar-user-avatar"><?php echo strtoupper(substr($_SESSION['user']['name'] ?? 'U', 0, 1)); ?></div>
          <div class="sidebar-user-info">
            <div class="sidebar-user-name"><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></div>
            <div class="sidebar-user-role">Home Chef</div>
          </div>
        </div>
      </div>
    </aside>

    <div class="main-content">
      <header class="topbar">
        <div class="topbar-left">
          <h1>My Recipes</h1>
          <p>Manage and organize your cookbook</p>
        </div>
        <div class="topbar-right">
          <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Recipe
          </a>
        </div>
      </header>

      <div class="page-inner">
        <div class="recipes-header">
          <div>
            <h2>My Recipes</h2>
            <p>You have <strong><?php echo count($recipes); ?> recipes</strong> in your cookbook</p>
          </div>
        </div>

        <?php if (empty($recipes)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">🍜</div>
            <h3>No recipes yet</h3>
            <p>Start building your cookbook by adding your first recipe!</p>
            <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary mt-4">
              <i class="fa fa-plus"></i> Create Your First Recipe
            </a>
          </div>
        <?php else: ?>
          <div class="recipes-grid">
            <?php foreach ($recipes as $recipe): ?>
              <div class="recipe-card">
                <div class="recipe-card-img">
                  <?php if (!empty($recipe['image_url'])): ?>
                    <img class="recipe-card-img-bg" src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>"/>
                  <?php else: ?>
                    <div style="width:100%;height:100%;background:linear-gradient(135deg,var(--beige-dark),var(--beige));display:flex;align-items:center;justify-content:center;font-size:4rem;">
                      🍲
                    </div>
                  <?php endif; ?>
                  <div class="recipe-card-img-overlay"></div>
                  <span class="recipe-card-category"><?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?></span>
                  <span class="recipe-card-time-badge">
                    <i class="fa fa-clock"></i> <?php echo ($recipe['preparation_time'] + $recipe['cooking_time']); ?> min
                  </span>
                </div>
                <div class="recipe-card-body">
                  <div class="recipe-card-title"><?php echo htmlspecialchars($recipe['name']); ?></div>
                  <div class="recipe-card-meta">
                    <span class="recipe-card-meta-item">
                      <i class="fa fa-users"></i> <?php echo htmlspecialchars($recipe['difficulty']); ?>
                    </span>
                  </div>
                  <div class="recipe-card-actions">
                    <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-secondary btn-sm">
                      <i class="fa fa-eye"></i> View
                    </a>
                    <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-olive btn-sm">
                      <i class="fa fa-pen"></i> Edit
                    </a>
                    <form method="POST" action="<?php echo BASE_URL; ?>/recipes/delete" style="flex:1;" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                      <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>"/>
                      <button type="submit" class="btn btn-danger btn-sm" style="width:100%;">
                        <i class="fa fa-trash"></i>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
