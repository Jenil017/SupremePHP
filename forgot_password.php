<?php
declare(strict_types=1);

session_start();
require 'database.php';

$error = null;
$step = 1;
$security_question = null;

// If user is already on step 2 (answering the question)
if (isset($_SESSION['reset_user_id']) && isset($_SESSION['reset_step']) && $_SESSION['reset_step'] === 2) {
    $step = 2;
    $security_question = $_SESSION['reset_security_question'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- STEP 1: Find user by email and get security question ---
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $stmt = $conn->prepare("SELECT id, security_question FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $_SESSION['reset_step'] = 2;
            $_SESSION['reset_user_id'] = $user['id'];
            $_SESSION['reset_security_question'] = $user['security_question'];
            header('Location: forgot_password.php');
            exit;
        } else {
            $error = 'No account found with that email address.';
        }
        $stmt->close();
    }

    // --- STEP 2: Verify security answer ---
    if (isset($_POST['security_answer'])) {
        $answer = strtolower(trim($_POST['security_answer']));
        $user_id = $_SESSION['reset_user_id'];

        $stmt = $conn->prepare("SELECT security_answer FROM users WHERE id = ?");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($answer, $user['security_answer'])) {
            $_SESSION['reset_step'] = 3; // Mark as ready for password reset
            header('Location: reset_password.php');
            exit;
        } else {
            $error = 'The answer is incorrect. Please try again.';
            $step = 2; // Keep them on step 2
            $security_question = $_SESSION['reset_security_question'];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password - Supreme Thread</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Using styles from login/register for consistency */
        body { background: linear-gradient(120deg, #f0f4ff 0%, #f8f9fa 100%); display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .forgot-box { max-width: 480px; width: 100%; margin: 2rem; background: #fff; padding: 2.5rem; border-radius: 1rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08); }
        .forgot-box h2 { text-align: center; margin-bottom: 2rem; font-weight: 700; font-size: 2rem; color: #1e293b; }
        .forgot-box .form-group { margin-bottom: 1.5rem; }
        .forgot-box input { width: 100%; padding: 0.8rem 1rem; border-radius: 0.5rem; border: 1px solid #d1d5db; font-size: 1rem; box-sizing: border-box; }
        .forgot-box button { width: 100%; padding: 0.9rem; background: var(--primary, #1e40af); color: #fff; border: none; border-radius: 0.5rem; font-weight: 600; font-size: 1rem; cursor: pointer; transition: background-color 0.2s; }
        .forgot-box .error { color: #dc2626; background-color: #fee2e2; padding: 1rem; margin-bottom: 1.5rem; border-radius: 0.5rem; text-align: center; }
        .forgot-box .question-display { background-color: #f1f5f9; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem; text-align: center; font-weight: 500; color: #334155; }
        .forgot-box .login-link { margin-top: 1.5rem; display: block; text-align: center; color: #475569; }
        .forgot-box .login-link a { color: var(--primary, #1e40af); font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>
    <div class="forgot-box">
        <h2>Password Recovery</h2>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>

        <?php if ($step === 1): ?>
            <p style="text-align: center; margin-bottom: 1.5rem; color: #475569;">Please enter your account's email address to begin.</p>
            <form method="post">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <button type="submit">Find Account</button>
            </form>
        <?php elseif ($step === 2): ?>
            <p style="text-align: center; margin-bottom: 1rem; color: #475569;">Please answer your security question to continue.</p>
            <div class="question-display"><?= htmlspecialchars($security_question) ?></div>
            <form method="post">
                <div class="form-group">
                    <input type="text" name="security_answer" placeholder="Your Answer" required autofocus>
                </div>
                <button type="submit">Verify Answer</button>
            </form>
        <?php endif; ?>

        <p class="login-link"><a href="login.php">Back to Login</a></p>
    </div>
</body>
</html>
