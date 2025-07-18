<?php
$page_title = 'Manage Products';
include 'header.php';
require_once '../database.php';

// Fetch all products from the database
$result = $conn->query("SELECT id, name, price, image FROM products ORDER BY id DESC");

?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2 style="margin: 0;">All Products</h2>
    <a href="add_product.php" class="add-new-btn">+ Add New Product</a>
</div>

<?php
// Display feedback messages if any
if (isset($_SESSION['success_message'])) {
    echo '<div class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
    unset($_SESSION['error_message']);
}
?>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($product = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$product['id']) ?></td>
                    <td>
                        <img src="../<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 0.5rem;">
                    </td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td>
                        <?php 
                            // Clean price before formatting
                            $price = preg_replace('/[^0-9.]/', '', $product['price']);
                            echo '₹' . htmlspecialchars(number_format((float)$price, 2));
                        ?>
                    </td>
                    <td class="action-links">
                        <a href="edit_product.php?id=<?= $product['id'] ?>">Edit</a>
                        <a href="delete_product.php?id=<?= $product['id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No products found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<style>
.add-new-btn {
    background-color: var(--primary);
    color: #fff;
    padding: 0.7rem 1.2rem;
    text-decoration: none;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: background-color 0.2s;
}
.add-new-btn:hover {
    background-color: var(--primary-dark);
}
.success-message {
    background-color: #dcfce7;
    color: #166534;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1.5rem;
}
</style>

<?php
$conn->close();
include 'footer.php'; 
?>
