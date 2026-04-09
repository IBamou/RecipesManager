<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes - Recipes Manager</title>
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
        <div class="header-actions">
            <h1>Recipes</h1>
            <a href="<?php echo BASE_URL; ?>/recipes/create" class="btn btn-success">Add New Recipe</a>
        </div>
        
        <?php if (empty($recipes)): ?>
            <div class="card">
                <p class="text-center">No recipes found. <a href="<?php echo BASE_URL; ?>/recipes/create">Create your first recipe</a></p>
            </div>
        <?php else: ?>
            <div class="recipe-grid">
                <?php foreach ($recipes as $recipe): ?>
                    <div class="recipe-card">
                        <h3><?php echo htmlspecialchars($recipe['name']); ?></h3>
                        <p><?php echo htmlspecialchars($recipe['description']); ?></p>
                        <div class="actions">
                            <a href="<?php echo BASE_URL; ?>/recipes/show?recipe_id=<?php echo $recipe['recipe_id']; ?>" class="btn">View</a>
                            <a href="<?php echo BASE_URL; ?>/recipes/edit?id=<?php echo $recipe['recipe_id']; ?>" class="btn btn-secondary">Edit</a>
                            <form method="POST" action="<?php echo BASE_URL; ?>/recipes/delete" class="delete-form" style="display:inline;">
                                <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
