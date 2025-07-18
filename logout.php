<?php
/**
 * Logout Script
 *
 * This file handles the logout process. It securely destroys the session and redirects the user back to the login page, ensuring a clean and safe logout.
 */

declare(strict_types=1);

// 1. Initialize the session to access its data.
session_start();

// 2. Unset all of the session variables
$_SESSION = [];

// 3. Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 4. Finally, destroy the session
session_destroy();

// 5. Redirect to the unified login page
header('Location: login.php');
exit;
