<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe - Recipes Manager</title>
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
            <h1>Edit Recipe</h1>
            
            <form method="POST" action="">
                <input type="hidden" name="recipe_id" value="<?php echo $recipe['recipe_id']; ?>">
                
                <div class="form-group">
                    <label for="name">Recipe Name</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($recipe['name']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>
                </div>
                
                <div class="actions">
                    <button type="submit" class="btn btn-success">Update Recipe</button>
                    <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
