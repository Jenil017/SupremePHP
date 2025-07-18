<?php
$page_title = 'Registered Users';
include 'header.php';
require_once '../database.php';

// Fetch all users from the database
$sql = "SELECT id, name, email, created_at FROM users ORDER BY created_at DESC";
$result = $conn->query($sql);

?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">All Registered Users</h2>

<table class="data-table">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Registration Date</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($user = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars(date('M d, Y, h:i A', strtotime($user['created_at']))) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4">No registered users found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conn->close();
include 'footer.php'; 
?>
