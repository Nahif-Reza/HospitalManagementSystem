<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form action="Validation Files/handle_login.php" method="post">
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="doctor">Doctor</option>
            <option value="patient">Patient</option>
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        <br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <a href="registration.php">Don't have an account? Register here</a>
</body>
</html>
