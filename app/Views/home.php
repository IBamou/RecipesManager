<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marrakech Food Lovers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>

<header class="site-header">
    <a href="<?php echo BASE_URL; ?>" class="logo"><i class="fas fa-utensils"></i> Marrakech Food Lovers</a>
    
    <nav class="main-nav">
        <ul>
            <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="<?php echo BASE_URL; ?>/recipes/discover">Discover</a></li>
                <li><a href="<?php echo BASE_URL; ?>/categories">Categories</a></li>
                <li><a href="<?php echo BASE_URL; ?>/dashboard">Dashboard</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="header-actions">
        <?php if (isset($_SESSION['user'])): ?>
            <a href="<?php echo BASE_URL; ?>/profile" class="btn btn-secondary"><i class="fas fa-user"></i> Profile</a>
            <a href="<?php echo BASE_URL; ?>/logout" class="btn btn-primary">Logout</a>
        <?php else: ?>
            <a href="<?php echo BASE_URL; ?>/auth/login" class="btn btn-secondary">Login</a>
            <a href="<?php echo BASE_URL; ?>/auth/signup" class="btn btn-primary">Sign Up</a>
        <?php endif; ?>
    </div>
    
    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()"><i class="fas fa-bars"></i></button>
</header>

<main>
    <!-- Hero Section -->
    <section class="hero" style="background: linear-gradient(rgba(44, 36, 22, 0.5), rgba(44, 36, 22, 0.5)), url('https://images.unsplash.com/photo-1600891964599-4a39b217953c?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=1600') center/cover no-repeat; height: 80vh; display: flex; align-items: center; justify-content: center; text-align: center; color: white;">
        <div class="container fade-in-up">
            <h1 style="color: white; font-size: 4rem;">Taste the Magic of Marrakech</h1>
            <p style="font-size: 1.5rem; max-width: 600px; margin: 1rem auto 2rem; font-weight: 300;">Discover, share, and cook authentic Moroccan recipes in a vibrant community of food lovers.</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <?php if (!isset($_SESSION['user'])): ?>
                    <a href="<?php echo BASE_URL; ?>/auth/signup" class="btn btn-primary" style="padding: 1rem 2rem;">Get Started</a>
                    <a href="<?php echo BASE_URL; ?>/recipes/discover" class="btn btn-olive" style="padding: 1rem 2rem;">Explore Recipes</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>/recipes/discover" class="btn btn-primary" style="padding: 1rem 2rem;">Explore Recipes</a>
                    <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-olive" style="padding: 1rem 2rem;">Share Recipe</a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container">
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; text-align: center; margin-top: -80px; position: relative; z-index: 10;">
            <div class="card fade-in-up">
                <div class="card-body">
                    <i class="fas fa-book-open" style="font-size: 3rem; color: var(--primary-brown); margin-bottom: 1rem;"></i>
                    <h3>Thousands of Recipes</h3>
                    <p>From tagines to pastries, find your next favorite dish.</p>
                </div>
            </div>
            <div class="card fade-in-up" style="animation-delay: 0.1s;">
                <div class="card-body">
                    <i class="fas fa-users" style="font-size: 3rem; color: var(--primary-brown); margin-bottom: 1rem;"></i>
                    <h3>Vibrant Community</h3>
                    <p>Connect with fellow foodies and share your culinary creations.</p>
                </div>
            </div>
            <div class="card fade-in-up" style="animation-delay: 0.2s;">
                <div class="card-body">
                    <i class="fas fa-utensils" style="font-size: 3rem; color: var(--primary-brown); margin-bottom: 1rem;"></i>
                    <h3>Cook Like a Pro</h3>
                    <p>Step-by-step guides and tips to master Moroccan cooking.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section style="background-color: var(--beige); padding: 4rem 0; margin-top: 4rem;">
        <div class="container">
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; text-align: center;">
                <div class="fade-in-up">
                    <h2 style="font-size: 3rem; color: var(--primary-brown);">1,200+</h2>
                    <p>Recipes Shared</p>
                </div>
                <div class="fade-in-up" style="animation-delay: 0.1s;">
                    <h2 style="font-size: 3rem; color: var(--primary-brown);">5,000+</h2>
                    <p>Active Members</p>
                </div>
                <div class="fade-in-up" style="animation-delay: 0.2s;">
                    <h2 style="font-size: 3rem; color: var(--primary-brown);">50+</h2>
                    <p>Categories</p>
                </div>
                <div class="fade-in-up" style="animation-delay: 0.3s;">
                    <h2 style="font-size: 3rem; color: var(--primary-brown);">100%</h2>
                    <p>Delicious</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="container" style="text-align: center; padding: 4rem 0;">
        <h2 class="fade-in-up">Ready to Start Your Culinary Journey?</h2>
        <p class="fade-in-up" style="color: var(--text-light); margin-bottom: 2rem;">Create an account today and unlock a world of flavor.</p>
        <?php if (!isset($_SESSION['user'])): ?>
            <a href="<?php echo BASE_URL; ?>/auth/signup" class="btn btn-primary fade-in-up" style="padding: 1rem 2rem;">Create Your Account</a>
        <?php else: ?>
            <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-primary fade-in-up" style="padding: 1rem 2rem;">Share Your First Recipe</a>
        <?php endif; ?>
    </section>
</main>

<footer class="site-footer">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div>
                <h4>About Us</h4>
                <p>Marrakech Food Lovers is a passionate community for sharing and discovering authentic Moroccan recipes and culinary traditions.</p>
            </div>
            <div>
                <h4>Quick Links</h4>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="<?php echo BASE_URL; ?>">Home</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/recipes/discover">Discover Recipes</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/categories">Categories</a></li>
                </ul>
            </div>
            <div>
                <h4>Follow Us</h4>
                <ul style="list-style: none; padding: 0;">
                    <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li><a href="#"><i class="fab fa-pinterest-p"></i> Pinterest</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Marrakech Food Lovers. All rights reserved.</p>
        </div>
    </div>
</footer>

<script src="<?php echo BASE_URL; ?>/public/js/script.js"></script>
</body>
</html>
