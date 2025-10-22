<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Add New Subcategory</h3>
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

        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category *</label>
                        <select class="form-select" id="category_id" name="category_id" required onchange="showCategoryPreview()">
                            <option value="">Choose Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->id ?>" 
                                        data-icon="<?= $category->icon ?>" 
                                        data-name="<?= $category->name ?>"
                                        <?= set_select('category_id', $category->id) ?>>
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
                               value="<?= set_value('name') ?>" required 
                               placeholder="e.g., shoes, shirts, etc.">
                        <div class="form-text">Enter subcategory name in lowercase</div>
                    </div>
                </div>
            </div>

            <!-- Category Preview -->
            <div id="categoryPreview" class="alert alert-info d-none">
                <h6><i class="fas fa-eye"></i> Preview:</h6>
                <div class="d-flex align-items-center gap-3">
                    <div>
                        <strong>Category:</strong> 
                        <span id="previewCategoryIcon"></span>
                        <span id="previewCategoryName"></span>
                    </div>
                    <div>
                        <strong>Will create subcategory:</strong> 
                        <span id="previewSubcategory" class="badge bg-secondary">-</span>
                    </div>
                </div>
            </div>

            <!-- Icon Reference -->
            <div class="card bg-light mb-3">
                <div class="card-body">
                    <h6><i class="fas fa-info-circle"></i> Subcategory Icons Reference:</h6>
                    <div class="row">
                        <div class="col-md-3">
                            <small class="text-muted">Men's Items:</small><br>
                            👞 shoes &nbsp; 👔 shirts &nbsp; 👖 pants &nbsp; ⌚ watches
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted">Women's Items:</small><br>
                            👗 tops &nbsp; 👖 jeans &nbsp; 💍 necklaces &nbsp; 💄 makeup
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted">Children & Books:</small><br>
                            🧸 toys &nbsp; 👕 clothes &nbsp; 👮 police &nbsp; 📘 mpsc
                        </div>
                        <div class="col-md-3">
                            <small class="text-muted">Others:</small><br>
                            🪑 chairs &nbsp; 🛏️ beds &nbsp; 📱 mobiles &nbsp; 💻 laptops
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Save Subcategory
                </button>
                <a href="<?= base_url('admin/subcategories') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Category preview functionality
function showCategoryPreview() {
    const select = document.getElementById('category_id');
    const preview = document.getElementById('categoryPreview');
    const nameInput = document.getElementById('name');
    
    if (select.value) {
        const option = select.options[select.selectedIndex];
        const categoryIcon = option.getAttribute('data-icon');
        const categoryName = option.getAttribute('data-name');
        
        document.getElementById('previewCategoryIcon').innerHTML = `<i class="${categoryIcon}"></i>`;
        document.getElementById('previewCategoryName').textContent = categoryName.charAt(0).toUpperCase() + categoryName.slice(1);
        
        preview.classList.remove('d-none');
        
        // Update subcategory preview when typing
        nameInput.addEventListener('input', function() {
            const subcategoryName = this.value || '-';
            document.getElementById('previewSubcategory').textContent = subcategoryName;
        });
    } else {
        preview.classList.add('d-none');
    }
}

// Validate form
document.querySelector('form').addEventListener('submit', function(e) {
    const category = document.getElementById('category_id').value;
    const name = document.getElementById('name').value.trim();
    
    if (!category || !name) {
        e.preventDefault();
        alert('Please fill in all required fields');
    }
});
</script>