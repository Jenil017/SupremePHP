<?php
// Order Processing Page - process_order.php

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: products_new.php');
    exit;
}

// Get form data
$firstName = htmlspecialchars($_POST['firstName'] ?? '');
$lastName = htmlspecialchars($_POST['lastName'] ?? '');
$email = htmlspecialchars($_POST['email'] ?? '');
$phone = htmlspecialchars($_POST['phone'] ?? '');
$address = htmlspecialchars($_POST['address'] ?? '');
$city = htmlspecialchars($_POST['city'] ?? '');
$state = htmlspecialchars($_POST['state'] ?? '');
$pincode = htmlspecialchars($_POST['pincode'] ?? '');
$country = htmlspecialchars($_POST['country'] ?? '');
$notes = htmlspecialchars($_POST['notes'] ?? '');

// Product data
$productName = htmlspecialchars($_POST['productName'] ?? '');
$productPrice = htmlspecialchars($_POST['productPrice'] ?? '');
$productImage = htmlspecialchars($_POST['productImage'] ?? '');
$productDescription = htmlspecialchars($_POST['productDescription'] ?? '');
$orderQuantity = htmlspecialchars($_POST['orderQuantity'] ?? '');
$totalAmount = htmlspecialchars($_POST['totalAmount'] ?? '');

// Generate order ID
$orderId = 'ST' . date('Ymd') . rand(1000, 9999);

// Current timestamp
$orderDate = date('Y-m-d H:i:s');

// Create order data array
$orderData = [
    'order_id' => $orderId,
    'order_date' => $orderDate,
    'customer' => [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'state' => $state,
        'pincode' => $pincode,
        'country' => $country,
        'notes' => $notes
    ],
    'product' => [
        'name' => $productName,
        'price' => $productPrice,
        'image' => $productImage,
        'description' => $productDescription,
        'quantity' => $orderQuantity
    ],
    'total_amount' => $totalAmount,
    'payment_method' => 'Cash on Delivery (COD)',
    'order_status' => 'Pending'
];

// Save order to file (in production, you'd save to database)
$ordersFile = 'orders.json';
$existingOrders = [];

if (file_exists($ordersFile)) {
    $existingOrders = json_decode(file_get_contents($ordersFile), true) ?? [];
}

$existingOrders[] = $orderData;
file_put_contents($ordersFile, json_encode($existingOrders, JSON_PRETTY_PRINT));

// Send email notification (optional - requires mail server configuration)
// mail($email, 'Order Confirmation - ' . $orderId, 'Your order has been received...');

include 'assets/includes/header.php';
?>

<!-- Order Confirmation Styles -->
<style>
.confirmation-section {
    padding: 6rem 0 4rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    min-height: 100vh;
}

.confirmation-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.success-icon {
    text-align: center;
    margin-bottom: 2rem;
}

.success-icon i {
    font-size: 4rem;
    color: #28a745;
    background: #d4edda;
    padding: 2rem;
    border-radius: 50%;
    border: 4px solid #c3e6cb;
}

.confirmation-card {
    background: white;
    border-radius: 1.2rem;
    padding: 3rem;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    text-align: center;
    margin-bottom: 2rem;
}

.confirmation-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1A3C40;
    margin-bottom: 1rem;
}

.confirmation-message {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.order-details {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    text-align: left;
}

.order-details h3 {
    color: #1A3C40;
    margin-bottom: 1rem;
    text-align: center;
}

.detail-row {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem 0;
    border-bottom: 1px solid #dee2e6;
}

.detail-row:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 600;
    color: #1A3C40;
}

.detail-value {
    color: #666;
}

.order-id {
    font-size: 1.5rem;
    font-weight: 700;
    color: #28a745;
    background: #d4edda;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.next-steps {
    background: #e3f2fd;
    padding: 2rem;
    border-radius: 12px;
    margin-bottom: 2rem;
}

.next-steps h3 {
    color: #1A3C40;
    margin-bottom: 1rem;
}

.next-steps ul {
    list-style: none;
    padding: 0;
}

.next-steps li {
    padding: 0.5rem 0;
    position: relative;
    padding-left: 2rem;
}

.next-steps li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #28a745;
    font-weight: bold;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    margin-top: 2rem;
}

.btn {
    padding: 0.8rem 2rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: linear-gradient(135deg, #1A3C40 0%, #2d6a4f 100%);
    color: white;
}

.btn-primary:hover {
    background: linear-gradient(135deg, #2d6a4f 0%, #1A3C40 100%);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(26, 60, 64, 0.3);
}

.btn-secondary {
    background: white;
    color: #1A3C40;
    border: 2px solid #1A3C40;
}

.btn-secondary:hover {
    background: #1A3C40;
    color: white;
    transform: translateY(-2px);
}

@media (max-width: 768px) {
    .confirmation-section {
        padding: 4rem 0 2rem;
    }
    
    .confirmation-card {
        padding: 2rem;
    }
    
    .confirmation-title {
        font-size: 2rem;
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<!-- Order Confirmation Content -->
<section class="confirmation-section">
    <div class="confirmation-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <div class="confirmation-card">
            <h1 class="confirmation-title">Order Confirmed!</h1>
            <p class="confirmation-message">
                Thank you for your order! We've received your order and will process it shortly. 
                You will receive your package with Cash on Delivery payment option.
            </p>
            
            <div class="order-id">
                Order ID: <?php echo $orderId; ?>
            </div>
            
            <div class="order-details">
                <h3>Order Details</h3>
                <div class="detail-row">
                    <span class="detail-label">Product:</span>
                    <span class="detail-value"><?php echo $productName; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Quantity:</span>
                    <span class="detail-value"><?php echo $orderQuantity; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value"><?php echo $totalAmount; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Payment Method:</span>
                    <span class="detail-value">Cash on Delivery (COD)</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Order Date:</span>
                    <span class="detail-value"><?php echo date('d M Y, H:i', strtotime($orderDate)); ?></span>
                </div>
            </div>
            
            <div class="order-details">
                <h3>Shipping Address</h3>
                <div class="detail-row">
                    <span class="detail-label">Name:</span>
                    <span class="detail-value"><?php echo $firstName . ' ' . $lastName; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value"><?php echo $email; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value"><?php echo $phone; ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Address:</span>
                    <span class="detail-value"><?php echo $address . ', ' . $city . ', ' . $state . ' - ' . $pincode; ?></span>
                </div>
                <?php if (!empty($notes)): ?>
                <div class="detail-row">
                    <span class="detail-label">Notes:</span>
                    <span class="detail-value"><?php echo $notes; ?></span>
                </div>
                <?php endif; ?>
            </div>
            
            <div class="next-steps">
                <h3>What happens next?</h3>
                <ul>
                    <li>We'll process your order within 24 hours</li>
                    <li>Your order will be packed and dispatched</li>
                    <li>You'll receive a tracking number via SMS/Email</li>
                    <li>Pay cash when you receive your package</li>
                    <li>Estimated delivery: 3-5 business days</li>
                </ul>
            </div>
            
            <div class="action-buttons">
                <a href="products_new.php" class="btn btn-primary">
                    <i class="fas fa-shopping-cart"></i> Continue Shopping
                </a>
                <a href="contact.php" class="btn btn-secondary">
                    <i class="fas fa-phone"></i> Contact Support
                </a>
            </div>
        </div>
    </div>
</section>

<script>
// Clear the selected product from localStorage since order is complete
localStorage.removeItem('selectedProduct');

// Optional: Print order confirmation
function printOrder() {
    window.print();
}
</script>

<?php include 'assets/includes/footer.php'; ?>