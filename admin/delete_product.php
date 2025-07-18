<?php
declare(strict_types=1);

session_start();
require_once '../database.php';

// 1. Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../admin_login.php');
    exit;
}

// 2. Get and validate the product ID from the URL
$product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$product_id) {
    $_SESSION['error_message'] = 'Invalid product ID specified.';
    header('Location: products.php');
    exit;
}

// 3. Fetch the image path before deleting the database record
$stmt = $conn->prepare("SELECT image FROM products WHERE id = ?");
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if ($product) {
    // 4. Delete the product record from the database
    $delete_stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_stmt->bind_param('i', $product_id);

    if ($delete_stmt->execute()) {
        // 5. If database deletion is successful, delete the image file
        $image_path = '../' . $product['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
        $_SESSION['success_message'] = 'Product deleted successfully.';
    } else {
        $_SESSION['error_message'] = 'Error deleting product: ' . $delete_stmt->error;
    }
    $delete_stmt->close();
} else {
    $_SESSION['error_message'] = 'Product not found or already deleted.';
}

$stmt->close();
$conn->close();

// 6. Redirect back to the products list
header('Location: products.php');
exit;
