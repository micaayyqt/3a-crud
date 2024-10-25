<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}

// Welcome message
$username = $_SESSION['username'];

// Include your database read script
require('./Read.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        @media print {
            #printButton {
                display: none;
            }
        }
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        nav {
            background-color: #333; /* Darker color for navbar */
            padding: 10px 0; /* Add some padding */
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        li {
            display: inline-block;
        }

        li a {
            display: block;
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        li a:hover {
            background-color: #555; /* Lighter shade on hover */
            color: white;
        }

        .content {
            flex: 1;
        }

        table {
            width: 10%; /* Adjusted width of the table */
            margin: auto; /* Center the table */
        }

    </style>
</head>
<body>

<nav>
    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="Logout.php">Log out</a></li>
        <li style="display: inline-block; float: right; margin-right: 20px;">
            <form class="d-flex" role="search" action="Search.php" method="get" style="display: inline;">
                <input class="form-control" type="search" placeholder="Search..." aria-label="Search" name="query" style="width: 200px; display: inline;" onkeyup="searchFunction()"/>
            </form>
        </li>
    </ul>
</nav>


<div class="content">
    <center>
        <h1>Welcome, <span style="color: black; font-weight: bold;"><?php echo htmlspecialchars($username); ?></span>!</h1>
    </center>

    <form action="Create.php" method="post"> 
        <h3>Create User Info</h3>
        <input type="text" name="Fname" placeholder="Enter your FirstName" required/>
        <input type="text" name="Mname" placeholder="Enter your MiddleName" required/>
        <input type="text" name="Lname" placeholder="Enter your LastName" required/>
        <input type="submit" name="create" value="CREATE" class="btn btn-primary"/>
        <button id="printButton" onclick="window.print()" class="btn btn-primary">PRINT</button>
    </form>

    <br>

    <div class="row">
        <div class="col-md-6">
            <h3>User List</h3>
        </div>
    </div>

    <table class="table" id="userTable">
        <thead>
            <tr class="info">
                <th>ID</th>
                <th>FirstName</th>
                <th>MiddleName</th>
                <th>LastName</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php while($results = mysqli_fetch_array($sqlAccount)) { ?>
            <tr class="active"> 
                <td><?php echo $results['ID']?></td>
                <td><?php echo $results['FirstName']?></td>
                <td><?php echo $results['MiddleName']?></td>
                <td><?php echo $results['LastName']?></td>
                <td>
                    <form action="Edit.php" method="post" style="display:inline;">
                        <input type="submit" name="edit" value="EDIT" class="btn btn-info" style="width: 70px;">
                        <input type="hidden" name="editID" value="<?php echo $results['ID'] ?>">
                        <input type="hidden" name="editF" value="<?php echo $results['FirstName'] ?>">
                        <input type="hidden" name="editM" value="<?php echo $results['MiddleName'] ?>">
                        <input type="hidden" name="editL" value="<?php echo $results['LastName'] ?>">
                    </form>
                    <form action="View.php" method="post" style="display:inline;">
                        <input type="submit" name="view" value="VIEW" class="btn btn-success" style="width: 70px;">
                        <input type="hidden" name="viewID" value="<?php echo $results['ID'] ?>">
                    </form>
                    <form action="Delete.php" method="post" style="display:inline;">
                        <input type="submit" name="delete" value="DELETE" class="btn btn-danger"> 
                        <input type="hidden" name="deleteID" value="<?php echo $results['ID'] ?>">
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </div>
</div>

<script>
function searchFunction() {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.querySelector('input[name="query"]'); // Adjust this line to select the correct input
    filter = input.value.toUpperCase();
    table = document.getElementById("userTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) {
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        for (j = 0; j < td.length - 1; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}
</script>


</body>
</html>
