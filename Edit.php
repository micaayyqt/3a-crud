<?php
require('./database.php');

// Initialize variables
$editID = $editF = $editM = $editL = "";

// Check if the form is being edited
if (isset($_POST['edit'])) {
    $editID = $_POST['editID'];
    // Fetch current details from the database
    $queryFetch = "SELECT FirstName, MiddleName, LastName FROM crud_system WHERE ID = $editID";
    $result = mysqli_query($connection, $queryFetch);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $editF = $row['FirstName'];
        $editM = $row['MiddleName'];
        $editL = $row['LastName'];
    }
}

// Update the information
if (isset($_POST['update'])) {
    $updateID = $_POST['updateID'];
    $updateF = $_POST['updateF'];
    $updateM = $_POST['updateM'];
    $updateL = $_POST['updateL'];

    $queryUpdate = "UPDATE crud_system SET FirstName = '$updateF', MiddleName = '$updateM', LastName = '$updateL' WHERE ID = $updateID";
    $sqlUpdate = mysqli_query($connection, $queryUpdate);

    if ($sqlUpdate) {
        echo '<script>alert("Successfully Edited!")</script>';
        echo '<script>window.location.href = "/CRUD-ni-MICAY/dashboard.php"</script>';
    } else {
        echo '<script>alert("ERROR UPDATING RECORD!")</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Information</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to right, #4a90e2, #50e3c2);
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
        h3 {
            text-align: center;
            color: #666;
            margin-bottom: 15px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4a90e2;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #357ab8;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Edit Information</h1>
        <form action="" method="post"> 
            <input type="text" name="updateF" placeholder="Enter your First Name" value="<?php echo htmlspecialchars($editF); ?>" required />
            <input type="text" name="updateM" placeholder="Enter your Middle Name" value="<?php echo htmlspecialchars($editM); ?>" required />
            <input type="text" name="updateL" placeholder="Enter your Last Name" value="<?php echo htmlspecialchars($editL); ?>" required />
            <input type="submit" name="update" value="SAVE" class="btn btn-primary" />
            <input type="hidden" name="updateID" value="<?php echo htmlspecialchars($editID); ?>" />
        </form>
    </div>

</body>
</html>