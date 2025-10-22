
<?php
// =======================
// APPLICATION/VIEWS/HOME/PRODUCT_DETAILS.PHP
// =======================
?>
<div class="container my-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('category/' . $product->category) ?>"><?= ucfirst($product->category_name) ?></a></li>
            <li class="breadcrumb-item active"><?= character_limiter($product->name, 30) ?></li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <img src="<?= $product->image_url ?: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=600&h=400&fit=crop' ?>" 
                     alt="<?= htmlspecialchars($product->name) ?>" class="card-img-top">
            </div>
        </div>
        
        <div class="col-md-6">
            <h1><?= htmlspecialchars($product->name) ?></h1>
            
            <div class="my-3">
                <span class="badge bg-primary"><?= ucfirst($product->category_name) ?></span>
                <span class="badge bg-secondary"><?= ucfirst($product->subcategory_name) ?></span>
                <?php if($product->featured): ?>
                    <span class="badge bg-warning text-dark">Featured</span>
                <?php endif; ?>
            </div>

            <p class="lead text-muted"><?= nl2br(htmlspecialchars($product->description)) ?></p>

            <div class="price-section mb-4">
                <h2 class="current-price">₹<?= number_format($product->discounted_price) ?></h2>
                <?php if($product->original_price > $product->discounted_price): ?>
                    <span class="original-price h4">₹<?= number_format($product->original_price) ?></span>
                    <span class="badge bg-danger ms-2"><?= $product->discount_percentage ?>% OFF</span>
                    <div class="mt-2">
                        <small class="text-success">You save: ₹<?= number_format($product->original_price - $product->discounted_price) ?></small>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($product->rating > 0): ?>
                <div class="rating mb-4">
                    <div class="d-flex align-items-center">
                        <div class="text-warning me-2">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <?php if($i <= floor($product->rating)): ?>
                                    <i class="fas fa-star"></i>
                                <?php elseif($i - 0.5 <= $product->rating): ?>
                                    <i class="fas fa-star-half-alt"></i>
                                <?php else: ?>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                        <span class="h5 mb-0 me-2"><?= $product->rating ?></span>
                        <span class="text-muted">(<?= $product->reviews_count ?> reviews)</span>
                    </div>
                </div>
            <?php endif; ?>

            <div class="d-grid gap-2">
                <a href="<?= $product->affiliate_url ?>" target="_blank" class="btn btn-danger btn-lg">
                    <i class="fas fa-shopping-cart"></i> Buy Now on Amazon
                </a>
                <small class="text-muted text-center">
                    <i class="fas fa-external-link-alt"></i> You will be redirected to Amazon
                </small>
            </div>

            <div class="mt-4">
                <h6>Product Information:</h6>
                <ul class="list-unstyled">
                    <li><strong>Category:</strong> <?= ucfirst($product->category_name) ?></li>
                    <li><strong>Subcategory:</strong> <?= ucfirst($product->subcategory_name) ?></li>
                    <?php if($product->rating > 0): ?>
                        <li><strong>Customer Rating:</strong> <?= $product->rating ?>/5 (<?= $product->reviews_count ?> reviews)</li>
                    <?php endif; ?>
                    <li><strong>Discount:</strong> <?= $product->discount_percentage ?>% OFF</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    <?php if(!empty($related_products)): ?>
        <div class="mt-5">
            <h3>Related Products</h3>
            <div class="row">
                <?php foreach($related_products as $related_product): ?>
                    <?php if($related_product->id != $product->id): ?>
                        <?php $this->load->view('home/product_card', array('product' => $related_product)); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
