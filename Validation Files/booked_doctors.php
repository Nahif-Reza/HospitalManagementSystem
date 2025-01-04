<?php
session_start();
include "db_connect.php";

$currentPatient = $_SESSION['user_id'];
$query = "SELECT doctor.Name AS d_name, doctor.Id As d_id, doctor.Department
FROM 
    appointments
JOIN 
    patient ON appointments.P_ID = patient.ID
JOIN 
    doctor ON appointments.D_ID = doctor.ID
WHERE 
    patient.ID = '$currentPatient';
";

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
    echo "<h2>Your Appointments:</h2>";
    echo "<table border='1'>
            <tr>
                <th>Doctor ID</th>
                <th>Doctor Name</th>
                <th>Department</th>
            </tr>";
    
    // Fetch and display the appointments
    while ($row = mysqli_fetch_assoc($result)) {
        $d_id = $row['d_id'];
        $d_name = $row['d_name'];
        $d_dept = $row['Department'];

        echo "<tr>
                <td>{$d_id}</td>
                <td>{$d_name}</td>
                <td>{$d_dept}</td>
            </tr>";
    }
    echo "</table>";
}
else
{
    echo "You have no appointments.";
}



?>