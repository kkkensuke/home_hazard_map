<?php
// Include database configuration
require_once 'db_config.php';

// Get JSON data from POST request
$data = json_decode(file_get_contents('php://input'), true);

// Check if ID is present
if (!isset($data['id']) || empty($data['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Missing marker ID'
    ]);
    exit;
}

// Prepare the data for database deletion
$id = intval($data['id']);

// SQL query - delete marker
$sql = "DELETE FROM markers WHERE id = $id";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        'success' => true,
        'message' => 'Marker deleted successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error deleting marker: ' . $conn->error
    ]);
}

// Close connection
$conn->close();
?>