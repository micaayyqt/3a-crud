<?php
require('./database.php');

// Initialize variables
$viewID = $viewF = $viewM = $viewL = "";

// Check if the form is being viewed
if (isset($_POST['view'])) {
    $viewID = $_POST['viewID'];
    // Fetch user details from the database
    $queryFetch = "SELECT FirstName, MiddleName, LastName FROM crud_system WHERE ID = $viewID";
    $result = mysqli_query($connection, $queryFetch);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $viewF = $row['FirstName'];
        $viewM = $row['MiddleName'];
        $viewL = $row['LastName'];
    } else {
        echo '<script>alert("No user found!")</script>';
        echo '<script>window.location.href = "/CRUD-ni-MICAY/dashboard.php"</script>';
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #BFFAFF;
            font-family: Arial, sans-serif;
        }
        .container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .user-info {
            margin-bottom: 15px;
            font-size: 18px;
            color: #666;
        }
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>User Information</h1>
        <div class="user-info">
            <strong>First Name:</strong> <?php echo htmlspecialchars($viewF); ?><br>
            <strong>Middle Name:</strong> <?php echo htmlspecialchars($viewM); ?><br>
            <strong>Last Name:</strong> <?php echo htmlspecialchars($viewL); ?><br>
        </div>
        <div class="back-button">
            <a href="/CRUD-ni-MICAY/dashboard.php" class="btn btn-primary">Back</a>
        </div>
    </div>

</body>
</html>
