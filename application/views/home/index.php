
<!-- =======================
APPLICATION/VIEWS/HOME/INDEX.PHP
======================= -->
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Welcome to ShopZone</h1>
        <p class="hero-subtitle">Your Ultimate Shopping Destination with Amazing Deals & Quality Products</p>
        <a href="#products" class="btn btn-danger btn-lg px-4">
            <i class="fas fa-shopping-cart"></i> Start Shopping
        </a>
    </div>
</section>

<!-- Categories Section -->
<section class="container my-5">
    <h2 class="section-title">Shop by Category</h2>
    <div class="category-grid">
        <?php foreach($categories as $category): ?>
            <a href="<?= base_url('category/' . $category->name) ?>" class="category-card">
                <div class="category-icon">
                    <i class="<?= $category->icon ?>"></i>
                </div>
                <h4><?= ucfirst($category->name) ?> Collection</h4>
                <p class="text-muted"><?= $category->product_count ?>+ Products</p>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<!-- Filters Section -->
<section class="container">
    <div class="filters-section">
        <h3 class="text-center mb-4">Filter Products</h3>
        <form method="get" class="row g-3">
            <div class="col-md-3">
                <label class="form-label">Price Range:</label>
                <select class="form-select filter-select" name="price">
                    <option value="">All Prices</option>
                    <option value="0-500" <?= $this->input->get('price') == '0-500' ? 'selected' : '' ?>>₹0 - ₹500</option>
                    <option value="500-1000" <?= $this->input->get('price') == '500-1000' ? 'selected' : '' ?>>₹500 - ₹1,000</option>
                    <option value="1000-2000" <?= $this->input->get('price') == '1000-2000' ? 'selected' : '' ?>>₹1,000 - ₹2,000</option>
                    <option value="2000-5000" <?= $this->input->get('price') == '2000-5000' ? 'selected' : '' ?>>₹2,000 - ₹5,000</option>
                    <option value="5000+" <?= $this->input->get('price') == '5000+' ? 'selected' : '' ?>>₹5,000+</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Rating:</label>
                <select class="form-select filter-select" name="rating">
                    <option value="">All Ratings</option>
                    <option value="4+" <?= $this->input->get('rating') == '4+' ? 'selected' : '' ?>>4+ Stars</option>
                    <option value="3+" <?= $this->input->get('rating') == '3+' ? 'selected' : '' ?>>3+ Stars</option>
                    <option value="2+" <?= $this->input->get('rating') == '2+' ? 'selected' : '' ?>>2+ Stars</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">Discount:</label>
                <select class="form-select filter-select" name="discount">
                    <option value="">All Discounts</option>
                    <option value="50+" <?= $this->input->get('discount') == '50+' ? 'selected' : '' ?>>50% or more</option>
                    <option value="30+" <?= $this->input->get('discount') == '30+' ? 'selected' : '' ?>>30% or more</option>
                    <option value="20+" <?= $this->input->get('discount') == '20+' ? 'selected' : '' ?>>20% or more</option>
                    <option value="10+" <?= $this->input->get('discount') == '10+' ? 'selected' : '' ?>>10% or more</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label">&nbsp;</label>
                <button type="submit" class="btn btn-primary d-block w-100">Apply Filters</button>
            </div>
        </form>
    </div>
</section>

<!-- Featured Products Section -->
<?php if(!empty($featured_products)): ?>
<section class="container my-5">
    <h2 class="section-title">Featured Products</h2>
    <div class="row" id="featured-products">
        <?php foreach($featured_products as $product): ?>
            <?php $this->load->view('home/product_card', array('product' => $product)); ?>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- All Products Section -->
<section class="container my-5" id="products">
    <h2 class="section-title">All Products</h2>
    <div class="row" id="products-container">
        <?php foreach($products as $product): ?>
            <?php $this->load->view('home/product_card', array('product' => $product)); ?>
        <?php endforeach; ?>
    </div>
    
    <?php if($total_products > count($products)): ?>
    <div class="text-center mt-4">
        <button class="btn btn-outline-primary btn-lg" onclick="loadMoreProducts(2)">
            <i class="fas fa-plus"></i> Load More Products
        </button>
    </div>
    <?php endif; ?>
</section>
