<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Edit Category - Marrakech Food Lovers</title>
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
          <h1>Edit Category</h1>
          <p>Update your category details</p>
        </div>
        <div class="topbar-right">
          <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back
          </a>
        </div>
      </header>

      <div class="page-inner">
        <div class="form-page-header">
          <a href="<?php echo BASE_URL; ?>/categories" class="form-back-btn">
            <i class="fa fa-arrow-left"></i>
          </a>
          <div>
            <h2 style="font-size:1.6rem;color:var(--text-dark);">Edit Category</h2>
            <p style="font-size:0.85rem;color:var(--text-light);">Update the details below</p>
          </div>
        </div>

        <div class="form-page-box">
          <form method="POST" action="<?php echo BASE_URL; ?>/categories/edit">
            <input type="hidden" name="category_id" value="<?php echo $category['id'] ?? ''; ?>"/>

            <div class="form-group">
              <label>Category Name *</label>
              <div class="form-input-icon">
                <i class="fa fa-folder"></i>
                <input type="text" class="form-input" name="name" value="<?php echo htmlspecialchars($category['name'] ?? ''); ?>" required/>
              </div>
            </div>

            <div class="form-group">
              <label>Description</label>
              <textarea class="form-textarea" name="description" rows="4"><?php echo htmlspecialchars($category['description'] ?? ''); ?></textarea>
            </div>

            <div class="form-actions">
              <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-secondary">
                <i class="fa fa-xmark"></i> Cancel
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-disk"></i> Update Category
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
