<?php echo $this->include('layouts/header'); ?>

<div class="container" style="max-width: 800px; padding-top: 3rem;">
    <h1>Create a New Recipe</h1>
    <p style="color: var(--text-light); margin-bottom: 2rem;">Share your culinary masterpiece with the world!</p>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo BASE_URL; ?>/recipes/create">
                <div class="form-group">
                    <label for="name">Recipe Title</label>
                    <input type="text" id="name" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Short Description</label>
                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="category_id">Category</label>
                        <select id="category_id" name="category_id" class="form-control" required>
                            <option value="">Select category...</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image_url">Image URL</label>
                        <input type="url" id="image_url" name="image_url" class="form-control" placeholder="https://...">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="preparation_time">Prep Time (min)</label>
                        <input type="number" id="preparation_time" name="preparation_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="cooking_time">Cook Time (min)</label>
                        <input type="number" id="cooking_time" name="cooking_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="difficulty">Difficulty</label>
                        <select id="difficulty" name="difficulty" class="form-control">
                            <option value="Easy">Easy</option>
                            <option value="Medium" selected>Medium</option>
                            <option value="Hard">Hard</option>
                        </select>
                    </div>
                </div>
                
                <hr style="margin: 2rem 0; border: 0; border-top: 1px solid var(--beige);">

                <h3>Ingredients</h3>
                <div class="form-group">
                    <label for="ingredients">Ingredients (one per line)</label>
                    <textarea id="ingredients" name="ingredients" class="form-control" rows="5" placeholder="- 1 kg chicken&#10;- 2 onions&#10;- 3 garlic cloves" required></textarea>
                </div>

                <h3>Instructions</h3>
                <div class="form-group">
                    <label for="instructions">Instructions (one step per line)</label>
                    <textarea id="instructions" name="instructions" class="form-control" rows="7" placeholder="Step 1: Heat olive oil...&#10;Step 2: Add onions..." required></textarea>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <a href="<?php echo BASE_URL; ?>/recipes" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Publish Recipe</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>
