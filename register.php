<?php
session_start();
require_once __DIR__ . '/assets/includes/db.php';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $security_question = $_POST['security_question'] ?? '';
    $security_answer = $_POST['security_answer'] ?? '';

    if ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn()) {
            $error = 'An account with this email already exists.';
        } else {
            // Hash the password and security answer securely
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $hashed_answer = password_hash(strtolower(trim($security_answer)), PASSWORD_DEFAULT);

            // Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $email, $hashed_password, $security_question, $hashed_answer]);
            
            if ($stmt->rowCount() > 0) {
                // Automatically log in the user after registration
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_email'] = $email;
                header('Location: index.php');
                exit;
            } else {
                $error = 'Registration failed. Please try again.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Supreme Thread</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* Using similar styles to the login page for consistency */
        body {
            background: linear-gradient(120deg, #f0f4ff 0%, #f8f9fa 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 2rem 0;
        }
        .register-box {
            max-width: 480px;
            width: 100%;
            margin: 2rem;
            background: #fff;
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }
        .register-box h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 700;
            font-size: 2rem;
            color: #1e293b;
        }
        .register-box .form-group {
            margin-bottom: 1.25rem;
        }
        .register-box input,
        .register-box select {
            width: 100%;
            padding: 0.8rem 1rem;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .register-box button {
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
        .register-box button:hover {
            background: var(--primary-dark, #1e3a8a);
            transform: translateY(-2px);
        }
        .register-box .error {
            color: #dc2626;
            background-color: #fee2e2;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 0.5rem;
            text-align: center;
        }
        .register-box .login-link {
            margin-top: 1.5rem;
            display: block;
            text-align: center;
            color: #475569;
        }
        .register-box .login-link a {
            color: var(--primary, #1e40af);
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Create Your Account</h2>
        <?php if ($error): ?><div class="error"><?= htmlspecialchars($error) ?></div><?php endif; ?>
        <form method="post">
            <div class="form-group">
                <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            </div>
            <div class="form-group">
                <select name="security_question" required>
                    <option value="" disabled selected>Select a security question...</option>
                    <option value="What was your first pet's name?">What was your first pet's name?</option>
                    <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                    <option value="What city were you born in?">What city were you born in?</option>
                    <option value="What was the model of your first car?">What was the model of your first car?</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="security_answer" placeholder="Your Answer" required>
            </div>
            <button type="submit">Register</button>
            <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
