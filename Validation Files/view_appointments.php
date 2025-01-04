<?php
session_start();
include "db_connect.php";

$currentDoctor = $_SESSION['user_id'];
$query = "SELECT patient.Name AS p_name, patient.ID As p_id
FROM 
    appointments
JOIN 
    patient ON appointments.P_ID = patient.ID
JOIN 
    doctor ON appointments.D_ID = doctor.ID
WHERE 
    doctor.ID = '$currentDoctor';
";

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
    echo "<h2>Your Appointments:</h2>";
    echo "<table border='1'>
            <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
            </tr>";
    
    // Fetch and display the appointments
    while ($row = mysqli_fetch_assoc($result)) {
        $p_id = $row['p_id'];
        $p_name = $row['p_name'];

        echo "<tr>
                <td>{$p_id}</td>
                <td>{$p_name}</td>
            </tr>";
    }
    echo "</table>";
}
else
{
    echo "You have no appointments.";
}
?>