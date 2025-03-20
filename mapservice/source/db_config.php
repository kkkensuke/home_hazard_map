<?php
// Database configuration
$servername = "yourservername";
$username = "username";
$password = "your_password";
$dbname = "hazard_map";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Return JSON error instead of dying with text
    header('Content-Type: application/json');
    echo json_encode([
        'success' => false,
        'message' => 'Database connection failed: ' . $conn->connect_error
    ]);
    exit;
}

?>