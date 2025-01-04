<?php
session_start();
include "db_connect.php";  // Adjust path if necessary
echo "<pre>";
print_r($_POST);
echo "</pre>";
// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $department = isset($_POST['department']) ? mysqli_real_escape_string($conn, $_POST['department']) : null;
    // Password hashing for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the user already exists (based on ID or email)


    // Insert user data based on their role
    if ($role === 'doctor') {
        $query = "SELECT * FROM doctor WHERE id = '$id' OR email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "User with this ID or email already exists. Please try again with a different one.";
            exit;
        }
        // Insert into the doctor table (assuming you have a 'doctor' table)
        $query = "SELECT ID FROM department WHERE Name = '$department'";

        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch the department ID
            $row = mysqli_fetch_assoc($result);
            $department_id = $row['ID'];
            
            $query = "INSERT INTO doctor
                  VALUES ('$id', '$name', '$email', '$hashed_password', '$department', '$department_id')";
        }
    } elseif ($role === 'patient') {
        $query = "SELECT * FROM patient WHERE id = '$id' OR email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "User with this ID or email already exists. Please try again with a different one.";
            exit;
        }
        // Insert into the patient table (assuming you have a 'patient' table)
        $query = "INSERT INTO patient
                  VALUES ('$id', '$name', '$email', '$hashed_password')";
    } elseif ($role === 'staff') {
        $query = "SELECT * FROM staff WHERE id = '$id' OR email = '$email'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            echo "User with this ID or email already exists. Please try again with a different one.";
            exit;
        }
        // Insert into the staff table (assuming you have a 'staff' table)
        $query = "INSERT INTO staff
                  VALUES ('$id', '$name', '$email', '$hashed_password')";
    } else {
        echo $role;
        echo gettype($role);
        echo "Invalid role selected.";
        exit;
    }

    // Execute the query and handle errors
    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
        header("Location: ../login.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form was not submitted via POST, redirect to registration page
    header("Location: ../registration.php");
    exit;
}

?>