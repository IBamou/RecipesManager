<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Recipes Manager</title>
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
            <h1>Categories</h1>
            <a href="<?php echo BASE_URL; ?>/categories/create" class="btn btn-success">Add New Category</a>
        </div>
        
        <?php if (empty($categories)): ?>
            <div class="card">
                <p class="text-center">No categories found. <a href="<?php echo BASE_URL; ?>/categories/create">Create your first category</a></p>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cat['name']); ?></td>
                            <td><?php echo htmlspecialchars($cat['description']); ?></td>
                            <td>
                                <div class="actions">
                                    <a href="<?php echo BASE_URL; ?>/categories/show?category_id=<?php echo $cat['category_id']; ?>" class="btn">View</a>
                                    <a href="<?php echo BASE_URL; ?>/categories/edit?id=<?php echo $cat['category_id']; ?>" class="btn btn-secondary">Edit</a>
                                    <form method="POST" action="<?php echo BASE_URL; ?>/categories/delete" class="delete-form" style="display:inline;">
                                        <input type="hidden" name="category_id" value="<?php echo $cat['category_id']; ?>">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
    
    <script src="<?php echo BASE_URL; ?>/public/js/main.js"></script>
</body>
</html>
