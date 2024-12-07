<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .wrapper {
            border
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h1>Enter Your Information</h1>
        <form action="#" method="post">
            <label for="fname">First Name: </label>
            <input type="text" name="fname" id="fname"><br>

            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname"><br>

            <label for="gender">Select Your Gender</label>
            <select name="gender" id="gender">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select> <br>
            
            <label for="age">Age</label>
            <input type="age" name="age" id="age"><br>

            <label for="phone">Phone No</label>
            <input type="phone" name="phone" id="phone"><br>

        </form>
    </div>
</body>
</html>