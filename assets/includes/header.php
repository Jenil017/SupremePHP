<!-- Global CSS: Make sure this is at the very top of <head> in every page -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/common-improvements.css">
<link rel="stylesheet" href="assets/css/header-improvements.css">
<link rel="stylesheet" href="assets/css/footer-improvements.css">
<link rel="stylesheet" href="assets/css/product-redesign.css">
<!-- Swiper CSS for product carousel -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<header class="header" style="background:#fff;">
    <div class="container header-container" style="display:flex;align-items:center;justify-content:space-between;">
        <a href="index.php" class="logo" style="display:flex;align-items:center;text-decoration:none;">
            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=80&q=80" alt="Supreme Thread Logo" style="border-radius:50%;width:48px;height:48px;object-fit:cover;">
            <div class="logo-text" style="color:#2d6a4f;font-weight:700;font-size:1.4rem;margin-left:10px;">Supreme Thread</div>
        </a>
        <nav class="desktop-nav" style="flex:1;margin-left:40px;">
            <ul class="nav-menu" style="display:flex;gap:28px;align-items:center;list-style:none;margin:0;padding:0;">
                <li class="nav-item"><a href="index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
                <li class="nav-item"><a href="products.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : '' ?>">Products</a></li>
                <li class="nav-item"><a href="manufacturing.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'manufacturing.php' ? 'active' : '' ?>">Manufacturing</a></li>                
                <li class="nav-item"><a href="industries.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'industries.php' ? 'active' : '' ?>">Industries</a></li>
                <li class="nav-item"><a href="gallery.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            </ul>
        </nav>
        <?php
        if (session_status() === PHP_SESSION_NONE) session_start();
        ?>
        <div style="margin-left:20px;display:flex;align-items:center;">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <a href="login.php" class="header-login-btn"
               style="background:linear-gradient(135deg,#2d6a4f,#1A3C40);color:#fff;padding:10px 22px;border-radius:8px;font-weight:600;box-shadow:0 2px 8px rgba(30,58,138,0.10);transition:transform 0.2s;text-decoration:none;">
                <i class="fas fa-sign-in-alt" style="margin-right:5px;"></i>Login
            </a>
        <?php else: ?>
            <div class="header-profile-dropdown" style="position:relative;display:inline-block;">
               <button id="profileBtn" style="background:#2d6a4f;border:none;border-radius:50%;width:44px;height:44px;box-shadow:0 2px 8px rgba(30,58,138,0.10);cursor:pointer;display:flex;align-items:center;justify-content:center; padding: 0;">
                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='white'><path d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-2c0-2.66-5.33-4-8-4z'/></svg>" 
                         alt="Profile" 
                         style="width: 24px; height: 24px;"
                    />
                <div id="profileMenu" style="display:none;position:absolute;right:0;top:54px;background:#fff;border-radius:10px;box-shadow:0 8px 32px rgba(30,58,138,0.12);min-width:160px;z-index:100;">
                    <a href="user_orders.php" style="display:block;padding:12px 20px;color:#1A3C40;text-decoration:none;border-bottom:1px solid #eee;">My Orders</a>
                    <a href="user_feedback.php" style="display:block;padding:12px 20px;color:#1A3C40;text-decoration:none;border-bottom:1px solid #eee;">Feedback</a>
                    <a href="logout.php" style="display:block;padding:12px 20px;color:#d32f2f;text-decoration:none;">Logout</a>
                </div>
            </div>
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                var btn = document.getElementById('profileBtn');
                var menu = document.getElementById('profileMenu');
                btn.onclick = function(e) {
                    e.stopPropagation();
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                };
                document.body.onclick = function() { menu.style.display = 'none'; };
            });
            </script>
        <?php endif; ?>
        </div>
        <!-- Mobile Menu Button (visible only on mobile) -->
        <button class="menu-toggle" aria-label="Toggle mobile menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
<!-- Mobile Side Menu -->
<div class="mobile-menu">
    <div class="mobile-menu-header">
        <a href="index.php" class="mobile-logo">
            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=80&q=80" alt="Supreme Thread Logo" style="border-radius:50%;width:36px;height:36px;object-fit:cover;">
            <span>Supreme Thread</span>
        </a>
        <button class="mobile-menu-close">
            <span>&times;</span>
        </button>
    </div>
    <ul class="mobile-nav-menu">
        <li class="mobile-nav-item"><a href="index.php" class="mobile-nav-link active">Home</a></li>
        <li class="mobile-nav-item"><a href="about.php" class="mobile-nav-link">About</a></li>
        <li class="mobile-nav-item"><a href="products.php" class="mobile-nav-link">Products</a></li>
        <li class="mobile-nav-item"><a href="manufacturing.php" class="mobile-nav-link">Manufacturing</a></li>
        <li class="mobile-nav-item"><a href="industries.php" class="mobile-nav-link">Industries</a></li>
        <li class="mobile-nav-item"><a href="gallery.php" class="mobile-nav-link">Gallery</a></li>
        <li class="mobile-nav-item"><a href="contact.php" class="mobile-nav-link">Contact</a></li>
    </ul>
    <div class="mobile-menu-footer">
        <div class="mobile-social-links">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </div>
</div>
<!-- Mobile Menu Overlay -->
<div class="mobile-menu-overlay"></div>
