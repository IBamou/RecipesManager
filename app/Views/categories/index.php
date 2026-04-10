<?php echo $this->include('layouts/header'); ?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Categories</h1>
        <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-primary"><i class="fas fa-plus"></i> Add Category</a>
    </div>

    <?php if (empty($categories)): ?>
        <div class="card" style="padding: 4rem; text-align: center;">
            <i class="fas fa-folder-open" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h2>No categories yet</h2>
            <p style="color: var(--text-light); margin: 1rem 0;">Create categories to organize your recipes!</p>
            <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-primary">Create First Category</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-3">
            <?php foreach ($categories as $category): ?>
                <div class="card fade-in-up">
                    <div class="card-body" style="text-align: center;">
                        <i class="fas fa-folder" style="font-size: 3rem; color: var(--primary-brown); margin-bottom: 1rem;"></i>
                        <h3 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h3>
                        <p class="card-text"><?php echo htmlspecialchars($category['description'] ?? 'No description'); ?></p>
                        <p style="color: var(--text-light); font-size: 0.85rem; margin-top: 1rem;">
                            <i class="fas fa-utensils"></i> <?php echo $category['recipe_count'] ?? 0; ?> recipes
                        </p>
                    </div>
                    <div class="card-footer" style="justify-content: center; gap: 0.5rem;">
                        <a href="<?php echo BASE_URL; ?>/categories/show?category_id=<?php echo $category['id']; ?>" class="btn btn-secondary btn-sm">View</a>
                        <a href="<?php echo BASE_URL; ?>/categories/edit?id=<?php echo $category['id']; ?>" class="btn btn-secondary btn-sm">Edit</a>
                        <form method="POST" action="<?php echo BASE_URL; ?>/categories/delete" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                            <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
                            <button type="submit" class="btn btn-olive btn-sm"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php echo $this->include('layouts/footer'); ?>
