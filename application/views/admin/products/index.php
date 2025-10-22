
<!-- =======================
APPLICATION/VIEWS/ADMIN/PRODUCTS/INDEX.PHP
======================= -->

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Manage Products</h3>
    <a href="<?= base_url('admin/products/add') ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Product
    </a>
</div>

<div class="card">
    <div class="card-body">
        <?php if(!empty($products)): ?>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td><?= $product->id ?></td>
                                <td>
                                    <img src="<?= $product->image_url ?: 'https://via.placeholder.com/50' ?>" 
                                         alt="Product" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <strong><?= character_limiter($product->name, 30) ?></strong>
                                    <br>
                                    <small class="text-muted"><?= character_limiter($product->description, 50) ?></small>
                                </td>
                                <td>
                                    <?= ucfirst($product->category_name) ?><br>
                                    <small class="text-muted"><?= ucfirst($product->subcategory_name) ?></small>
                                </td>
                                <td>
                                    <strong class="text-success">₹<?= number_format($product->discounted_price) ?></strong><br>
                                    <?php if($product->original_price > $product->discounted_price): ?>
                                        <small class="text-muted"><del>₹<?= number_format($product->original_price) ?></del></small>
                                        <span class="badge bg-danger"><?= $product->discount_percentage ?>% OFF</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($product->rating > 0): ?>
                                        <span class="text-warning">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <?php if($i <= floor($product->rating)): ?>
                                                    <i class="fas fa-star"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star"></i>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </span>
                                        <br>
                                        <small><?= $product->rating ?> (<?= $product->reviews_count ?>)</small>
                                    <?php else: ?>
                                        <small class="text-muted">No rating</small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-<?= $product->status == 'active' ? 'success' : 'secondary' ?>">
                                        <?= ucfirst($product->status) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($product->featured): ?>
                                        <i class="fas fa-star text-warning" title="Featured"></i>
                                    <?php else: ?>
                                        <i class="far fa-star text-muted" title="Not Featured"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?= base_url('admin/products/edit/' . $product->id) ?>" 
                                           class="btn btn-outline-primary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= $product->affiliate_url ?>" target="_blank" 
                                           class="btn btn-outline-success" title="View Affiliate Link">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <a href="<?= base_url('admin/products/delete/' . $product->id) ?>" 
                                           class="btn btn-outline-danger" title="Delete"
                                           onclick="return confirm('Are you sure you want to delete this product?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <?php if(isset($pagination)): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pagination ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="fas fa-box fa-3x text-muted mb-3"></i>
                <h4>No products found</h4>
                <p class="text-muted">Start by adding your first product.</p>
                <a href="<?= base_url('admin/products/add') ?>" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
