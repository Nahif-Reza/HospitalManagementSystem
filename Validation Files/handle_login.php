<?php
session_start();
include "db_connect.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if ($role === 'doctor') {
        $query = "SELECT * FROM doctor WHERE email = '$email'";
    } elseif ($role === 'patient') {
        $query = "SELECT * FROM patient WHERE email = '$email'";
    } elseif ($role === 'staff') {
        $query = "SELECT * FROM staff WHERE email = '$email'";
    } elseif ($role === 'admin') {
        $query = "SELECT * FROM admin_table WHERE email = '$email'";
    } else {
        echo "Invalid role.";
        exit;
    }

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if($role === 'admin')
        {
            if($password === $row['Pass'])
            {
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['username'] = $row['Name'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['role'] = $role;
                header("Location: ../a_dashboard.php");
            }
            else
            {
                echo "Invalid Password";
            }
        }
        else
        {
            if (password_verify($password, $row['Pass'])) {
                $_SESSION['user_id'] = $row['ID'];
                $_SESSION['username'] = $row['Name'];
                $_SESSION['email'] = $row['Email'];
                $_SESSION['role'] = $role;
                
    
                if ($role === 'doctor') {
                    header("Location: ../d_dashboard.php");
                } elseif ($role === 'patient') {
                    header("Location: ../p_dashboard.php");
                } elseif ($role === 'staff') {
                    header("Location: ../s_dashboard.php");
                } elseif ($role === 'admin') {
                    header("Location: ../a_dashboard.php");
                }
                exit;
            } else {
                echo "Invalid password.";
            }
        }
    } else {
        echo "No user found with that email.";
    }

    mysqli_close($conn);
} else {
    header("Location: login.php");
    exit;
}
?>
