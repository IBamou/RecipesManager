<?php echo $this->include('layouts/header'); ?>

<div class="auth-split-layout">
    <div class="auth-image-panel">
        <div class="auth-image-content">
            <h1>Welcome Back!</h1>
            <p>Log in to access your personal recipe box and connect with our community.</p>
        </div>
    </div>
    <div class="auth-form-panel">
        <div class="auth-form-container">
            <h2>Login to Your Account</h2>
            <?php if (!empty($error)): ?>
                <div style="background:#f8d7da; color:#721c24; padding:12px; border-radius:8px; margin-bottom:1rem;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="<?php echo BASE_URL; ?>/auth/login">
                <div class="form-group">
                    <label for="name_or_email">Email Address</label>
                    <input type="text" id="name_or_email" name="name_or_email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Login</button>
            </form>
            <p class="auth-switch">Don't have an account? <a href="<?php echo BASE_URL; ?>/auth/signup">Sign Up</a></p>
        </div>
    </div>
</div>
