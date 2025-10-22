
<!-- =======================
APPLICATION/VIEWS/ADMIN/DASHBOARD.PHP
======================= -->

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="card-body">
                <i class="fas fa-box fa-2x text-primary mb-2"></i>
                <h3><?= $stats['total_products'] ?></h3>
                <p class="text-muted mb-0">Total Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="card-body">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <h3><?= $stats['active_products'] ?></h3>
                <p class="text-muted mb-0">Active Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="card-body">
                <i class="fas fa-star fa-2x text-warning mb-2"></i>
                <h3><?= $stats['featured_products'] ?></h3>
                <p class="text-muted mb-0">Featured Products</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3">
            <div class="card-body">
                <i class="fas fa-tags fa-2x text-info mb-2"></i>
                <h3><?= $stats['total_categories'] ?></h3>
                <p class="text-muted mb-0">Categories</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Recent Products</h5>
            </div>
            <div class="card-body">
                <?php if(!empty($recent_products)): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($recent_products as $product): ?>
                                    <tr>
                                        <td><?= character_limiter($product->name, 30) ?></td>
                                        <td><?= ucfirst($product->category) ?></td>
                                        <td>₹<?= number_format($product->discounted_price) ?></td>
                                        <td>
                                            <span class="badge bg-<?= $product->status == 'active' ? 'success' : 'secondary' ?>">
                                                <?= ucfirst($product->status) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="<?= base_url('admin/products/edit/' . $product->id) ?>" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?= base_url('admin/products/add') ?>" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Add New Product
                    </a>
                    <a href="<?= base_url('admin/products') ?>" class="btn btn-outline-primary">
                        <i class="fas fa-box"></i> Manage Products
                    </a>
                    <a href="<?= base_url() ?>" target="_blank" class="btn btn-outline-success">
                        <i class="fas fa-eye"></i> View Website
                    </a>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5>System Info</h5>
            </div>
            <div class="card-body">
                <p><strong>CodeIgniter Version:</strong> <?= CI_VERSION ?></p>
                <p><strong>PHP Version:</strong> <?= phpversion() ?></p>
                <p><strong>Server Time:</strong> <?= date('Y-m-d H:i:s') ?></p>
            </div>
        </div>
    </div>
</div>