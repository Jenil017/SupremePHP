<aside class="sidebar">
    <div class="sidebar-header">
        <h2>SupremePHP</h2>
    </div>
    <nav>
        <ul class="sidebar-nav">
            <li>
                <a href="index.php" class="<?= is_active('index.php') ?>">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="products.php" class="<?= is_active('products.php') ?>">
                    <i class="fas fa-box-open"></i> Products
                </a>
            </li>
            <li>
                <a href="orders.php" class="<?= is_active('orders.php') ?>">
                    <i class="fas fa-shopping-cart"></i> Orders
                </a>
            </li>
            <li>
                <a href="users.php" class="<?= is_active('users.php') ?>">
                    <i class="fas fa-users"></i> Registered Users
                </a>
            </li>
            <li>
                <a href="feedback.php" class="<?= is_active('feedback.php') ?>">
                    <i class="fas fa-comment-dots"></i> Feedback
                </a>
            </li>
        </ul>
    </nav>
    <div class="sidebar-footer">
        <a href="../index.php" target="_blank">View Live Site</a>
    </div>
</aside>
