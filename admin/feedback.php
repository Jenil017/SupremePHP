<?php
$page_title = 'Customer Feedback';
include 'header.php';
require_once '../database.php';

// Fetch all feedback from the database, joining with the users table to get the user's name
$sql = "SELECT f.id, u.name, f.email, f.feedback AS message, f.created_at 
        FROM feedback AS f 
        JOIN users AS u ON f.user_id = u.id 
        ORDER BY f.created_at DESC";
$result = $conn->query($sql);

?>

<h2 style="margin-top: 0; margin-bottom: 1.5rem;">Customer Feedback and Inquiries</h2>

<table class="data-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>From</th>
            <th>Email</th>
            <th>Message</th>
            <th>Received At</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($feedback = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars((string)$feedback['id']) ?></td>
                    <td><?= htmlspecialchars($feedback['name']) ?></td>
                    <td><a href="mailto:<?= htmlspecialchars($feedback['email']) ?>"><?= htmlspecialchars($feedback['email']) ?></a></td>
                    <td style="white-space: pre-wrap; word-break: break-word;"><?= htmlspecialchars($feedback['message']) ?></td>
                    <td><?= htmlspecialchars(date('M d, Y, h:i A', strtotime($feedback['created_at']))) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No feedback has been submitted yet.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
$conn->close();
include 'footer.php'; 
?>
