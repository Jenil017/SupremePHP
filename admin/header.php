<?php
declare(strict_types=1);

// This file should be included at the top of all admin pages

session_start();

// If admin is not logged in, redirect to the unified login page
if (!isset($_SESSION['admin_id'])) {
    header('Location: ../login.php');
    exit;
}

$admin_username = $_SESSION['admin_username'] ?? 'Admin';

// A helper function to determine if a nav link is active
function is_active(string $page_name): string {
    // basename() gets the filename from the current script path
    return basename($_SERVER['PHP_SELF']) === $page_name ? 'active' : '';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title ?? 'Admin Panel') ?> - Supreme Thread</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/admin_style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="admin-wrapper">
    <?php include 'sidebar.php'; // Include the sidebar for navigation ?>
    <div class="main-content">
        <header class="main-header">
            <h1><?= htmlspecialchars($page_title ?? 'Dashboard') ?></h1>
            <div class="admin-info">
                <span>Welcome, <strong><?= htmlspecialchars($admin_username) ?></strong> | </span>
                <a href="../logout.php">Logout</a>
            </div>
        </header>
        <main class="content-wrapper">
            <div class="content-box">
