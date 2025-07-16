<?php
session_start();
require_once __DIR__ . '/assets/includes/db.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['feedback'])) {
    $stmt = $pdo->prepare("INSERT INTO feedback (user_id, email, feedback, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$_SESSION['user_id'], $_SESSION['user_email'], htmlspecialchars($_POST['feedback'])]);
}
$stmt = $pdo->prepare("SELECT * FROM feedback WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$_SESSION['user_id']]);
$feedbacks = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Feedback</title>
    <style>
        body { font-family: Arial; background: #f8f9fa; }
        .feedback-box { max-width: 600px; margin: 40px auto; background: #fff; padding: 32px; border-radius: 10px; box-shadow: 0 2px 16px rgba(0,0,0,0.08);}
        .feedback-box textarea { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #ccc; margin-bottom: 12px;}
        .feedback-box button { padding: 10px 22px; background: #1A3C40; color: #fff; border: none; border-radius: 8px; font-weight: 600;}
        .feedback-list { margin-top: 24px;}
        .feedback-item { background: #f8f9fa; border-radius: 8px; padding: 12px; margin-bottom: 10px;}
        .feedback-date { font-size: 0.95rem; color: #888;}
        .back-btn { margin-top: 24px; display: inline-block; padding: 10px 22px; background: #2d6a4f; color: #fff; border-radius: 8px; text-decoration: none; font-weight: 600;}
    </style>
</head>
<body>
    <div class="feedback-box">
        <h2>My Feedback</h2>
        <form method="post">
            <textarea name="feedback" placeholder="Write your feedback..." required></textarea>
            <button type="submit">Submit Feedback</button>
        </form>
        <div class="feedback-list">
            <?php foreach ($feedbacks as $fb): ?>
                <div class="feedback-item">
                    <?= htmlspecialchars($fb['feedback']) ?>
                    <div class="feedback-date"><?= $fb['created_at'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class="back-btn" href="index.php">Back to Home</a>
    </div>
</body>
</html>
