<?php
session_start();
require('./Read.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    // Sanitize inputs
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Query to check username and password
    $queryAccount = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
    $sqlAccount = mysqli_query($connection, $queryAccount);

    if (mysqli_num_rows($sqlAccount) > 0) {
        $_SESSION['username'] = $username;

        if ($remember) {
            setcookie('username', $username, time() + (86400 * 30), "/");
        }

        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid username or password.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
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
        h1 {
            color: #007bff;
            margin-bottom: 30px;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
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
        <h1>LOGIN</h1>
        <form action="Login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" placeholder="Enter your Username" required class="form-control" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your Password" required class="form-control" />
            </div>
            <div class="form-check mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input" />
                <label for="remember" class="form-check-label">Remember Me</label>
            </div>
            <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="footer">
            <p>Don't have an account? <a href="Registration.php">Signup</a></p>
        </div>
    </div>
</body>
</html>
