<?php
session_start();
require_once __DIR__ . '/assets/includes/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $security_question = $_POST['security_question'];
    $security_answer = trim($_POST['security_answer']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Invalid email address';
    } else {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR name = ?");
        $stmt->execute([$email, $name]);
        if ($stmt->fetch()) {
            $error = 'Username or email already registered';
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, md5($password), $security_question, $security_answer]);
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        /* ...animated register form styles... */
        body { font-family: 'Segoe UI', Arial, sans-serif; background: linear-gradient(120deg,#e0e7ff 0%,#f8f9fa 100%); min-height:100vh; }
        .register-box { max-width: 400px; margin: 60px auto; background: #fff; padding: 32px; border-radius: 18px; box-shadow: 0 8px 32px rgba(30,58,138,0.12); animation: fadeInUp 1s cubic-bezier(.4,2,.6,1);}
        @keyframes fadeInUp { 0% { opacity: 0; transform: translateY(40px);} 100% { opacity: 1; transform: translateY(0);} }
        .register-box h2 { margin-bottom: 24px; font-weight: 700; color: #1A3C40; }
        .register-box input, .register-box select { width: 100%; padding: 12px; margin-bottom: 18px; border-radius: 8px; border: 1px solid #cfd8dc; font-size: 1.08rem;}
        .register-box button { width: 100%; padding: 12px; background: linear-gradient(135deg,#1A3C40,#2d6a4f); color: #fff; border: none; border-radius: 8px; font-weight: bold; font-size: 1.08rem; box-shadow: 0 2px 8px rgba(30,58,138,0.10); transition: transform 0.2s;}
        .register-box button:hover { transform: scale(1.04) translateY(-2px); }
        .register-box .error { color: #d32f2f; margin-bottom: 12px; font-weight: 600;}
        .register-box .login-link, .register-box .back-btn { margin-top: 16px; display: block; text-align: center; color: #1A3C40; font-weight: 600;}
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Register</h2>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <input type="text" name="name" placeholder="Username" required autocomplete="username">
            <input type="email" name="email" placeholder="Email" required autocomplete="email">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <select name="security_question" required>
                <option value="">Select a security question</option>
                <option value="teacher">Favourite Teacher?</option>
                <option value="fruit">Favourite Fruit?</option>
                <option value="game">Favourite Game?</option>
                <option value="movie">Favourite Movie?</option>
            </select>
            <input type="text" name="security_answer" placeholder="Your Answer" required>
            <button type="submit"><i class="fas fa-user-plus" style="margin-right:8px;"></i>Register</button>
        </form>
        <a class="login-link" href="login.php">Already have an account? Login</a>
        <a class="back-btn" href="index.php">Back to Home</a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</body>
</html>
