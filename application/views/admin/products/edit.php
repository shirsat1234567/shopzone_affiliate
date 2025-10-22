
<!-- =======================
APPLICATION/VIEWS/ADMIN/PRODUCTS/EDIT.PHP
======================= -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Edit Product</h3>
    <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Products
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
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" class="form-control" id="name" name="name" 
                               value="<?= set_value('name', $product->name) ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select class="form-select" id="category" name="category" 
                                onchange="getSubcategories(this.value)" required>
                            <option value="">Select Category</option>
                            <?php foreach($categories as $category): ?>
                                <option value="<?= $category->name ?>" 
                                        <?= $product->category == $category->name ? 'selected' : '' ?>>
                                    <?= ucfirst($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="subcategory" class="form-label">Subcategory *</label>
                        <select class="form-select" id="subcategory" name="subcategory" required>
                            <option value="<?= $product->subcategory ?>" selected>
                                <?= ucfirst($product->subcategory) ?>
                            </option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" 
                          rows="3"><?= set_value('description', $product->description) ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="original_price" class="form-label">Original Price (₹) *</label>
                        <input type="number" class="form-control" id="original_price" name="original_price" 
                               step="0.01" min="0" value="<?= set_value('original_price', $product->original_price) ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="discounted_price" class="form-label">Sale Price (₹) *</label>
                        <input type="number" class="form-control" id="discounted_price" name="discounted_price" 
                               step="0.01" min="0" value="<?= set_value('discounted_price', $product->discounted_price) ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1-5)</label>
                        <input type="number" class="form-control" id="rating" name="rating" 
                               step="0.1" min="1" max="5" value="<?= set_value('rating', $product->rating) ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="reviews_count" class="form-label">Reviews Count</label>
                        <input type="number" class="form-control" id="reviews_count" name="reviews_count" 
                               min="0" value="<?= set_value('reviews_count', $product->reviews_count) ?>">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="image_url" class="form-label">Image URL</label>
                <input type="url" class="form-control" id="image_url" name="image_url" 
                       value="<?= set_value('image_url', $product->image_url) ?>">
                <?php if($product->image_url): ?>
                    <div class="mt-2">
                        <img src="<?= $product->image_url ?>" alt="Current image" 
                             class="img-thumbnail" style="max-width: 150px;">
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="affiliate_url" class="form-label">Amazon Affiliate URL *</label>
                <input type="url" class="form-control" id="affiliate_url" name="affiliate_url" 
                       value="<?= set_value('affiliate_url', $product->affiliate_url) ?>" required>
            </div>

            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1" 
                           <?= $product->featured ? 'checked' : '' ?>>
                    <label class="form-check-label" for="featured">
                        Featured Product (will appear on homepage)
                    </label>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Product
                </button>
                <a href="<?= base_url('admin/products') ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
// Load subcategories for current category on page load
document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category');
    const currentCategory = categorySelect.value;
    if (currentCategory) {
        getSubcategories(currentCategory);
    }
});
</script>                     