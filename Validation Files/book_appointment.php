<?php
session_start();
include "db_connect.php";

// Check if patient is logged in
if ($_SESSION['role'] !== 'patient') {
    echo "You must be logged in as a patient to book an appointment.";
    exit;
}

// Retrieve patient and doctor IDs from the URL
$patient_id = $_SESSION['user_id'];
$doctor_id = isset($_GET['doctor_id']) ? intval($_GET['doctor_id']) : 0;

// Validate inputs
if ($doctor_id <= 0) {
    echo "Invalid doctor selected.";
    exit;
}

$query = "SELECT * FROM appointments WHERE D_ID = '$doctor_id' and P_ID = '$patient_id';";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
    echo "You booked this already. <br>";
    exit;
}
// Insert the appointment into the database
$query = "INSERT INTO appointments VALUES ($patient_id, $doctor_id);";
$result = mysqli_query($conn, $query);

if ($result) {
    echo "<h1>Booking Successful!</h1>";
    echo "<p>Your appointment has been booked.</p>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
