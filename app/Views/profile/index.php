<?php echo $this->include('layouts/header'); ?>

<div class="container" style="padding-top: 3rem;">
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 3rem;">
        <div class="main-content">
            <h1><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?>'s Profile</h1>
            <p style="color: var(--text-light);">Member since <?php echo date('F Y'); ?></p>
            
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin: 2rem 0;">
                <div class="stat-card">
                    <i class="fas fa-utensils"></i>
                    <div><div class="value"><?php echo $totalRecipes ?? 0; ?></div><div class="label">Recipes</div></div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-folder"></i>
                    <div><div class="value"><?php echo $totalCategories ?? 0; ?></div><div class="label">Categories</div></div>
                </div>
                <div class="stat-card">
                    <i class="fas fa-calendar"></i>
                    <div><div class="value"><?php echo date('Y'); ?></div><div class="label">Joined</div></div>
                </div>
            </div>

            <h2>Edit Profile</h2>
            <div class="card" style="margin-top: 1.5rem;">
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>/profile/update">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?>" disabled>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <aside class="sidebar">
            <div class="card chef-profile-card">
                <div style="padding: 2rem; text-align: center;">
                    <img src="https://i.pravatar.cc/150?u=<?php echo $_SESSION['user']['id'] ?? 0; ?>" alt="Profile" style="width: 100px; height: 100px; border-radius: 50%; margin: 0 auto 1rem; border: 4px solid var(--light-brown);">
                    <h3><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User'); ?></h3>
                    <p style="color: var(--text-light);">Home Chef</p>
                </div>
            </div>
        </aside>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>
