<?php echo $this->include('layouts/header'); ?>

<div class="container" style="max-width: 600px; padding-top: 3rem;">
    <h1>Edit Category</h1>
    <p style="color: var(--text-light); margin-bottom: 2rem;">Update your category details.</p>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo BASE_URL; ?>/categories/edit">
                <input type="hidden" name="category_id" value="<?php echo $category['id'] ?? ''; ?>">
                
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($category['name'] ?? ''); ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($category['description'] ?? ''); ?></textarea>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>
