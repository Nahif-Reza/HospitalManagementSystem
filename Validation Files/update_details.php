<?php
// Include the database connection file
include "db_connect.php";

// Start the session to access the logged-in user's details
session_start();

// Assuming the user is logged in and the ID is stored in the session
$user_id = $_SESSION['user_id']; 
$user_role = $_SESSION['role']; // Could be 'doctor', 'patient', 'staff'

// Fetch current user details based on their ID
$query = "SELECT * FROM $user_role WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and get the updated details from the form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : '';

    // Password hashing (if the password is changed)
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE $user_role SET name = '$name', email = '$email', Pass = '$hashed_password' WHERE id = '$user_id'";
    } else {
        $update_query = "UPDATE $user_role SET name = '$name', email = '$email' WHERE id = '$user_id'";
    }

    // Execute the update query
    if (mysqli_query($conn, $update_query)) {
        echo "Details updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>
</head>
<body>
    <h1>Update Your Details</h1>

    <form action="update_details.php" method="post">
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" value="" placeholder="Enter new name">
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter new emmail">
        <br>

        <label for="password">New Password:</label>
        <input type="password" id="password" name="password">
        <br>

        <button type="submit">Update Details</button>
    </form>

</body>
</html>
