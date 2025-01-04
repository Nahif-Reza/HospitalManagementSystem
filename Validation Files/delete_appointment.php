<?php
session_start();
include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve P_ID and D_ID from POST data
    $p_id = $_POST['p_id'];
    $d_id = $_POST['d_id'];

    // Check if both IDs are provided
    if (!empty($p_id) && !empty($d_id)) {
        // Prepare and execute the DELETE query
        $query = "DELETE FROM appointments WHERE P_ID = ? AND D_ID = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $p_id, $d_id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Appointment deleted successfully.";
        } else {
            $_SESSION['message'] = "Error deleting appointment: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['message'] = "Invalid request. Missing appointment identifiers.";
    }

    $conn->close();

    // Redirect back to the appointments page
    header("Location: ../s_dashboard.php");
    exit;
}
?>
