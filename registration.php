<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Registration</h1>
    <form action="Validation Files/handle_registration.php" method="post">
        <label for="role">Role:</label>
        <select name="role" id="role" required>
            <option value="patient">Patient</option>
            <option value="doctor">Doctor</option>
            <option value="staff">Staff</option>
        </select>
        <br>
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" required>
        <br>
        <label for="name">Full Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="department">Department (if applicable):</label>
        <input type="text" id="department" name="department">
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
