<?php
declare(strict_types=1);

session_start();
require 'database.php';

// Ensure user has completed the security question step
if (!isset($_SESSION['reset_step']) || $_SESSION['reset_step'] !== 3) {
    header('Location: forgot_password.php');
    exit;
}

$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($new_password !== $confirm_password) {
        $error = 'Passwords do not match. Please try again.';
    } elseif (strlen($new_password) < 8) {
        $error = 'Password must be at least 8 characters long.';
    } else {
        $user_id = $_SESSION['reset_user_id'];

        // Hash the new password securely
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update the password in the database
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param('si', $hashed_password, $user_id);
        
        if ($stmt->execute()) {
            // Clean up session variables
            unset($_SESSION['reset_step'], $_SESSION['reset_user_id'], $_SESSION['reset_security_question']);

            // Set a success message and redirect to login
            $_SESSION['success_message'] = 'Your password has been reset successfully. Please log in.';
            header('Location: login.php');
            exit;
        } else {
            $error = 'An error occurred while updating your password. Please try again.';
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password - Supreme Thread</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Using styles from login/register for consistency */
        body { background: linear-gradient(120deg, #f0f4ff 0%, #f8f9fa 100%); display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .reset-box { max-width: 480px; width: 100%; margin: 2rem; background: #fff; padding: 2.5rem; border-radius: 1rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
        .reset-box h2 { text-align: center; margin-bottom: 2rem; font-weight: 700; font-size: 2rem; color: #1e293b; }
        .reset-box .form-group { margin-bottom: 1.5rem; }
        .reset-box input { width: 100%; padding: 0.8rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; box-sizing: border-box; }
        .reset-box button { width: 100%; padding: 0.9rem; background: var(--primary, #1e40af); color: #fff; border: none; border-radius: 0.5rem; font-weight: 600; font-size: 1rem; cursor: pointer; transition: background-color 0.2s; }
        .reset-box .error { color: #dc2626; background-color: #fee2e2; padding: 1rem; margin-bottom: 1.5rem; border-radius: 0.5rem; text-align: center; }
        .reset-box .login-link { margin-top: 1.5rem; display: block; text-align: center; color: #475569; }
        .reset-box .login-link a { color: var(--primary, #1e40af); font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <div class="reset-box">
        <h2>Set a New Password</h2>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <div class="form-group">
                <input type="password" name="new_password" placeholder="Enter new password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm new password" required>
            </div>
            <button type="submit">Reset Password</button>
        </form>
        <p class="login-link"><a href="login.php">Back to Login</a></p>
    </div>
</body>
</html>
