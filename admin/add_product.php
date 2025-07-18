<?php
$page_title = 'Add New Product';
include 'header.php';
?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">Enter New Product Details</h2>

<form action="process_add_product.php" method="POST" enctype="multipart/form-data" class="product-form">
    <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="price">Price (e.g., 1299.00)</label>
        <input type="text" id="price" name="price" required pattern="[0-9.]+">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="6" required></textarea>
    </div>
    <div class="form-group">
        <label for="image">Product Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>
    </div>
    <div class="form-actions">
        <button type="submit" class="submit-btn">Add Product</button>
        <a href="products.php" class="cancel-btn">Cancel</a>
    </div>
</form>

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

<?php include 'footer.php'; ?>
