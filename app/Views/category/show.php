<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($category['name']); ?> - Recipes Manager</title>
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
            <h1><?php echo htmlspecialchars($category['name']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($category['description'])); ?></p>
            
            <h3 class="mt-2">Recipes in this Category</h3>
            
            <?php if (empty($recipes)): ?>
                <p>No recipes in this category yet.</p>
            <?php else: ?>
                <div class="recipe-grid">
                    <?php foreach ($recipes as $recipe): ?>
                        <div class="recipe-card">
                            <h3><?php echo htmlspecialchars($recipe['name']); ?></h3>
                            <p><?php echo htmlspecialchars($recipe['description']); ?></p>
                            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['recipe_id']; ?>" class="btn">View Recipe</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="actions mt-2">
                <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-secondary">Back to Categories</a>
                <a href="<?php echo BASE_URL; ?>/categories/edit?id=<?php echo $category['category_id']; ?>" class="btn">Edit</a>
            </div>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
