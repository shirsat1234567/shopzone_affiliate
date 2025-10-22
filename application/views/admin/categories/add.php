<div class="card">
    <div class="card-body">
        <h3>Add New Category</h3>
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Category Name *</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Font Awesome Icon Class *</label>
                <input type="text" class="form-control" name="icon" 
                       placeholder="fas fa-male" required>
                <small class="text-muted">Example: fas fa-male, fas fa-female, etc.</small>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Save Category
            </button>
            <a href="<?= base_url('admin/categories') ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>