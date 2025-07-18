<?php
$page_title = 'Manage Orders';
include 'header.php';
require_once '../database.php';
require_once '../send_order_email.php';

// Handle status update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id_to_update = (int)$_POST['order_id'];
    $new_status = $_POST['status'];

    // Whitelist of allowed statuses to prevent arbitrary values
    $allowed_statuses = ['Pending', 'Delivered'];

    if (in_array($new_status, $allowed_statuses)) {
        $update_sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param('si', $new_status, $order_id_to_update);
        if ($stmt->execute()) {
            // If the order is marked as delivered, send a notification email using the centralized function
            if ($new_status === 'Delivered') {
                $email_stmt = $conn->prepare("SELECT customer_name, email, product_name FROM orders WHERE id = ?");
                $email_stmt->bind_param('i', $order_id_to_update);
                $email_stmt->execute();
                $order_details_result = $email_stmt->get_result();
                if ($order_details = $order_details_result->fetch_assoc()) {
                    $order_details['order_id'] = $order_id_to_update; // Add order_id to the array
                    sendOrderDeliveredEmail($order_details);
                }
                $email_stmt->close();
            }

            // Redirect to avoid form resubmission on refresh
            header("Location: orders.php?update_success=1&order_id=" . $order_id_to_update);
            exit;
        } else {
            $update_error = "Error updating status: " . htmlspecialchars($conn->error);
        }
        $stmt->close();
    } else {
        $update_error = "Invalid status provided.";
    }
}

// Fetch all orders, joining with the products table to get product names
$sql = "SELECT 
            o.id AS order_id, 
            o.customer_name, 
            o.email,
            o.product_name, 
            o.status, 
            o.created_at AS order_date, 
            p.name AS product_name_from_products_table, 
            p.price AS product_price, 
            p.image AS product_image
        FROM orders o
        LEFT JOIN products p ON o.product_id = p.id
        ORDER BY o.created_at DESC";

$result = $conn->query($sql);

?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">Customer Orders</h2>

<?php
// Display feedback messages
if (isset($_GET['update_success'])) {
    echo '<div class="success-message" style="margin-bottom: 1.5rem;">Order #' . htmlspecialchars((string)$_GET['order_id']) . ' has been updated successfully.</div>';
}
if (isset($update_error)) {
    echo '<div class="error-message" style="margin-bottom: 1.5rem;">' . $update_error . '</div>';
}
?>

<table class="data-table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Product</th>
            <th>Total Price</th>
            <th>Order Date</th>
            <th style="width: 250px;">Status / Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($order = $result->fetch_assoc()): ?>
                <tr>
                    <td>#<?= htmlspecialchars((string)$order['order_id']) ?></td>
                    <td><?= htmlspecialchars($order['customer_name']) ?></td>
                    <td><a href="mailto:<?= htmlspecialchars($order['email']) ?>"><?= htmlspecialchars($order['email']) ?></a></td>
                    <td>
                        <div class="product-info">
                            <img src="../assets/images/products/<?= htmlspecialchars($order['product_image']) ?>" alt="Product Image" class="product-thumbnail">
                            <span><?= htmlspecialchars($order['product_name']) ?></span>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($order['product_price']) ?></td>
                    <td><?= htmlspecialchars(date('M d, Y', strtotime($order['order_date']))) ?></td>
                    <td>
                        <form method="POST" action="orders.php" class="status-update-form">
                            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                            <select name="status">
                                <?php 
                                $statuses = ['Pending', 'Delivered'];
                                foreach ($statuses as $status): 
                                ?>
                                    <option value="<?= $status ?>" <?= ($order['status'] === $status) ? 'selected' : '' ?>>
                                        <?= $status ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conn->close();
include 'footer.php'; 
?>
