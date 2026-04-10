<?php echo $this->include('layouts/header'); ?>

<div class="auth-split-layout">
    <div class="auth-image-panel" style="background-image: linear-gradient(rgba(44, 36, 22, 0.7), rgba(44, 36, 22, 0.2)), url('https://images.unsplash.com/photo-1547592180-85f173990554?w=1200');">
        <div class="auth-image-content">
            <h1>Join Us!</h1>
            <p>Create an account to start sharing and discovering authentic Moroccan recipes.</p>
        </div>
    </div>
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <h2>Create Your Account</h2>
            <?php if (!empty($error)): ?>
                <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-bottom:1rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div style="background:#d4edda; color:#155724; padding:12px; border-radius:8px; margin-bottom:1rem;">
                    <?php echo htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo BASE_URL; ?>/auth/signup">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Sign Up</button>
            </form>
            <p class="auth-switch">Already have an account? <a href="<?php echo BASE_URL; ?>/auth/login">Login</a></p>
        </div>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>
