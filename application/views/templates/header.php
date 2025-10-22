<!-- =======================
APPLICATION/VIEWS/TEMPLATES/HEADER.PHP
======================= -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'ShopZone - Your Ultimate Shopping Destination' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">



</head>
<body>
    <!-- Navigation Bar -->
   <nav class="navbar">
    <div class="nav-container">
        <!-- Logo - Keep same -->
        <a href="<?= base_url() ?>" class="logo">
            <i class="fas fa-shopping-bag"></i>
            ShopZone
        </a>
        
        <!-- Search - Enhanced -->
        <div class="search-container">
            <form action="<?= base_url('search') ?>" method="get" class="search-form">
                <input type="text" class="search-input" name="q" 
                       placeholder="Search products..." 
                       value="<?= isset($search_term) ? $search_term : '' ?>">
                <button type="submit" class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
        
        <!-- Desktop Menu - Keep existing functionality -->
        <ul class="nav-menu">
            <?php if(isset($categories)): ?>
                <?php foreach($categories as $category): ?>
                    <li class="nav-item">
                        <a href="<?= base_url('category/' . $category->name) ?>" class="nav-link">
                            <i class="<?= $category->icon ?>"></i> 
                            <?= ucfirst($category->name) ?>
                        </a>
                        <div class="dropdown">
                            <?php 
                            $subcategories = $this->Product_model->get_subcategories($category->name);
                            if($subcategories):
                                foreach($subcategories as $sub): 
                            ?>
                                <a href="<?= base_url('subcategory/' . $category->name . '/' . $sub->name) ?>" 
                                   class="dropdown-item">
                                    <?= ucfirst($sub->name) ?>
                                </a>
                            <?php 
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
        
        <!-- NEW: Mobile Menu Button -->
        <button class="mobile-menu-btn" id="mobileMenuBtn" title="Menu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</nav>

<script>
// Mobile Menu Functionality - Works with existing website
(function() {
    'use strict';
    
    // Mobile Menu Elements
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    
    // Check if elements exist (fallback for existing sites)
    if (!mobileMenuBtn || !mobileMenu) {
        console.log('Mobile menu elements not found - skipping mobile menu initialization');
        return;
    }
    
    // Open Mobile Menu
    function openMobileMenu() {
        mobileMenu.classList.add('active');
        mobileMenuOverlay.classList.add('active');
        mobileMenuBtn.classList.add('active');
        document.body.style.overflow = 'hidden';
        
        // Focus management for accessibility
        mobileMenuClose.focus();
    }
    
    // Close Mobile Menu
    function closeMobileMenu() {
        mobileMenu.classList.remove('active');
        mobileMenuOverlay.classList.remove('active');
        mobileMenuBtn.classList.remove('active');
        document.body.style.overflow = '';
        
        // Return focus to menu button
        mobileMenuBtn.focus();
    }
    
    // Toggle Mobile Category
    window.toggleMobileCategory = function(button) {
        const category = button.parentElement;
        const isActive = category.classList.contains('active');
        
        // Close all categories first
        document.querySelectorAll('.mobile-category').forEach(cat => {
            cat.classList.remove('active');
            cat.querySelector('.mobile-category-header').classList.remove('active');
        });
        
        // Open clicked category if it wasn't active
        if (!isActive) {
            category.classList.add('active');
            button.classList.add('active');
        }
    };
    
    // Global close function for onclick events
    window.closeMobileMenu = closeMobileMenu;
    
    // Event Listeners
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            openMobileMenu();
        });
    }
    
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMobileMenu();
        });
    }
    
    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            closeMobileMenu();
        });
    }
    
    // Keyboard Support
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768 && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }
    });
    
    // Prevent menu close when clicking inside menu
    if (mobileMenu) {
        mobileMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }
    
    // Initialize
    console.log('Mobile Navigation Ready!');
    
})();

// Keep existing JavaScript functions intact
// Your existing loadMoreProducts, search functions etc. will continue to work
</script>

</body>
</html>











    
