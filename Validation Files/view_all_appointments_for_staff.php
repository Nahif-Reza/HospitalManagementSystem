<?php
session_start();
include "db_connect.php";

$query = "SELECT patient.Name AS p_name, patient.ID AS p_id, doctor.Name AS d_name, doctor.ID AS d_id
FROM 
    appointments
JOIN 
    patient ON appointments.P_ID = patient.ID
JOIN 
    doctor ON appointments.D_ID = doctor.ID;
";

$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    echo "<h2>All Appointments:</h2>";
    echo "<table border='1'>
            <tr>
                <th>Patient ID</th>
                <th>Patient Name</th>
                <th>Doctor ID</th>
                <th>Doctor Name</th>
                <th>Action</th>
            </tr>";
    
    // Fetch and display the appointments
    while ($row = mysqli_fetch_assoc($result)) {
        $p_id = $row['p_id'];
        $p_name = $row['p_name'];
        $d_id = $row['d_id'];
        $d_name = $row['d_name'];

        echo "<tr>
                <td>{$p_id}</td>
                <td>{$p_name}</td>
                <td>{$d_id}</td>
                <td>{$d_name}</td>
                <td>
                    <form method='POST' action='delete_appointment.php' style='margin: 0;'>
                        <input type='hidden' name='p_id' value='{$p_id}'>
                        <input type='hidden' name='d_id' value='{$d_id}'>
                        <button type='submit' onclick='return confirm(\"Are you sure you want to delete this appointment?\");'>Delete</button>
                    </form>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "There are no appointments.";
}
?>
