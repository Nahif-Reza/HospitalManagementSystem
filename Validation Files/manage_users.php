<?php
session_start();
include "db_connect.php";

$query = "SELECT * FROM patient;";
$patients = mysqli_query($conn, $query);

$query = "SELECT * FROM doctor;";
$doctors = mysqli_query($conn, $query);

$query = "SELECT * FROM staff;";
$staffs = mysqli_query($conn, $query);

// Display doctors
if (mysqli_num_rows($doctors) > 0) {
    echo "<h2>List of all Doctors</h2>";
    echo "<table border='1'>
          <tr>
            <th>Doctor ID</th>
            <th>Doctor Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($doctors)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['Name']) . "</td>
                <td>" . htmlspecialchars($row['Email']) . "</td>
                <td>
                    <form action='delete.php' method='POST'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                        <input type='hidden' name='table' value='doctor'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No doctors found.</p>";
}

// Display patients
if (mysqli_num_rows($patients) > 0) {
    echo "<h2>List of all Patients</h2>";
    echo "<table border='1'>
          <tr>
            <th>Patient ID</th>
            <th>Patient Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($patients)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['Name']) . "</td>
                <td>" . htmlspecialchars($row['Email']) . "</td>
                <td>
                    <form action='delete.php' method='POST'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                        <input type='hidden' name='table' value='patient'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No patients found.</p>";
}

// Display staff
if (mysqli_num_rows($staffs) > 0) {
    echo "<h2>List of all Staff</h2>";
    echo "<table border='1'>
          <tr>
            <th>Staff ID</th>
            <th>Staff Name</th>
            <th>Email</th>
            <th>Action</th>
          </tr>";
    while ($row = mysqli_fetch_assoc($staffs)) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['Name']) . "</td>
                <td>" . htmlspecialchars($row['Email']) . "</td>
                <td>
                    <form action='delete.php' method='POST'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['ID']) . "'>
                        <input type='hidden' name='table' value='staff'>
                        <button type='submit'>Delete</button>
                    </form>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No staff found.</p>";
}
?>
