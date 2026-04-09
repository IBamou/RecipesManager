<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Recipes Manager</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="card">
            <h1>Sign Up</h1>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
                <p class="text-center"><a href="<?php echo BASE_URL; ?>/login">Go to Login</a></p>
            <?php else: ?>
            
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" required>
                </div>
                
                <button type="submit" class="btn" style="width: 100%;">Sign Up</button>
            </form>
            
            <?php endif; ?>
            
            <p class="text-center mt-2">
                Already have an account? <a href="<?php echo BASE_URL; ?>/login">Login</a>
            </p>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
