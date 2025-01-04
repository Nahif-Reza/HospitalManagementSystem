<?php
session_start();
include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $table = isset($_POST['table']) ? mysqli_real_escape_string($conn, $_POST['table']) : '';

    $query = "DELETE FROM $table WHERE ID = $id";

    if (mysqli_query($conn, $query)) {
        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['message'] = "Record deleted successfully.";
        } else {
            $_SESSION['message'] = "No record found to delete.";
        }
    } else {
        $_SESSION['message'] = "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);

    header("Location: ../a_dashboard.php"); // Replace with the name of your main page
    exit;
} else {
    echo "Invalid request method.";
    exit;
}
?>
