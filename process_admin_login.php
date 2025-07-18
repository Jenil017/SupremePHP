<?php
declare(strict_types=1);

session_start();

require_once 'database.php';

// 1. Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: admin_login.php');
    exit;
}

// 2. Get form data
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = 'Username and password are required.';
    header('Location: admin_login.php');
    exit;
}

// 3. Find the admin user in the database
$stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $admin = $result->fetch_assoc();

    // 4. Verify the password
    if (password_verify($password, $admin['password'])) {
        // Password is correct, start the session
        session_regenerate_id(true);
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        
        // Redirect to the admin dashboard
        header('Location: admin/index.php');
        exit;
    } 
}

// 5. If login fails, redirect back with an error
$_SESSION['login_error'] = 'Invalid username or password.';
header('Location: admin_login.php');
exit;
