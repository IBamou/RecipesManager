<?php echo $this->include('layouts/header'); ?>

<div class="dashboard-layout">
    <aside class="dashboard-sidebar">
        <div class="user-profile-widget">
            <img src="https://i.pravatar.cc/150?u=<?php echo $_SESSION['user']['id'] ?? 0; ?>" alt="User Avatar">
            <h4><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></h4>
            <p><?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?></p>
        </div>
        <nav>
            <ul>
                <li><a href="<?php echo BASE_URL; ?>/dashboard" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="<?php echo BASE_URL; ?>/profile"><i class="fas fa-user-circle"></i> My Profile</a></li>
                <li><a href="<?php echo BASE_URL; ?>/recipes/create"><i class="fas fa-plus-circle"></i> Create Recipe</a></li>
                <li><a href="<?php echo BASE_URL; ?>/recipes"><i class="fas fa-book"></i> My Recipes</a></li>
                <li><a href="<?php echo BASE_URL; ?>/categories"><i class="fas fa-folder"></i> Categories</a></li>
                <li><a href="<?php echo BASE_URL; ?>/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </nav>
    </aside>

    <main class="dashboard-main">
        <div class="dashboard-header">
            <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'Chef'); ?>!</h1>
            <p>Here's a snapshot of your culinary activity.</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card fade-in-up">
                <i class="fas fa-utensils"></i>
                <div>
                    <div class="value"><?php echo $totalRecipes ?? 0; ?></div>
                    <div class="label">Recipes Published</div>
                </div>
            </div>
            <div class="stat-card fade-in-up" style="animation-delay: 0.1s;">
                <i class="fas fa-folder"></i>
                <div>
                    <div class="value"><?php echo $totalCategories ?? 0; ?></div>
                    <div class="label">Categories</div>
                </div>
            </div>
            <div class="stat-card fade-in-up" style="animation-delay: 0.2s;">
                <i class="fas fa-clock"></i>
                <div>
                    <div class="value"><?php echo $totalTime ?? 0; ?>m</div>
                    <div class="label">Total Cooking Time</div>
                </div>
            </div>
            <div class="stat-card fade-in-up" style="animation-delay: 0.3s;">
                <i class="fas fa-fire"></i>
                <div>
                    <div class="value"><?php echo $easyRecipes ?? 0; ?></div>
                    <div class="label">Easy Recipes</div>
                </div>
            </div>
        </div>

        <div class="dashboard-section">
            <h2>Your Recent Recipes</h2>
            <?php if (empty($recentRecipes)): ?>
                <div class="card" style="padding: 3rem; text-align: center; margin-top: 1.5rem;">
                    <i class="fas fa-utensils" style="font-size: 3rem; color: var(--text-light); margin-bottom: 1rem;"></i>
                    <p style="color: var(--text-light);">No recipes yet. Start by creating your first recipe!</p>
                    <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary" style="margin-top: 1rem;">Create Recipe</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-3" style="margin-top: 1.5rem;">
                    <?php foreach ($recentRecipes as $recipe): ?>
                        <div class="card fade-in-up">
                            <?php if (!empty($recipe['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($recipe['image_url']); ?>" alt="<?php echo htmlspecialchars($recipe['name']); ?>" class="card-img">
                            <?php else: ?>
                                <div style="height: 200px; background: var(--beige); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-utensils" style="font-size: 3rem; color: var(--text-light);"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h3 class="card-title"><?php echo htmlspecialchars($recipe['name']); ?></h3>
                                <p class="card-text"><?php echo htmlspecialchars(substr($recipe['description'] ?? '', 0, 100)); ?>...</p>
                            </div>
                            <div class="card-footer">
                                <span><i class="fas fa-clock"></i> <?php echo ($recipe['preparation_time'] + $recipe['cooking_time']); ?> min</span>
                                <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['id']; ?>">Edit</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php echo $this->include('layouts/footer'); ?>
