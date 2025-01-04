<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard</title>
</head>
<body>
    <?php 
    session_start();
    include "Validation Files/db_connect.php";
     ?>
    <h1>Patient Dashboard</h1>
    <nav>
        <a href="search_doctor.php">Search Doctor</a> | 
        <a href="Validation Files/booked_doctors.php">Booked Doctors</a> |
        <a href="Validation Files/update_details.php">Update Details</a>
    </nav>
</body>
</html>
