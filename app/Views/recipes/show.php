<?php require __DIR__ . '/../layouts/header.php'; ?>

<?php if (empty($recipe)): ?>
  <div class="page-body">
    <div class="empty-state" style="margin-top:4rem;">
      <i class="fas fa-triangle-exclamation"></i>
      <h3>Recipe not found</h3>
      <p>This recipe doesn't exist or has been removed.</p>
    </div>
  </div>
<?php else: ?>

<div class="page-header">
  <div>
    <h1 style="font-size:1.3rem;"><?php echo htmlspecialchars($recipe['name']); ?></h1>
    <div class="sub">
      <i class="fas fa-layer-group" style="color:var(--gold);"></i>
      <?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?>
    </div>
  </div>
  <div class="header-right">
    <a href="javascript:history.back()" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $recipe['user_id']): ?>
      <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-gold btn-sm">
        <i class="fas fa-pen"></i> Edit
      </a>
    <?php endif; ?>
  </div>
</div>

<div class="page-body">
  <div class="recipe-detail">

    <!-- LEFT: Main content -->
    <div>

      <!-- Hero image -->
      <?php if (!empty($recipe['image_url'])): ?>
        <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>"
             alt="<?php echo htmlspecialchars($recipe['name']); ?>"
             class="recipe-hero-img" style="margin-bottom:2rem;">
      <?php else: ?>
        <div class="recipe-hero-placeholder" style="margin-bottom:2rem;">
          <i class="fas fa-bowl-food"></i>
        </div>
      <?php endif; ?>

      <!-- Tags + Title -->
      <div class="recipe-tags">
        <span class="badge badge-gold"><?php echo htmlspecialchars($recipe['difficulty'] ?? 'Easy'); ?></span>
        <span class="badge"><?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?></span>
      </div>

      <h1 class="recipe-title"><?php echo htmlspecialchars($recipe['name']); ?></h1>
      <p class="recipe-desc"><?php echo htmlspecialchars($recipe['description'] ?? ''); ?></p>

      <!-- Meta bar -->
      <div class="meta-bar">
        <div class="meta-item">
          <div class="meta-val"><?php echo $recipe['preparation_time'] ?? 0; ?></div>
          <div class="meta-lbl">Prep (min)</div>
        </div>
        <div class="meta-item">
          <div class="meta-val"><?php echo $recipe['cooking_time'] ?? 0; ?></div>
          <div class="meta-lbl">Cook (min)</div>
        </div>
        <div class="meta-item">
          <div class="meta-val"><?php echo ($recipe['preparation_time'] ?? 0) + ($recipe['cooking_time'] ?? 0); ?></div>
          <div class="meta-lbl">Total (min)</div>
        </div>
        <div class="meta-item">
          <div class="meta-val"><?php echo htmlspecialchars($recipe['difficulty'] ?? '—'); ?></div>
          <div class="meta-lbl">Difficulty</div>
        </div>
      </div>

      <!-- Owner actions -->
      <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $recipe['user_id']): ?>
        <div style="display:flex;gap:.75rem;margin-bottom:2.5rem;">
          <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-outline btn-sm">
            <i class="fas fa-pen"></i> Edit Recipe
          </a>
          <form method="POST" action="<?php echo BASE_URL; ?>/recipes/delete"
                onsubmit="return confirm('Delete this recipe permanently?');">
            <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
          </form>
        </div>
      <?php endif; ?>

      <!-- Ingredients -->
      <?php if (!empty($recipe['ingredients'])): ?>
        <div class="recipe-section">
          <h3><i class="fas fa-list-ul" style="color:var(--gold);margin-right:.5rem;"></i>Ingredients</h3>
          <ul class="ingredient-list">
            <?php foreach (explode("\n", $recipe['ingredients']) as $line): ?>
              <?php $line = trim($line); if (!$line) continue; ?>
              <li><?php echo htmlspecialchars($line); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>

      <!-- Instructions -->
      <?php if (!empty($recipe['instructions'])): ?>
        <div class="recipe-section">
          <h3><i class="fas fa-list-ol" style="color:var(--gold);margin-right:.5rem;"></i>Instructions</h3>
          <ol class="step-list">
            <?php $step = 0; foreach (explode("\n", $recipe['instructions']) as $line): ?>
              <?php $line = trim($line); if (!$line) continue; $step++; ?>
              <li class="step-item">
                <div class="step-num"><?php echo $step; ?></div>
                <div><?php echo htmlspecialchars($line); ?></div>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      <?php endif; ?>

    </div><!-- /left -->

    <!-- RIGHT: Chef aside -->
    <aside>
      <div class="chef-aside">
        <?php 
        $chefName = !empty($chefUser['name']) ? $chefUser['name'] : 'Chef';
        $initials = strtoupper(substr($chefName, 0, 1) . (strpos($chefName, ' ') !== false ? substr($chefName, strpos($chefName, ' ') + 1, 1) : ''));
        ?>
        <div style="width:90px;height:90px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:2rem;color:#120d00;margin:0 auto 1rem;"><?php echo htmlspecialchars($initials); ?></div>
        <div class="chef-name"><?php echo htmlspecialchars($chefName); ?></div>
        <?php if (!empty($chefUser['bio'])): ?>
        <p style="font-size:.85rem;color:var(--muted);margin:.5rem 0;line-height:1.5;"><?php echo htmlspecialchars($chefUser['bio']); ?></p>
        <?php endif; ?>
        <?php if (!empty($chefUser['birthday'])): ?>
        <p style="font-size:.75rem;color:var(--gold);margin-bottom:1rem;"><i class="fas fa-birthday-cake"></i> <?php echo date('F j, Y', strtotime($chefUser['birthday'])); ?></p>
        <?php endif; ?>
      </div>
    </aside>

  </div><!-- /recipe-detail -->
</div>

<?php endif; ?>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
