<!-- =======================
APPLICATION/VIEWS/TEMPLATES/FOOTER.PHP
======================= -->
    
    <!-- Footer -->
    <footer class="bg-dark text-white py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5><i class="fas fa-shopping-bag"></i> ShopZone</h5>
                    <p>Your ultimate shopping destination with the best deals and quality products. Shop with confidence and enjoy amazing discounts.</p>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <?php if(isset($categories)): ?>
                            <?php foreach(array_slice($categories, 0, 4) as $category): ?>
                                <li><a href="<?= base_url('category/' . $category->name) ?>" class="text-light text-decoration-none"><?= ucfirst($category->name) ?> Collection</a></li>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
                        <li><a href="#" class="text-light text-decoration-none">FAQ</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Shipping Info</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Returns</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4">
                    <h5>Follow Us</h5>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-light"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-light"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; <?= date('Y') ?> ShopZone. All rights reserved. Built with CodeIgniter.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simple AJAX for loading more products
        function loadMoreProducts(page) {
            fetch('<?= base_url("home/ajax_load_products") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'page=' + page
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('products-container').innerHTML += data.html;
            });
        }
    </script>
<!-- </body>
</html> -->


