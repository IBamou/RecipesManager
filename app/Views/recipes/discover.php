<?php echo $this->include('layouts/header'); ?>

<div class="container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h1>Discover Recipes</h1>
        <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary"><i class="fas fa-plus"></i> Share Recipe</a>
    </div>

    <?php if (empty($recipes)): ?>
        <div class="card" style="padding: 4rem; text-align: center;">
            <i class="fas fa-search" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h2>No recipes found</h2>
            <p style="color: var(--text-light); margin: 1rem 0;">Be the first to share a recipe!</p>
            <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary">Share Your Recipe</a>
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
                        <div style="display: flex; gap: 1rem; margin-top: 1rem; color: var(--text-light); font-size: 0.85rem;">
                            <span><i class="fas fa-clock"></i> <?php echo ($recipe['preparation_time'] + $recipe['cooking_time']); ?> min</span>
                            <span><i class="fas fa-signal"></i> <?php echo htmlspecialchars($recipe['difficulty']); ?></span>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span><i class="fas fa-folder"></i> <?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?></span>
                        <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['id']; ?>" class="btn btn-secondary" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;">View</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php echo $this->include('layouts/footer'); ?>
