<?php
require('./database.php');

if (isset($_POST['registration'])) {
    $Fname = $_POST['Fname'];
    $Uname = $_POST['Uname'];
    $Ename = $_POST['Ename'];
    $Pname = $_POST['Pname'];

    // Sanitize inputs
    $Fname = mysqli_real_escape_string($connection, $Fname);
    $Uname = mysqli_real_escape_string($connection, $Uname);
    $Ename = mysqli_real_escape_string($connection, $Ename);
    $Pname = mysqli_real_escape_string($connection, $Pname);

    // Query to insert user data
    $queryRegistration = "INSERT INTO registration VALUES (null, '$Fname', '$Uname', '$Ename', '$Pname')";
    $sqlregistration = mysqli_query($connection, $queryRegistration);

    echo '<script>alert("Successfully Registered!")</script>';
    echo '<script>window.location.href = "Login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #BFFAFF;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: #A3D5FF;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }
        h3 {
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }
        .btn-info {
            background-color: #007bff;
            border: none;
        }
        .btn-info:hover {
            background-color: #0056b3;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
        }
        .footer a {
            color: #007bff;
            text-decoration: none;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Sign Up</h3>
        <form action="Registration.php" method="post">
            <div class="mb-3">
                <label for="Fname" class="form-label">Full Name</label>
                <input type="text" id="Fname" name="Fname" placeholder="Enter your Full Name" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="Uname" class="form-label">Username</label>
                <input type="text" id="Uname" name="Uname" placeholder="Enter your Username" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="Ename" class="form-label">Email</label>
                <input type="email" id="Ename" name="Ename" placeholder="Enter your Email" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="Pname" class="form-label">Password</label>
                <input type="password" id="Pname" name="Pname" placeholder="Enter your Password" required class="form-control" />
            </div>
            <button type="submit" name="registration" class="btn btn-info w-100">Register</button>
        </form>
        <div class="footer">
            <p>Already have an account? <a href="Login.php">Login</a></p>
        </div>
    </div>
</body>
</html>
