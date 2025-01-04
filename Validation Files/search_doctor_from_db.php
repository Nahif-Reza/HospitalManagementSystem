<?php
session_start();
include "db_connect.php";

$department = mysqli_real_escape_string($conn, $_GET['department']);

$query = "
    SELECT doctor.ID, doctor.Name 
    FROM doctor 
    JOIN department ON doctor.Dept_ID = department.ID 
    WHERE department.Name = '$department'
";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    echo "<h2>Doctors in the $department Department:</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        $doctorId = $row['ID'];
        $doctorName = htmlspecialchars($row['Name']);
        echo "<li>$doctorName 
                <form action='book_appointment.php' method='get' style='display:inline;'>
                    <input type='hidden' name='doctor_id' value='$doctorId'>
                    <button type='submit'>Book Appointment</button>
                </form>
              </li>";
    }
    echo "</ul>";
} else {
    echo "No doctors found in the selected department.";
}

mysqli_close($conn);
?>
