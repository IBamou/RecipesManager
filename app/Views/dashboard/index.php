<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Recipes Manager</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="<?php echo BASE_URL; ?>/dashboard" class="navbar-brand">Recipes Manager</a>
            <ul class="navbar-nav">
                <li><a href="<?php echo BASE_URL; ?>/dashboard">Dashboard</a></li>
                <li><a href="<?php echo BASE_URL; ?>/recipes">Recipes</a></li>
                <li><a href="<?php echo BASE_URL; ?>/categories">Categories</a></li>
                <li><a href="<?php echo BASE_URL; ?>/logout">Logout</a></li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        <h1>Welcome to Recipes Manager</h1>
        <p>Manage your recipes and categories efficiently.</p>
        
        <div class="recipe-grid">
            <div class="card">
                <h3>Recipes</h3>
                <p>Create, view, edit and delete your recipes.</p>
                <a href="<?php echo BASE_URL; ?>/recipes" class="btn">Manage Recipes</a>
            </div>
            
            <div class="card">
                <h3>Categories</h3>
                <p>Organize your recipes by categories.</p>
                <a href="<?php echo BASE_URL; ?>/categories" class="btn">Manage Categories</a>
            </div>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
