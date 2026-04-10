<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Recipe - Marrakech Food Lovers</title>
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
        <a href="<?php echo BASE_URL; ?>/recipes/create" class="sidebar-nav-item active">
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
          <h1>Add New Recipe</h1>
          <p>Create a new recipe for your cookbook</p>
        </div>
        <div class="topbar-right">
          <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-secondary">
            <i class="fa fa-arrow-left"></i> Back
          </a>
        </div>
      </header>

      <div class="page-inner">
        <div class="form-page-header">
          <a href="<?php echo BASE_URL; ?>/recipes" class="form-back-btn">
            <i class="fa fa-arrow-left"></i>
          </a>
          <div>
            <h2 style="font-size:1.6rem;color:var(--text-dark);">Add New Recipe</h2>
            <p style="font-size:0.85rem;color:var(--text-light);">Fill in the details below to create your recipe</p>
          </div>
        </div>

        <div class="form-page-box">
          <form method="POST" action="<?php echo BASE_URL; ?>/recipes/create">
            <div class="form-section-title">✦ Basic Information</div>

            <div class="form-group">
              <label>Recipe Title *</label>
              <div class="form-input-icon">
                <i class="fa fa-bowl-food"></i>
                <input type="text" class="form-input" name="name" placeholder="e.g. Moroccan Lamb Tagine" required/>
              </div>
            </div>

            <div class="form-group">
              <label>Description</label>
              <textarea class="form-textarea" name="description" rows="3" placeholder="A brief description of your recipe..."></textarea>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Category *</label>
                <select class="form-select" name="category_id" required>
                  <option value="">Select category...</option>
                  <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <label>Image URL (optional)</label>
                <div class="form-input-icon">
                  <i class="fa fa-image"></i>
                  <input type="url" class="form-input" name="image_url" placeholder="https://..."/>
                </div>
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label>Preparation Time (min) *</label>
                <div class="form-input-icon">
                  <i class="fa fa-clock"></i>
                  <input type="number" class="form-input" name="preparation_time" placeholder="e.g. 15" min="0" required/>
                </div>
              </div>
              <div class="form-group">
                <label>Cooking Time (min) *</label>
                <div class="form-input-icon">
                  <i class="fa fa-fire"></i>
                  <input type="number" class="form-input" name="cooking_time" placeholder="e.g. 30" min="0" required/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label>Difficulty Level</label>
              <select class="form-select" name="difficulty">
                <option value="Easy">Easy</option>
                <option value="Medium" selected>Medium</option>
                <option value="Hard">Hard</option>
              </select>
            </div>

            <div class="form-section-title" style="margin-top:32px;">✦ Recipe Details</div>

            <div class="form-group">
              <label>Ingredients *</label>
              <textarea class="form-textarea" name="ingredients" rows="5" placeholder="List each ingredient on a new line:&#10;&#10;- 1 kg chicken pieces&#10;- 2 onions, sliced&#10;- 3 garlic cloves&#10;- 1 tsp cumin" required></textarea>
            </div>

            <div class="form-group">
              <label>Instructions *</label>
              <textarea class="form-textarea" name="instructions" rows="7" placeholder="Write step-by-step instructions:&#10;&#10;Step 1: Heat olive oil in a tagine...&#10;Step 2: Add onions and garlic...&#10;Step 3: Stir in spices..." required></textarea>
            </div>

            <div class="form-actions">
              <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-secondary">
                <i class="fa fa-xmark"></i> Cancel
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="fa fa-floppy-disk"></i> Save Recipe
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
