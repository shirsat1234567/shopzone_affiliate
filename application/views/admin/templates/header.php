
           <!-- =======================
APPLICATION/VIEWS/ADMIN/TEMPLATES/HEADER.PHP
======================= -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'ShopZone Admin' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: white;
            margin: 5px 0;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: white;
        }
        .content-wrapper {
            min-height: 100vh;
        }
        .card {
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border: none;
            border-radius: 12px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
      <!-- Enhanced Admin Sidebar with Category Management -->
<div class="col-md-2 sidebar p-0">
    <div class="p-3">
        <h4 class="text-white mb-4">
            <i class="fas fa-shopping-bag"></i> ShopZone
        </h4>
       <nav class="nav flex-column">
    <!-- Main Navigation -->
    <div class="nav-section-title text-white-50 small mb-2 text-uppercase fw-bold">Main</div>
    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>">
        <i class="fas fa-tachometer-alt"></i> Dashboard
    </a>
    
    <!-- Products Management -->
    <div class="nav-section-title text-white-50 small mb-2 mt-3 text-uppercase fw-bold">Products</div>
    <a href="<?= base_url('admin/products') ?>" class="nav-link <?= $this->uri->segment(2) == 'products' && !$this->uri->segment(3) ? 'active' : '' ?>">
        <i class="fas fa-box"></i> All Products
        <span class="badge bg-light text-dark ms-auto"><?= isset($total_products) ? $total_products : '0' ?></span>
    </a>
    <a href="<?= base_url('admin/products/add') ?>" class="nav-link <?= $this->uri->segment(3) == 'add' ? 'active' : '' ?>">
        <i class="fas fa-plus"></i> Add Product
    </a>
    <a href="<?= base_url('admin/products?featured=1') ?>" class="nav-link">
        <i class="fas fa-star"></i> Featured Products
    </a>
    
    <!-- Categories Management -->
    <div class="nav-section-title text-white-50 small mb-2 mt-3 text-uppercase fw-bold">Categories</div>
    <a href="<?= base_url('admin/categories') ?>" class="nav-link <?= $this->uri->segment(2) == 'categories' ? 'active' : '' ?>">
        <i class="fas fa-tags"></i> Categories
    </a>
    <a href="<?= base_url('admin/categories/add') ?>" class="nav-link">
        <i class="fas fa-plus-circle"></i> Add Category
    </a>
    <a href="<?= base_url('admin/subcategories') ?>" class="nav-link <?= $this->uri->segment(2) == 'subcategories' ? 'active' : '' ?>">
        <i class="fas fa-sitemap"></i> Subcategories
    </a>
    <a href="<?= base_url('admin/subcategories/add') ?>" class="nav-link">
        <i class="fas fa-plus-square"></i> Add Subcategory
    </a>
    
    <!-- Quick Actions -->
    <div class="nav-section-title text-white-50 small mb-2 mt-3 text-uppercase fw-bold">Quick Actions</div>
    <a href="<?= base_url('admin/products?status=inactive') ?>" class="nav-link">
        <i class="fas fa-eye-slash"></i> Inactive Products
    </a>
    <a href="<?= base_url('admin/products/export') ?>" class="nav-link">
        <i class="fas fa-download"></i> Export Data
    </a>
    <a href="javascript:void(0)" onclick="bulkActivateProducts()" class="nav-link text-success">
        <i class="fas fa-check-circle"></i> Bulk Activate
    </a>
    
    <!-- System -->
    <div class="nav-section-title text-white-50 small mb-2 mt-3 text-uppercase fw-bold">System</div>
    <a href="<?= base_url() ?>" target="_blank" class="nav-link">
        <i class="fas fa-external-link-alt"></i> View Website
    </a>
    <a href="<?= base_url('admin/auth/logout') ?>" class="nav-link text-danger">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>
</nav>
    </div>
</div>
      <script>
// Quick bulk activate function
function bulkActivateProducts() {
    if (confirm('This will activate all inactive products. Continue?')) {
        // Add your bulk activate logic here
        alert('Bulk activate feature - integrate with your backend');
    }
}
</script>      
            <!-- Main Content -->
            <div class="col-md-10 content-wrapper">
                <div class="p-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2><?= isset($title) ? str_replace(' - ShopZone Admin', '', $title) : 'Admin Panel' ?></h2>
                        <div>
                            <span class="text-muted">Welcome, <?= $this->session->userdata('admin_username') ?></span>
                        </div>
                    </div>
                    
                    <!-- Flash Messages -->
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>