<?php
$page_title = 'Edit Product';
include 'header.php';
require_once '../database.php';

// 1. Get Product ID and Fetch Data
$product_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$product_id) {
    $_SESSION['error_message'] = 'Invalid product ID.';
    header('Location: products.php');
    exit;
}

$stmt = $conn->prepare("SELECT name, description, price, image FROM products WHERE id = ?");
$stmt->bind_param('i', $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    $_SESSION['error_message'] = 'Product not found.';
    header('Location: products.php');
    exit;
}

// Clean price for display in the form field
$price_clean = preg_replace('/[^0-9.]/', '', $product['price']);

?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">Edit Product: <?= htmlspecialchars($product['name']) ?></h2>

<form action="process_edit_product.php" method="POST" enctype="multipart/form-data" class="product-form">
    <input type="hidden" name="product_id" value="<?= $product_id ?>">
    <input type="hidden" name="current_image" value="<?= htmlspecialchars($product['image']) ?>">

    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" id="price" name="price" value="<?= htmlspecialchars($price_clean) ?>" required pattern="[0-9.]+">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="6" required><?= htmlspecialchars($product['description']) ?></textarea>
    </div>
    <div class="form-group">
        <label for="image">Product Image (optional)</label>
        <p>Current Image:</p>
        <img src="../<?= htmlspecialchars($product['image']) ?>" alt="Current Image" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem; margin-bottom: 1rem;">
        <input type="file" id="image" name="image" accept="image/*">
        <small>Upload a new image to replace the current one.</small>
    </div>
    <div class="form-actions">
        <button type="submit" class="submit-btn">Update Product</button>
        <a href="products.php" class="cancel-btn">Cancel</a>
    </div>
</form>

<!-- Re-using styles from add_product.php -->
<style>
.product-form .form-group {
    margin-bottom: 1.5rem;
}
.product-form label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
}
.product-form input[type="text"],
.product-form input[type="file"],
.product-form textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border-color);
    border-radius: 0.5rem;
    box-sizing: border-box;
}
.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
}
.submit-btn, .cancel-btn {
    padding: 0.8rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    text-align: center;
}
.submit-btn {
    background-color: var(--primary);
    color: #fff;
}
.cancel-btn {
    background-color: #e5e7eb;
    color: var(--text-dark);
}
</style>

<?php
$stmt->close();
$conn->close();
include 'footer.php';
?>
