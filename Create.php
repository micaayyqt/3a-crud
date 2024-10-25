<?php
require('./database.php');

if (isset($_POST['create'])) {
    // Correctly assign the variables
    $Fname = $_POST['Fname'];
    $Mname = $_POST['Mname'];
    $Lname = $_POST['Lname'];

    // Prepare the SQL query
    $queryCreate = "INSERT INTO crud_system (FirstName, MiddleName, LastName) VALUES ('$Fname', '$Mname', '$Lname')";
    
    // Execute the query
    $sqlCreate = mysqli_query($connection, $queryCreate);

    if ($sqlCreate) {
        echo '<script>alert("Successfully Created!")</script>';
        echo '<script>window.location.href = "/CRUD-ni-MICAY/dashboard.php"</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($connection) . '")</script>';
    }
}
?>