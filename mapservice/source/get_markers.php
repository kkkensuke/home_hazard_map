<?php
// Set content type to JSON before any output
header('Content-Type: application/json');

// Disable error displaying - errors should be in JSON format only
ini_set('display_errors', 0);

try {
    // Include database configuration
    require_once 'db_config.php';

    // SQL query - get all markers
    $sql = "SELECT * FROM markers";
    $result = $conn->query($sql);

    if ($result) {
        $markers = array();
        
        // Fetch all markers from the database
        while ($row = $result->fetch_assoc()) {
            $markers[] = $row;
        }
        
        echo json_encode([
            'success' => true,
            'markers' => $markers
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Error fetching markers: ' . $conn->error
        ]);
    }

    // Close connection
    $conn->close();
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'PHP Error: ' . $e->getMessage()
    ]);
}
?>