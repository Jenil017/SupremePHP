<?php
declare(strict_types=1);

session_start();

// Include the database connection and the email function
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/send_order_email.php';

// --- Form Data Processing ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Sanitize and retrieve form data
$firstName = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
$customer_name = trim("{$firstName} {$lastName}");

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);

// Assemble the full address
$street = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
$city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
$state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
$pincode = filter_input(INPUT_POST, 'pincode', FILTER_SANITIZE_STRING);
$country = filter_input(INPUT_POST, 'country', FILTER_SANITIZE_STRING);
$address = "{$street}, {$city}, {$state} - {$pincode}, {$country}";

// Product details from POST request (from hidden fields)
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$product_name = filter_input(INPUT_POST, 'product_name', FILTER_SANITIZE_STRING);
$product_price = filter_input(INPUT_POST, 'product_price', FILTER_SANITIZE_STRING);
$product_image = filter_input(INPUT_POST, 'product_image', FILTER_SANITIZE_URL);
$product_description = filter_input(INPUT_POST, 'product_description', FILTER_SANITIZE_STRING);

// Get quantity and calculate total price on the server for security
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);
if ($quantity === false || $quantity < 1) {
    $quantity = 1; // Default to 1 if invalid
}
$total_price = (float)$product_price * $quantity;

// --- Database Insertion ---
$stmt = $conn->prepare(
    "INSERT INTO orders (product_id, product_name, product_price, product_image, product_description, quantity, total_price, customer_name, address, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

if ($stmt === false) {
    error_log('DB Prepare failed: ' . $conn->error);
    // Redirect with a generic error message
    $_SESSION['order_error_message'] = "We're sorry, but there was a server error. Please try again later.";
    header('Location: order.php?product_id=' . $product_id);
    exit;
}

$stmt->bind_param(
    "issssidssss",
    $product_id,
    $product_name,
    $product_price,
    $product_image,
    $product_description,
    $quantity,
    $total_price,
    $customer_name,
    $address,
    $phone,
    $email
);

$is_db_insert_successful = $stmt->execute();
$new_order_id = $conn->insert_id;

// Check for errors
if (!$is_db_insert_successful) {
    // Log the error and redirect with a message
    error_log('DB Insert failed: ' . $stmt->error);
    $_SESSION['order_error_message'] = "We're sorry, but there was an error placing your order. Please try again.";
    header('Location: order.php?product_id=' . $product_id);
    exit;
}

$stmt->close();
$conn->close();

// --- Email & Response ---
$orderDetails = [
    'order_id' => $new_order_id,
    'customer_name' => $customer_name,
    'email' => $email,
    'product_name' => $product_name,
    'product_price' => $product_price, // Price per item
    'quantity' => $quantity,
    'total_price' => $total_price, // Total for the order
    'address' => $address
];

// Send the confirmation email
$is_email_sent = sendOrderConfirmationEmail($orderDetails);

// Store order details in session to display on success page
$_SESSION['last_order_details'] = $orderDetails;

// --- Redirect based on success ---
if ($is_db_insert_successful) {
    // Clear any previous error messages
    unset($_SESSION['order_error_message']);

    // Redirect to a success page
    $_SESSION['order_success_message'] = "Thank you! Your order #{$new_order_id} has been placed successfully.";
    header('Location: order_success.php');
    exit;
}

include 'assets/includes/header.php';
