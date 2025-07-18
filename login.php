<?php
declare(strict_types=1);

session_start();
require 'database.php';

$error = null;

// Redirect if already logged in
if (isset($_SESSION['admin_id'])) {
    header('Location: admin/index.php');
    exit;
}
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username and password are required.';
    } else {
        // 1. Check if the user is an admin
        $stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password'])) {
                // Admin login successful
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                header('Location: admin/index.php');
                exit;
            }
        }
        $stmt->close();

        // 2. If not an admin, check if they are a regular user
        // Note: The 'users' table uses email as the login identifier.
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            // Verify the password against the stored hash.
            if (password_verify($password, $user['password'])) {
                // If the password needs to be rehashed to the latest algorithm, do it now.
                if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
                    $new_hash = password_hash($password, PASSWORD_DEFAULT);
                    $rehash_stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
                    $rehash_stmt->bind_param('si', $new_hash, $user['id']);
                    $rehash_stmt->execute();
                    $rehash_stmt->close();
                }

                // User login successful
                session_regenerate_id(true);
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                header('Location: index.php');
                exit;
            }
        }
        $stmt->close();

        // 3. If both checks fail, set an error message
        $error = 'Invalid credentials. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Supreme Thread</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Using main stylesheet for consistency -->
    <style>
        body {
            background: linear-gradient(120deg, #f0f4ff 0%, #f8f9fa 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .login-box {
            max-width: 420px;
            width: 100%;
            margin: 2rem;
            background: #fff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            animation: fadeInUp 0.8s ease-out;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 2rem;
            color: #1e293b;
        }
        .login-box .form-group {
            margin-bottom: 1.5rem;
        }
        .login-box input {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .login-box button {
            width: 100%;
            padding: 0.9rem;
            background: var(--primary, #1e40af);
            color: #fff;
            border: none;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s, transform 0.2s;
        }
        .login-box button:hover {
            background: var(--primary-dark, #1e3a8a);
            transform: translateY(-2px);
        }
        .login-box .error, .login-box .success-message {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .login-box .error {
            color: #dc2626;
            background-color: #fee2e2;
        }
        .login-box .success-message {
            color: #155724;
            background-color: #d4edda;
        }
        .login-box .form-links {
            display: flex;
            justify-content: space-between;
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }
        .login-box .form-links a {
            color: var(--primary, #1e40af);
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Login</h2>
        <?php 
        if (isset($_SESSION['success_message'])) {
            echo '<div class="success-message">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
            unset($_SESSION['success_message']);
        }
        if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <div class="form-group">
                <input type="text" name="username" placeholder="Username or Email" required autocomplete="username">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required autocomplete="current-password">
            </div>
            <button type="submit">Login</button>
            <div class="form-links">
                <a href="forgot_password.php">Forgot Password?</a>
                <a href="register.php">Register here</a>
            </div>
        </form>
    </div>
</body>
</html>