<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Categories - Marrakech Food Lovers</title>
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
        <a href="<?php echo BASE_URL; ?>/recipes" class="sidebar-nav-item">
          <i class="fa fa-bowl-food"></i> My Recipes
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes/create" class="sidebar-nav-item">
          <i class="fa fa-plus-circle"></i> Add Recipe
        </a>

        <div class="sidebar-nav-label">Library</div>
        <a href="<?php echo BASE_URL; ?>/categories" class="sidebar-nav-item active">
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
          <h1>Categories</h1>
          <p>Organize your recipes by category</p>
        </div>
        <div class="topbar-right">
          <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-primary">
            <i class="fa fa-plus"></i> Add Category
          </a>
        </div>
      </header>

      <div class="page-inner">
        <?php if (empty($categories)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">📁</div>
            <h3>No categories yet</h3>
            <p>Create categories to organize your recipes!</p>
            <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-primary mt-4">
              <i class="fa fa-plus"></i> Create First Category
            </a>
          </div>
        <?php else: ?>
          <div class="recipes-grid">
            <?php foreach ($categories as $category): ?>
              <div class="recipe-card" style="padding:24px;">
                <div style="display:flex;align-items:center;gap:16px;margin-bottom:16px;">
                  <div style="width:50px;height:50px;background:linear-gradient(135deg,var(--brown),var(--brown-light));border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;color:white;">
                    📁
                  </div>
                  <div>
                    <h3 style="font-size:1.1rem;color:var(--text-dark);margin-bottom:4px;"><?php echo htmlspecialchars($category['name']); ?></h3>
                    <p style="font-size:0.82rem;color:var(--text-light);"><?php echo $category['recipe_count'] ?? 0; ?> recipes</p>
                  </div>
                </div>
                <?php if (!empty($category['description'])): ?>
                  <p style="color:var(--text-mid);font-size:0.88rem;margin-bottom:16px;line-height:1.6;">
                    <?php echo htmlspecialchars($category['description']); ?>
                  </p>
                <?php endif; ?>
                <div style="display:flex;gap:8px;">
                  <a href="<?php echo BASE_URL; ?>/categories/edit?id=<?php echo $category['id']; ?>" class="btn btn-olive btn-sm" style="flex:1;justify-content:center;">
                    <i class="fa fa-pen"></i> Edit
                  </a>
                  <form method="POST" action="<?php echo BASE_URL; ?>/categories/delete" style="flex:1;" onsubmit="return confirm('Are you sure? Recipes in this category will become uncategorized.');">
                    <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>"/>
                    <button type="submit" class="btn btn-danger btn-sm" style="width:100%;">
                      <i class="fa fa-trash"></i>
                    </button>
                  </form>
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
