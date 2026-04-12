<?php require __DIR__ . '/../layouts/header.php'; ?>

<div class="page-header">
  <div>
    <h1><i class="fas fa-user" style="color:var(--gold);margin-right:.5rem;"></i> My Profile</h1>
    <div class="sub">Manage your account and personal information</div>
  </div>
</div>

<div class="page-body">
  <div class="profile-layout">

    <!-- MAIN FORM -->
    <div>
      <!-- Edit Form -->
      <div class="form-card fade-up">
        <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:1px solid var(--border);">
          <div style="width:36px;height:36px;border-radius:10px;background:linear-gradient(135deg,var(--gold),var(--gold-dk));display:flex;align-items:center;justify-content:center;">
            <i class="fas fa-user-pen" style="color:#120d00;font-size:.9rem;"></i>
          </div>
          <h3 style="font-family:var(--font-serif);font-size:1.2rem;margin:0;">Edit Profile</h3>
        </div>
        <form method="POST" action="<?php echo BASE_URL; ?>/profile/update">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
            <div class="form-group">
              <label class="form-label" style="font-size:.7rem;font-weight:600;">Full Name</label>
              <input type="text" id="name" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" required style="border-radius:8px;padding:.7rem 1rem;">
            </div>
            <div class="form-group">
              <label class="form-label" style="font-size:.7rem;font-weight:600;">Email Address</label>
              <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" disabled style="border-radius:8px;padding:.7rem 1rem;opacity:.5;">
              <div class="form-hint">Email cannot be changed</div>
            </div>
          </div>
          
          <div class="form-group">
            <label class="form-label" style="font-size:.7rem;font-weight:600;">Bio</label>
            <textarea id="bio" name="bio" class="form-control" rows="4" placeholder="Tell us about yourself... What are your favorite cuisines?" style="border-radius:8px;padding:.7rem 1rem;resize:none;"><?php echo htmlspecialchars($user['bio'] ?? ''); ?></textarea>
          </div>
          
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
            <div class="form-group">
              <label class="form-label" style="font-size:.7rem;font-weight:600;">Birthday</label>
              <input type="date" id="birthday" name="birthday" class="form-control" value="<?php echo $user['birthday'] ?? ''; ?>" style="border-radius:8px;padding:.7rem 1rem;">
            </div>
            <div class="form-group">
              <label class="form-label" style="font-size:.7rem;font-weight:600;">Member Since</label>
              <input type="text" class="form-control" value="<?php echo date('F Y', strtotime($user['created_at'] ?? 'now')); ?>" disabled style="border-radius:8px;padding:.7rem 1rem;opacity:.5;">
            </div>
          </div>
          
          <div style="padding-top:1rem;border-top:1px solid var(--border);margin-top:1rem;">
            <button type="submit" class="btn btn-gold btn-lg"><i class="fas fa-save"></i> Save Changes</button>
          </div>
        </form>
      </div>
    </div>

    <!-- ASIDE: Avatar card -->
    <div class="profile-aside fade-up">
      <?php 
      $name = $user['name'] ?? 'Chef';
      $initials = strtoupper(substr($name, 0, 1) . (strpos($name, ' ') !== false ? substr($name, strpos($name, ' ') + 1, 1) : ''));
      ?>
      <div style="width:100px;height:100px;border-radius:50%;background:var(--gold);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:2.2rem;color:#120d00;margin:0 auto 1rem;"><?php echo htmlspecialchars($initials); ?></div>
      <h3 style="font-family:var(--font-serif);font-size:1.3rem;margin-bottom:.3rem;"><?php echo htmlspecialchars($name); ?></h3>
      <p style="font-size:.85rem;color:var(--muted);margin-bottom:.5rem;"><?php echo htmlspecialchars($user['email'] ?? ''); ?></p>
      
      <?php if (!empty($user['bio'])): ?>
      <p style="font-size:.85rem;color:var(--text);margin-bottom:1rem;line-height:1.5;"><?php echo htmlspecialchars($user['bio']); ?></p>
      <?php endif; ?>
      
      <span class="badge badge-gold" style="padding:.4rem 1rem;">Home Chef</span>

      <hr class="divider">

      <nav style="display:flex;flex-direction:column;gap:.4rem;">
        <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-outline btn-sm" style="justify-content:flex-start;">
          <i class="fas fa-book-open" style="color:var(--gold);"></i> My Recipes
        </a>
        <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-outline btn-sm" style="justify-content:flex-start;">
          <i class="fas fa-layer-group" style="color:var(--gold);"></i> My Categories
        </a>
        <a href="<?php echo BASE_URL; ?>/favorites" class="btn btn-outline btn-sm" style="justify-content:flex-start;">
          <i class="fas fa-star" style="color:var(--gold);"></i> Favorites
        </a>
        <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-danger btn-sm" style="justify-content:flex-start;margin-top:.5rem;" onclick="return confirm('Log out?');">
          <i class="fas fa-right-from-bracket"></i> Logout
        </a>
      </nav>
    </div>

  </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>