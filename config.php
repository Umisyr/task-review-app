<?php
/**
 * Database Configuration Template
 * 
 * INSTRUCTIONS:
 * 1. Copy this file and rename it to "config.php"
 * 2. Update the database credentials below with your own
 * 3. Never commit config.php to GitHub (it's in .gitignore)
 */

// Database configuration
define('DB_HOST', 'localhost');        // Database host
define('DB_USER', 'root');             // Your MySQL username
define('DB_PASS', 'Ummi1234');                 // Your MySQL password
define('DB_NAME', 'task_review_db');   // Database name

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8
$conn->set_charset("utf8");
?>
