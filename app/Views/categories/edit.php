<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1>Edit Category</h1>
    <div class="sub">Update the details of <strong style="color:var(--gold)"><?php echo htmlspecialchars($category['name'] ?? ''); ?></strong></div>
  </div>
  <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<div class="page-body" style="max-width:620px;">
  <div class="form-card fade-up">
    <form method="POST" action="<?php echo BASE_URL; ?>/categories/edit">
      <input type="hidden" name="category_id" value="<?php echo $category['id'] ?? ''; ?>">

      <div class="form-group">
        <label class="form-label" for="name">Category Name</label>
        <input type="text" id="name" name="name" class="form-control"
               value="<?php echo htmlspecialchars($category['name'] ?? ''); ?>" required>
      </div>

      <div class="form-group">
        <label class="form-label" for="description">Description</label>
        <textarea id="description" name="description" class="form-control"><?php echo htmlspecialchars($category['description'] ?? ''); ?></textarea>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn-gold"><i class="fas fa-check"></i> Update Category</button>
        <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
