<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Doctor</title>
</head>
<body>
<?php 
session_start();
include "Validation Files/db_connect.php";
?>
    <h1>Search for a Doctor</h1>
    <form action="Validation Files/search_doctor_from_db.php" method="get">
        <label for="department">Department:</label>
        <select name="department" id="department">
            <option value="Cardiology">Cardiology</option>
            <option value="Nneurology">Neurology</option>
            <option value="ENT">ENT</option>
        </select>
        <br>
        <button type="submit">Search</button>
    </form>
    <h2>Search Results</h2>
    <!-- List of doctors will be displayed dynamically here -->
</body>
</html>
