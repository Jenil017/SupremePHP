<?php
declare(strict_types=1);

// /SupremePHP/database.php

// Database configuration
const DB_HOST = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = ''; // 🔁 Replace with your database password if you have one
const DB_NAME = 'supremephp';

// Create a database connection
$conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check for connection errors
if ($conn->connect_error) {
    // Log the error to a file for security, instead of displaying it to the user
    error_log("Database connection failed: " . $conn->connect_error);
    // Display a generic error message to the user
    die("❌ Oops! Something went wrong. Please try again later.");
}

// Set the character set to UTF-8 for proper encoding
$conn->set_charset("utf8mb4");
