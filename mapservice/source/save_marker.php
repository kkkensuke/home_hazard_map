<?php
// Set content type to JSON before any output
header('Content-Type: application/json');

// Disable error displaying - errors should be in JSON format only
ini_set('display_errors', 0);

try {
    // Include database configuration
    require_once 'db_config.php';

    // Get JSON data from POST request
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if all required fields are present
    if (!isset($data['title']) || !isset($data['lat']) || !isset($data['lng']) || !isset($data['type'])) {
        echo json_encode([
            'success' => false,
            'message' => 'Missing required fields'
        ]);
        exit;
    }

    // Prepare the data for database insertion
    $title = $conn->real_escape_string($data['title']);
    $type = $conn->real_escape_string($data['type']);
    $lat = floatval($data['lat']);
    $lng = floatval($data['lng']);
    $memo = isset($data['memo']) ? $conn->real_escape_string($data['memo']) : '';
    $url = isset($data['url']) ? $conn->real_escape_string($data['url']) : '';
    $id = isset($data['id']) && !empty($data['id']) ? intval($data['id']) : null;

    // SQL query - insert new marker or update existing one
    if ($id) {
        // Update existing marker
        $sql = "UPDATE markers SET 
                title = '$title', 
                type = '$type', 
                lat = $lat, 
                lng = $lng, 
                memo = '$memo',
                url = '$url' 
                WHERE id = $id";
        
        if ($conn->query($sql) === TRUE) {
            echo json_encode([
                'success' => true,
                'id' => $id,
                'message' => 'Marker updated successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error updating marker: ' . $conn->error
            ]);
        }
    } else {
        // Insert new marker
        $sql = "INSERT INTO markers (title, type, lat, lng, memo, url) 
                VALUES ('$title', '$type', $lat, $lng, '$memo', '$url')";
        
        if ($conn->query($sql) === TRUE) {
            $newId = $conn->insert_id;
            echo json_encode([
                'success' => true,
                'id' => $newId,
                'message' => 'Marker saved successfully'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Error saving marker: ' . $conn->error
            ]);
        }
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
