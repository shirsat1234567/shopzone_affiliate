<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Edit Subcategory</h3>
    <a href="<?= base_url('admin/subcategories') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Subcategories
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

        <!-- Current Subcategory Info -->
        <div class="alert alert-warning">
            <h6><i class="fas fa-edit"></i> Currently Editing:</h6>
            <strong><?= ucfirst($subcategory->category_name) ?></strong> → 
            <strong><?= ucfirst($subcategory->name) ?></strong>
        </div>

        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category *</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">Choose Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->id ?>" 
                                        <?= $subcategory->category_id == $category->id ? 'selected' : '' ?>>
                                    <?= ucfirst($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Subcategory Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= set_value('name', $subcategory->name) ?>" required>
                        <div class="form-text">Enter subcategory name in lowercase</div>
                    </div>
                </div>
            </div>

            <!-- Warning Message -->
            <div class="alert alert-info">
                <h6><i class="fas fa-exclamation-triangle"></i> Important:</h6>
                <p class="mb-0">Changing this subcategory will affect all products currently using it. 
                Make sure to update product categories if needed.</p>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Subcategory
                </button>
                <a href="<?= base_url('admin/subcategories') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>