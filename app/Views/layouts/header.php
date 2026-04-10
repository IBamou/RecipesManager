<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Marrakech Food Lovers'; ?></title>
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
