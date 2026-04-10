<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1>My Profile</h1>
    <div class="sub">Manage your account and personal information</div>
  </div>
</div>

<div class="page-body">
  <div class="profile-layout">

    <!-- MAIN FORM -->
    <div>
      <!-- Stats -->
      <div class="grid grid-3" style="margin-bottom:2rem;">
        <div class="stat-card fade-up">
          <div class="stat-icon"><i class="fas fa-utensils"></i></div>
          <div><div class="stat-num"><?php echo $totalRecipes ?? 0; ?></div><div class="stat-label">Recipes</div></div>
        </div>
        <div class="stat-card fade-up" style="animation-delay:.1s">
          <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
          <div><div class="stat-num"><?php echo $totalCategories ?? 0; ?></div><div class="stat-label">Categories</div></div>
        </div>
        <div class="stat-card fade-up" style="animation-delay:.2s">
          <div class="stat-icon"><i class="fas fa-calendar"></i></div>
          <div><div class="stat-num"><?php echo date('Y'); ?></div><div class="stat-label">Member Since</div></div>
        </div>
      </div>

      <!-- Edit Form -->
      <div class="form-card fade-up" style="animation-delay:.3s">
        <h3 style="font-family:var(--font-serif);font-size:1.2rem;color:var(--gold);margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:1px solid var(--border);">
          <i class="fas fa-user-pen"></i> Edit Profile
        </h3>
        <form method="POST" action="<?php echo BASE_URL; ?>/profile/update">
          <div class="form-group">
            <label class="form-label" for="name">Full Name</label>
            <input type="text" id="name" name="name" class="form-control"
                   value="<?php echo htmlspecialchars($_SESSION['user']['name'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input type="email" id="email" class="form-control"
                   value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?>"
                   disabled style="opacity:.5;cursor:not-allowed;">
            <div class="form-hint">Email cannot be changed.</div>
          </div>
          <div class="form-actions">
            <button type="submit" class="btn btn-gold"><i class="fas fa-check"></i> Save Changes</button>
          </div>
        </form>
      </div>
    </div>

    <!-- ASIDE: Avatar card -->
    <div class="profile-aside fade-up" style="animation-delay:.15s">
      <img src="https://i.pravatar.cc/150?u=<?php echo $_SESSION['user']['id'] ?? 0; ?>" alt="Avatar">
      <h3 style="font-family:var(--font-serif);font-size:1.2rem;margin-bottom:.3rem;"><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'Chef'); ?></h3>
      <p style="font-size:.8rem;color:var(--muted);margin-bottom:1.5rem;"><?php echo htmlspecialchars($_SESSION['user']['email'] ?? ''); ?></p>
      <span class="badge badge-gold" style="padding:.4rem 1rem;">Home Chef</span>

      <hr class="divider">

      <nav style="display:flex;flex-direction:column;gap:.4rem;">
        <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-outline btn-sm" style="justify-content:flex-start;">
          <i class="fas fa-book-open" style="color:var(--gold);"></i> My Recipes
        </a>
        <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-outline btn-sm" style="justify-content:flex-start;">
          <i class="fas fa-layer-group" style="color:var(--gold);"></i> My Categories
        </a>
        <a href="<?php echo BASE_URL; ?>/recipes/discover" class="btn btn-outline btn-sm" style="justify-content:flex-start;">
          <i class="fas fa-star" style="color:var(--gold);"></i> Favorites
        </a>
        <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-danger btn-sm" style="justify-content:flex-start;margin-top:.5rem;"
           onclick="return confirm('Log out?');">
          <i class="fas fa-right-from-bracket"></i> Logout
        </a>
      </nav>
    </div>

  </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
