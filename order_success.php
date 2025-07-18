<?php
declare(strict_types=1);

session_start();

// Check if a success message is set
if (!isset($_SESSION['order_success_message'])) {
    // If not, redirect to the homepage
    header('Location: index.php');
    exit;
}

// Retrieve the success message and order details from the session
$success_message = $_SESSION['order_success_message'] ?? 'Your order has been placed successfully!';
$orderDetails = $_SESSION['last_order_details'] ?? null;

// Unset the session variables so they don't persist
unset($_SESSION['order_success_message']);
unset($_SESSION['last_order_details']);

// Include the header
include 'assets/includes/header.php';
?>

<!-- Success Page Styles -->
<style>
    :root {
        --primary: #1A3C40;
        --secondary: #4CAF50; /* Green for success */
        --text-primary: #333;
        --background: #f8f9fa;
        --common-radius: 1.2rem;
    }

    .success-section {
        padding: 6rem 0 4rem;
        background: linear-gradient(135deg, #ffffff 0%, #f0fdf4 100%);
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .success-container {
        max-width: 700px;
        margin: 0 auto;
        padding: 3rem;
        background: #fff;
        border-radius: var(--common-radius);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .success-icon {
        font-size: 5rem;
        color: var(--secondary);
        margin-bottom: 1.5rem;
        animation: pop-in 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    .success-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    .success-message {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 2rem;
    }

    .order-summary-box {
        margin-top: 2rem;
        padding: 1.5rem;
        background-color: #f9f9f9;
        border: 1px solid #eee;
        border-radius: 1rem;
        text-align: left;
    }

    .order-summary-box h3 {
        font-size: 1.5rem;
        color: var(--primary);
        margin-bottom: 1rem;
        text-align: center;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e5e5e5;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-label {
        font-weight: 600;
        color: #333;
    }

    .summary-value {
        color: #555;
    }

    .summary-value.total {
        font-weight: 700;
        color: var(--primary);
    }

    .continue-shopping-btn {
        display: inline-block;
        margin-top: 2.5rem;
        padding: 1rem 2.5rem;
        background-color: var(--primary);
        color: #fff;
        text-decoration: none;
        border-radius: 50px;
        font-weight: 600;
        transition: background-color 0.3s, transform 0.2s;
    }

    .continue-shopping-btn:hover {
        background-color: #153236;
        transform: translateY(-2px);
    }

    @keyframes pop-in {
        0% {
            transform: scale(0.5);
            opacity: 0;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<section class="success-section">
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h1 class="success-title">Order Placed!</h1>
        <p class="success-message"><?= htmlspecialchars($success_message) ?></p>

        <?php if ($orderDetails): ?>
        <div class="order-summary-box">
            <h3>Your Order Summary</h3>
            <div class="summary-item">
                <span class="summary-label">Order ID:</span>
                <span class="summary-value">#<?= htmlspecialchars((string)$orderDetails['order_id']) ?></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Product:</span>
                <span class="summary-value"><?= htmlspecialchars($orderDetails['product_name']) ?></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Quantity:</span>
                <span class="summary-value"><?= htmlspecialchars((string)$orderDetails['quantity']) ?></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Total Price:</span>
                <span class="summary-value total">₹<?= htmlspecialchars(number_format((float)$orderDetails['total_price'], 2)) ?></span>
            </div>
            <div class="summary-item">
                <span class="summary-label">Shipping To:</span>
                <span class="summary-value"><?= htmlspecialchars($orderDetails['address']) ?></span>
            </div>
        </div>
        <?php endif; ?>

        <a href="index.php" class="continue-shopping-btn">
            <i class="fas fa-shopping-bag"></i> Continue Shopping
        </a>
    </div>
</section>

<?php
// Include the footer
include 'assets/includes/footer.php';
?>
