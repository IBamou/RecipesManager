<?php echo $this->include('layouts/header'); ?>

<div class="container" style="max-width: 600px; padding-top: 3rem;">
    <h1>Create Category</h1>
    <p style="color: var(--text-light); margin-bottom: 2rem;">Create a new category to organize your recipes.</p>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="<?php echo BASE_URL; ?>/categories/create">
                <div class="form-group">
                    <label for="name">Category Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Main Course, Desserts, Drinks" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4" placeholder="A brief description of this category..."></textarea>
                </div>

                <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
                    <a href="<?php echo BASE_URL; ?>/categories" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php echo $this->include('layouts/footer'); ?>
