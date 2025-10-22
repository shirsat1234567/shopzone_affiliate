
<!-- =======================
APPLICATION/VIEWS/HOME/PRODUCT_CARD.PHP
======================= -->
<div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="product-card">
        <div class="product-image">
            <img src="<?= $product->image_url ?: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=400&h=300&fit=crop' ?>" 
                 alt="<?= htmlspecialchars($product->name) ?>">
            <?php if($product->discount_percentage > 0): ?>
                <div class="discount-badge"><?= $product->discount_percentage ?>% OFF</div>
            <?php endif; ?>
        </div>
        <div class="product-info">
            <h5 class="product-name">
                <a href="<?= base_url('product/' . $product->id) ?>" class="text-decoration-none text-dark">
                    <?= htmlspecialchars($product->name) ?>
                </a>
            </h5>
            <p class="text-muted small"><?= character_limiter($product->description, 100) ?></p>
            <div class="price-section">
                <span class="current-price">₹<?= number_format($product->discounted_price) ?></span>
                <?php if($product->original_price > $product->discounted_price): ?>
                    <span class="original-price">₹<?= number_format($product->original_price) ?></span>
                <?php endif; ?>
            </div>
            <?php if($product->rating > 0): ?>
            <div class="mb-2">
                <small class="text-warning">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?php if($i <= floor($product->rating)): ?>
                            <i class="fas fa-star"></i>
                        <?php elseif($i - 0.5 <= $product->rating): ?>
                            <i class="fas fa-star-half-alt"></i>
                        <?php else: ?>
                            <i class="far fa-star"></i>
                        <?php endif; ?>
                    <?php endfor; ?>
                </small>
                <small class="text-muted">(<?= $product->reviews_count ?>)</small>
            </div>
            <?php endif; ?>
            <a href="<?= $product->affiliate_url ?>" target="_blank" class="buy-button">
                <i class="fas fa-shopping-cart"></i> Buy Now
            </a>
        </div>
    </div>
</div>