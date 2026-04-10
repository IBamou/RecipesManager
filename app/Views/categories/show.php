<?php echo $this->include('layouts/header'); ?>

<div class="container">
    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
        <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-secondary"><i class="fas fa-arrow-left"></i></a>
        <h1 style="margin: 0;"><?php echo htmlspecialchars($category['name'] ?? 'Category'); ?></h1>
    </div>

    <?php if (!empty($category['description'])): ?>
        <div class="card" style="padding: 1.5rem; margin-bottom: 2rem;">
            <p style="color: var(--text-light);"><?php echo htmlspecialchars($category['description']); ?></p>
        </div>
    <?php endif; ?>

    <?php if (empty($recipes)): ?>
        <div class="card" style="padding: 4rem; text-align: center;">
            <i class="fas fa-utensils" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h2>No recipes in this category</h2>
            <p style="color: var(--text-light); margin: 1rem 0;">Be the first to add a recipe to this category!</p>
            <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary">Add Recipe</a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-3">
            <?php foreach ($recipes as $recipe): ?>
                <div class="card fade-in-up">
                    <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>">
                        <?php if (!empty($recipe['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>" class="card-img">
                        <?php else: ?>
                            <div style="height: 200px; background: var(--beige); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-utensils" style="font-size: 3rem; color: var(--text-light);"></i>
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h3 class="card-title"><a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>"><?php echo htmlspecialchars($recipe['name']); ?></a></h3>
                        <p class="card-text"><?php echo htmlspecialchars(substr($recipe['description'] ?? '', 0, 100)); ?>...</p>
                    </div>
                    <div class="card-footer">
                        <span><i class="fas fa-clock"></i> <?php echo ($recipe['preparation_time'] + $recipe['cooking_time']); ?> min</span>
                        <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-secondary btn-sm">View</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php echo $this->include('layouts/footer'); ?>
