<?php
declare(strict_types=1);

session_start();
require_once '../database.php';

if (!isset($_SESSION['admin_id'])) {
    header('Location: ../admin_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: products.php');
    exit;
}

// --- Form Data and Validation ---
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT);
$name = trim($_POST['name'] ?? '');
$price = trim($_POST['price'] ?? '');
$description = trim($_POST['description'] ?? '');
$current_image = trim($_POST['current_image'] ?? '');

if (!$product_id || empty($name) || empty($price) || empty($description)) {
    $_SESSION['error_message'] = 'Invalid data submitted.';
    header('Location: products.php');
    exit;
}

$image_db_path = $current_image;

// --- New Image Upload Handling (if a new image is provided) ---
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $target_dir = "../assets/images/products/";
    $image_name = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    $image_db_path = 'assets/images/products/' . $image_name;
    $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Basic validation for the new image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        $_SESSION['error_message'] = 'New file is not an image.';
        header("Location: edit_product.php?id=$product_id");
        exit;
    }

    if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" ) {
        $_SESSION['error_message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed for the new image.';
        header("Location: edit_product.php?id=$product_id");
        exit;
    }

    // Attempt to move the new file
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        // Optionally, delete the old image if it's different from the new one
        if ($current_image && file_exists('../' . $current_image) && $current_image !== $image_db_path) {
            unlink('../' . $current_image);
        }
    } else {
        $_SESSION['error_message'] = 'Sorry, there was an error uploading the new image.';
        header("Location: edit_product.php?id=$product_id");
        exit;
    }
}

// --- Database Update ---
$formatted_price = '₹' . preg_replace('/[^0-9.]/', '', $price);

$sql = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    $_SESSION['error_message'] = 'Database error: Could not prepare statement.';
    header('Location: products.php');
    exit;
}

$stmt->bind_param('ssssi', $name, $description, $formatted_price, $image_db_path, $product_id);

if ($stmt->execute()) {
    $_SESSION['success_message'] = 'Product updated successfully!';
} else {
    $_SESSION['error_message'] = 'Error updating product: ' . $stmt->error;
}

$stmt->close();
$conn->close();

header('Location: products.php');
exit;
