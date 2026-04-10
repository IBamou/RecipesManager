<?php echo $this->include('layouts/header'); ?>

<div class="container">
    <?php if (empty($recipe)): ?>
        <div class="card" style="padding: 4rem; text-align: center;">
            <i class="fas fa-exclamation-triangle" style="font-size: 4rem; color: var(--text-light); margin-bottom: 1rem;"></i>
            <h2>Recipe not found</h2>
            <p style="color: var(--text-light); margin: 1rem 0;">The recipe you're looking for doesn't exist.</p>
            <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-primary">Back to Recipes</a>
        </div>
    <?php else: ?>
        <div class="recipe-show-layout">
            <div class="recipe-main-content">
                <?php if (!empty($recipe['image_url'])): ?>
                    <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>" class="recipe-main-image">
                <?php else: ?>
                    <div style="height: 400px; background: var(--beige); border-radius: 20px; margin-bottom: 2rem; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-utensils" style="font-size: 6rem; color: var(--text-light);"></i>
                    </div>
                <?php endif; ?>
                
                <h1><?php echo htmlspecialchars($recipe['name']); ?></h1>
                <p style="font-size: 1.2rem; color: var(--text-light); margin: 1rem 0;"><?php echo htmlspecialchars($recipe['description'] ?? ''); ?></p>
                
                <div class="recipe-meta">
                    <span><i class="fas fa-clock"></i> Prep: <?php echo $recipe['preparation_time']; ?> min</span>
                    <span><i class="fas fa-fire"></i> Cook: <?php echo $recipe['cooking_time']; ?> min</span>
                    <span><i class="fas fa-signal"></i> <?php echo htmlspecialchars($recipe['difficulty']); ?></span>
                    <span><i class="fas fa-folder"></i> <?php echo htmlspecialchars($recipe['category_name'] ?? 'Uncategorized'); ?></span>
                </div>

                <div class="recipe-actions">
                    <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>" class="btn btn-primary"><i class="fas fa-edit"></i> Edit Recipe</a>
                    <form method="POST" action="<?php echo BASE_URL; ?>/recipes/delete" style="display: inline;" onsubmit="return confirm('Are you sure?');">
                        <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                        <button type="submit" class="btn btn-olive"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>

                <?php if (!empty($recipe['ingredients'])): ?>
                    <div class="recipe-section">
                        <h3><i class="fas fa-list-ul"></i> Ingredients</h3>
                        <ul class="ingredients-list">
                            <?php foreach (explode("\n", $recipe['ingredients']) as $ingredient): ?>
                                <?php if (trim($ingredient)): ?>
                                    <li><?php echo htmlspecialchars(trim($ingredient)); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (!empty($recipe['instructions'])): ?>
                    <div class="recipe-section">
                        <h3><i class="fas fa-shoe-prints"></i> Instructions</h3>
                        <ol class="instructions-list">
                            <?php foreach (explode("\n", $recipe['instructions']) as $step): ?>
                                <?php if (trim($step)): ?>
                                    <li><?php echo htmlspecialchars(trim($step)); ?></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                <?php endif; ?>
            </div>

            <aside class="recipe-sidebar">
                <div class="card" style="position: sticky; top: 100px;">
                    <div class="chef-profile-card" style="padding: 2rem;">
                        <img src="https://i.pravatar.cc/150?u=<?php echo $recipe['user_id'] ?? 0; ?>" alt="Chef">
                        <h3><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'Chef'); ?></h3>
                        <p style="color: var(--text-light);">Home Chef</p>
                        <a href="<?php echo BASE_URL; ?>/profile" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">View Profile</a>
                    </div>
                </div>
            </aside>
        </div>
    <?php endif; ?>
</div>

<?php echo $this->include('layouts/footer'); ?>
