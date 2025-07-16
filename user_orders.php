<?php
session_start();
require_once __DIR__ . '/assets/includes/db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
$stmt = $pdo->prepare("SELECT * FROM orders WHERE email = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_email']]);
$orders = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
    <style>
        body { font-family: Arial; background: #f8f9fa; }
        .orders-box { max-width: 900px; margin: 40px auto; background: #fff; padding: 32px; border-radius: 10px; box-shadow: 0 2px 16px rgba(0,0,0,0.08);}
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; border-bottom: 1px solid #eee; }
        th { background: #1A3C40; color: #fff; }
        .back-btn { margin-top: 24px; display: inline-block; padding: 10px 22px; background: #2d6a4f; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;}
    </style>
</head>
<body>
    <div class="orders-box">
        <h2>My Orders</h2>
        <table>
            <tr>
                <th>Product</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
            <?php foreach ($orders as $order): ?>
            <tr>
                <td><?= htmlspecialchars($order['product_name']) ?></td>
                <td><?= htmlspecialchars($order['status']) ?></td>
                <td><?= $order['created_at'] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <a class="back-btn" href="index.php">Back to Home</a>
    </div>
</body>
</html>
