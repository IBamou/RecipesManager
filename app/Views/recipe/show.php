<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($recipe['name'] ?? 'Recipe'); ?> - Marrakech Food Lovers</title>
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
          <h1><?php echo htmlspecialchars($recipe['name'] ?? 'Recipe'); ?></h1>
          <p>Recipe Details</p>
        </div>
        <div class="topbar-right">
          <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back
          </a>
        </div>
      </header>

      <div class="page-inner">
        <?php if (empty($recipe)): ?>
          <div class="empty-state">
            <div class="empty-state-icon">🍜</div>
            <h3>Recipe not found</h3>
            <p>The recipe you're looking for doesn't exist.</p>
            <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-primary mt-4">
              <i class="fa fa-arrow-left"></i> Back to Recipes
            </a>
          </div>
        <?php else: ?>
          <div class="form-page-box" style="max-width:100%;">
            <?php if (!empty($recipe['image_url'])): ?>
              <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>" style="width:100%;height:300px;object-fit:cover;border-radius:16px;margin-bottom:32px;"/>
            <?php endif; ?>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:20px;margin-bottom:32px;">
              <div style="background:var(--beige);padding:20px;border-radius:12px;text-align:center;">
                <div style="font-size:0.8rem;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;">Prep Time</div>
                <div style="font-size:1.5rem;font-weight:700;color:var(--brown);margin-top:4px;"><?php echo $recipe['preparation_time']; ?> min</div>
              </div>
              <div style="background:var(--beige);padding:20px;border-radius:12px;text-align:center;">
                <div style="font-size:0.8rem;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;">Cook Time</div>
                <div style="font-size:1.5rem;font-weight:700;color:var(--brown);margin-top:4px;"><?php echo $recipe['cooking_time']; ?> min</div>
              </div>
              <div style="background:var(--beige);padding:20px;border-radius:12px;text-align:center;">
                <div style="font-size:0.8rem;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;">Difficulty</div>
                <div style="font-size:1.5rem;font-weight:700;color:var(--brown);margin-top:4px;"><?php echo htmlspecialchars($recipe['difficulty']); ?></div>
              </div>
              <div style="background:var(--beige);padding:20px;border-radius:12px;text-align:center;">
                <div style="font-size:0.8rem;color:var(--text-light);text-transform:uppercase;letter-spacing:1px;">Category</div>
                <div style="font-size:1.5rem;font-weight:700;color:var(--brown);margin-top:4px;"><?php echo htmlspecialchars($recipe['category_name'] ?? 'None'); ?></div>
              </div>
            </div>

            <?php if (!empty($recipe['description'])): ?>
              <div style="margin-bottom:32px;">
                <h3 style="font-size:1.1rem;color:var(--text-dark);margin-bottom:12px;">Description</h3>
                <p style="color:var(--text-mid);line-height:1.8;"><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
              </div>
            <?php endif; ?>

            <?php if (!empty($recipe['ingredients'])): ?>
              <div style="margin-bottom:32px;">
                <h3 style="font-size:1.1rem;color:var(--text-dark);margin-bottom:12px;">Ingredients</h3>
                <div style="background:var(--beige);padding:24px;border-radius:12px;">
                  <p style="color:var(--text-mid);line-height:2;white-space:pre-line;"><?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($recipe['instructions'])): ?>
              <div style="margin-bottom:32px;">
                <h3 style="font-size:1.1rem;color:var(--text-dark);margin-bottom:12px;">Instructions</h3>
                <div style="background:var(--beige);padding:24px;border-radius:12px;">
                  <p style="color:var(--text-mid);line-height:2;white-space:pre-line;"><?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
                </div>
              </div>
            <?php endif; ?>

            <div style="display:flex;gap:12px;justify-content:flex-end;padding-top:24px;border-top:1px solid var(--beige-dark);">
              <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-olive">
                <i class="fa fa-pen"></i> Edit Recipe
              </a>
              <form method="POST" action="<?php echo BASE_URL; ?>/recipes/delete" onsubmit="return confirm('Are you sure you want to delete this recipe?');">
                <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>"/>
                <button type="submit" class="btn btn-danger">
                  <i class="fa fa-trash"></i> Delete
                </button>
              </form>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>
</html>
