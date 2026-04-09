<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($recipe['name']); ?> - Recipes Manager</title>
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
        <div class="card">
            <h1><?php echo htmlspecialchars($recipe['name']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
            
            <div class="actions mt-2">
                <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-secondary">Back to Recipes</a>
                <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['recipe_id']; ?>" class="btn">Edit</a>
            </div>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
