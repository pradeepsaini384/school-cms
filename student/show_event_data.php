<?php 
include('../db_connection.php');
function getEventDetails($eventId) {
    global $conn;

    // SQL query to select event details by ID
    $sql = "SELECT * FROM event WHERE id = $eventId";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}
if (isset($_GET['eventId'])) {
    $eventId = $_GET['eventId'];

    // Fetch event details
    $eventDetails = getEventDetails($eventId);

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode($eventDetails);
} else {
    // No event ID provided in the request
    echo "Event ID not provided.";
}
?>