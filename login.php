<?php
session_start();
require_once __DIR__ . '/assets/includes/db.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check admin table first
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->execute([$username, md5($password)]);
    $admin = $stmt->fetch();
    if ($admin) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: admin_panel.php');
        exit;
    }

    // Check users table
    $stmt = $pdo->prepare("SELECT * FROM users WHERE name = ? AND password = ?");
    $stmt->execute([$username, md5($password)]);
    $user = $stmt->fetch();
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_email'] = $user['email'];
        header('Location: index.php');
        exit;
    }

    $error = 'Invalid credentials';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        /* ...animated login form styles... */
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(120deg,#e0e7ff 0%,#f8f9fa 100%); min-height:100vh; }
        .login-box { max-width: 400px; margin: 60px auto; background: #fff; padding: 32px; border-radius: 18px; box-shadow: 0 8px 32px rgba(30,58,138,0.12); animation: fadeInUp 1s cubic-bezier(.4,2,.6,1);}
        @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(40px);} 100% { opacity: 1; transform: translateY(0);} }
        .login-box h2 { margin-bottom: 24px; font-weight: 700; color: #1A3C40; }
        .login-box input { width: 100%; padding: 12px; margin-bottom: 18px; border-radius: 8px; border: 1px solid #cfd8dc; font-size: 1.08rem;}
        .login-box button { width: 100%; padding: 12px; background: linear-gradient(135deg,#1A3C40,#2d6a4f); color: #fff; border: none; border-radius: 8px; font-weight: bold; font-size: 1.08rem; box-shadow: 0 2px 8px rgba(30,58,138,0.10); transition: transform 0.2s;}
        .login-box button:hover { transform: scale(1.04) translateY(-2px); }
        .login-box .error { color: #d32f2f; margin-bottom: 12px; font-weight: 600;}
        .login-box .register-link, .login-box .back-btn, .login-box .forgot-link { margin-top: 16px; display: block; text-align: center; color: #1A3C40; font-weight: 600;}
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            <button type="submit"><i class="fas fa-sign-in-alt" style="margin-right:8px;"></i>Login</button>
        </form>
        <a class="register-link" href="register.php">New user? Register here</a>
        <a class="forgot-link" href="forgot_password.php">Forgot password?</a>
        <a class="back-btn" href="index.php">Back to Home</a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>