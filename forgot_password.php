<?php
require_once 'db.php';
$step = 1;
$error = '';
$security_question = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username'])) {
        $username = trim($_POST['username']);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user) {
            $step = 2;
            $security_question = $user['security_question'];
        } else {
            $error = 'Username not found';
        }
    } elseif (isset($_POST['username_verify'], $_POST['security_answer'])) {
        $username = trim($_POST['username_verify']);
        $answer = trim($_POST['security_answer']);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && strtolower($user['security_answer']) === strtolower($answer)) {
            $step = 3;
        } else {
            $error = 'Incorrect answer';
            $security_question = $user ? $user['security_question'] : '';
            $step = 2;
        }
    } elseif (isset($_POST['username_reset'], $_POST['new_password'])) {
        $username = trim($_POST['username_reset']);
        $new_password = $_POST['new_password'];
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE name = ?");
        $stmt->execute([md5($new_password), $username]);
        $error = '';
        $step = 4;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <style>
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(120deg,#e0e7ff 0%,#f8f9fa 100%); min-height:100vh; }
        .forgot-box { max-width: 400px; margin: 60px auto; background: #fff; padding: 32px; border-radius: 18px; box-shadow: 0 8px 32px rgba(30,58,138,0.12); animation: fadeInUp 1s cubic-bezier(.4,2,.6,1);}
        @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(40px);} 100% { opacity: 1; transform: translateY(0);} }
        .forgot-box h2 { margin-bottom: 24px; font-weight: 700; color: #1A3C40; }
        .forgot-box input { width: 100%; padding: 12px; margin-bottom: 18px; border-radius: 8px; border: 1px solid #cfd8dc; font-size: 1.08rem;}
        .forgot-box button { width: 100%; padding: 12px; background: linear-gradient(135deg,#1A3C40,#2d6a4f); color: #fff; border: none; border-radius: 8px; font-weight: bold; font-size: 1.08rem; box-shadow: 0 2px 8px rgba(30,58,138,0.10); transition: transform 0.2s;}
        .forgot-box button:hover { transform: scale(1.04) translateY(-2px); }
        .forgot-box .error { color: #d32f2f; margin-bottom: 12px; font-weight: 600;}
        .forgot-box .back-btn { margin-top: 16px; display: block; text-align: center; color: #1A3C40; font-weight: 600;}
    </style>
</head>
<body>
    <div class="forgot-box">
        <h2>Forgot Password</h2>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <?php if ($step === 1): ?>
            <form method="post">
                <input type="text" name="username" placeholder="Enter your username" required>
                <button type="submit">Next</button>
            </form>
        <?php elseif ($step === 2): ?>
            <form method="post">
                <input type="hidden" name="username_verify" value="<?= htmlspecialchars($_POST['username']) ?>">
                <label for="security_answer" style="font-weight:600;"><?= htmlspecialchars($security_question) ?></label>
                <input type="text" name="security_answer" placeholder="Your Answer" required>
                <button type="submit">Verify</button>
            </form>
        <?php elseif ($step === 3): ?>
            <form method="post">
                <input type="hidden" name="username_reset" value="<?= htmlspecialchars($_POST['username_verify']) ?>">
                <input type="password" name="new_password" placeholder="New Password" required>
                <button type="submit">Reset Password</button>
            </form>
        <?php elseif ($step === 4): ?>
            <div style="color:green;font-weight:600;">Password reset successfully! <a href="login.php">Login now</a></div>
        <?php endif; ?>
        <a class="back-btn" href="index.php">Back to Home</a>
    </div>
</body>
</html>
