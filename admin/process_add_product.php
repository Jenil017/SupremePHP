<?php
declare(strict_types=1);

session_start();
require_once '../database.php';

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../admin_login.php');
    exit;
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: add_product.php');
    exit;
}

// --- Form Data and Validation ---
$name = trim($_POST['name'] ?? '');
$price = trim($_POST['price'] ?? '');
$description = trim($_POST['description'] ?? '');

if (empty($name) || empty($price) || empty($description) || empty($_FILES['image']['name'])) {
    $_SESSION['error_message'] = 'All fields are required.';
    header('Location: add_product.php');
    exit;
}

// --- Image Upload Handling ---
$target_dir = "../assets/images/products/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$image_name = basename($_FILES["image"]["name"]);
$target_file = $target_dir . $image_name;
$image_db_path = 'assets/images/products/' . $image_name;
$image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if image file is an actual image
$check = getimagesize($_FILES["image"]["tmp_name"]);
if ($check === false) {
    $_SESSION['error_message'] = 'File is not an image.';
    header('Location: add_product.php');
    exit;
}

// Check file size (e.g., 5MB limit)
if ($_FILES["image"]["size"] > 5000000) {
    $_SESSION['error_message'] = 'Sorry, your file is too large.';
    header('Location: add_product.php');
    exit;
}

// Allow certain file formats
if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif" ) {
    $_SESSION['error_message'] = 'Sorry, only JPG, JPEG, PNG & GIF files are allowed.';
    header('Location: add_product.php');
    exit;
}

// Move the uploaded file
if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $_SESSION['error_message'] = 'Sorry, there was an error uploading your file.';
    header('Location: add_product.php');
    exit;
}

// --- Database Insertion ---
// Prepend currency symbol if not present
$formatted_price = '₹' . preg_replace('/[^0-9.]/', '', $price);

$sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    // Handle prepare error
    $_SESSION['error_message'] = 'Database error: Could not prepare statement.';
    header('Location: add_product.php');
    exit;
}

$stmt->bind_param('ssss', $name, $description, $formatted_price, $image_db_path);

if ($stmt->execute()) {
    $_SESSION['success_message'] = 'Product added successfully!';
} else {
    $_SESSION['error_message'] = 'Error adding product: ' . $stmt->error;
}

$stmt->close();
$conn->close();

header('Location: products.php');
exit;
