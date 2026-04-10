<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1>Edit Recipe</h1>
    <div class="sub">Update <strong style="color:var(--gold)"><?php echo htmlspecialchars($recipe['name'] ?? ''); ?></strong></div>
  </div>
  <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id'] ?? ''; ?>" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="page-body" style="max-width:860px;">
  <div class="form-card fade-up">
    <form method="POST" action="<?php echo BASE_URL; ?>/recipes/edit">
      <input type="hidden" name="recipe_id" value="<?php echo $recipe['id'] ?? ''; ?>">

      <h3 style="font-family:var(--font-serif);font-size:1.2rem;color:var(--gold);margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--border);">
        <i class="fas fa-info-circle"></i> Basic Information
      </h3>

      <div class="form-group">
        <label class="form-label" for="name">Recipe Title</label>
        <input type="text" id="name" name="name" class="form-control"
               value="<?php echo htmlspecialchars($recipe['name'] ?? ''); ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Short Description</label>
        <textarea id="description" name="description" class="form-control" rows="3"><?php echo htmlspecialchars($recipe['description'] ?? ''); ?></textarea>
      </div>

      <div class="form-row form-row-2">
        <div class="form-group">
          <label class="form-label" for="category_id">Category</label>
          <select id="category_id" name="category_id" class="form-control" required>
            <option value="">Select a category…</option>
            <?php foreach ($categories as $cat): ?>
              <option value="<?php echo $cat['id']; ?>" <?php echo ($recipe['category_id'] == $cat['id']) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($cat['name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label" for="image_url">Image URL</label>
          <input type="url" id="image_url" name="image_url" class="form-control"
                 value="<?php echo htmlspecialchars($recipe['image_url'] ?? ''); ?>"
                 placeholder="https://…">
        </div>
      </div>

      <div class="form-row form-row-3">
        <div class="form-group">
          <label class="form-label" for="preparation_time">Prep Time (min)</label>
          <input type="number" id="preparation_time" name="preparation_time" class="form-control"
                 value="<?php echo $recipe['preparation_time'] ?? 0; ?>" min="0" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="cooking_time">Cook Time (min)</label>
          <input type="number" id="cooking_time" name="cooking_time" class="form-control"
                 value="<?php echo $recipe['cooking_time'] ?? 0; ?>" min="0" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="difficulty">Difficulty</label>
          <select id="difficulty" name="difficulty" class="form-control">
            <?php foreach (['Easy','Medium','Hard'] as $d): ?>
              <option value="<?php echo $d; ?>" <?php echo ($recipe['difficulty'] == $d) ? 'selected' : ''; ?>><?php echo $d; ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>

      <hr class="divider">

      <h3 style="font-family:var(--font-serif);font-size:1.2rem;color:var(--gold);margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--border);">
        <i class="fas fa-list-ul"></i> Ingredients
      </h3>
      <div class="form-group">
        <label class="form-label" for="ingredients">One ingredient per line</label>
        <textarea id="ingredients" name="ingredients" class="form-control" rows="6" required><?php echo htmlspecialchars($recipe['ingredients'] ?? ''); ?></textarea>
      </div>

      <hr class="divider">

      <h3 style="font-family:var(--font-serif);font-size:1.2rem;color:var(--gold);margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--border);">
        <i class="fas fa-list-ol"></i> Instructions
      </h3>
      <div class="form-group">
        <label class="form-label" for="instructions">One step per line</label>
        <textarea id="instructions" name="instructions" class="form-control" rows="8" required><?php echo htmlspecialchars($recipe['instructions'] ?? ''); ?></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-gold"><i class="fas fa-check"></i> Save Changes</button>
        <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-outline">Cancel</a>
      </div>

    </form>
  </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
