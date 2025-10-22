<?php
// =======================
// APPLICATION/VIEWS/HOME/SEARCH_RESULTS.PHP
// =======================
?>
<div class="container my-4">
    <h2 class="section-title">
        Search Results<?php if(isset($search_term)): ?> for "<?= htmlspecialchars($search_term) ?>"<?php endif; ?>
    </h2>

    <!-- Filters -->
    <div class="filters-section mb-4">
        <form method="get" class="row g-3">
            <input type="hidden" name="q" value="<?= htmlspecialchars($search_term) ?>">
            <div class="col-md-3">
                <select class="form-select" name="price">
                    <option value="">All Prices</option>
                    <option value="0-500" <?= $this->input->get('price') == '0-500' ? 'selected' : '' ?>>₹0 - ₹500</option>
                    <option value="500-1000" <?= $this->input->get('price') == '500-1000' ? 'selected' : '' ?>>₹500 - ₹1,000</option>
                    <option value="1000-2000" <?= $this->input->get('price') == '1000-2000' ? 'selected' : '' ?>>₹1,000 - ₹2,000</option>
                    <option value="2000+" <?= $this->input->get('price') == '2000+' ? 'selected' : '' ?>>₹2,000+</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="rating">
                    <option value="">All Ratings</option>
                    <option value="4+" <?= $this->input->get('rating') == '4+' ? 'selected' : '' ?>>4+ Stars</option>
                    <option value="3+" <?= $this->input->get('rating') == '3+' ? 'selected' : '' ?>>3+ Stars</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" name="discount">
                    <option value="">All Discounts</option>
                    <option value="30+" <?= $this->input->get('discount') == '30+' ? 'selected' : '' ?>>30% or more</option>
                    <option value="50+" <?= $this->input->get('discount') == '50+' ? 'selected' : '' ?>>50% or more</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
            </div>
        </form>
    </div>

    <!-- Search Results -->
    <div class="row">
        <?php if(!empty($products)): ?>
            <?php foreach($products as $product): ?>
                <?php $this->load->view('home/product_card', array('product' => $product)); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5">
                <i class="fas fa-search fa-3x text-muted mb-3"></i>
                <h4>No products found</h4>
                <p class="text-muted">
                    <?php if(isset($search_term)): ?>
                        No products match your search for "<?= htmlspecialchars($search_term) ?>".
                    <?php else: ?>
                        Please try a different search term.
                    <?php endif; ?>
                </p>
                <a href="<?= base_url() ?>" class="btn btn-primary">Browse All Products</a>
            </div>
        <?php endif; ?>
    </div>
</div>