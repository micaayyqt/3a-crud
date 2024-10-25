<?php 
require('./database.php');

if (isset($_POST['delete'])){
    $deleteID = $_POST['deleteID'];

    $querrydelete = "DELETE FROM crud_system WHERE ID = $deleteID";
    $sqldelete = mysqli_query($connection, $querrydelete);


    echo '<script>alert("Successfully Deleted!")</script>';
    echo '<script>window.location.href = "/CRUD-ni-MICAY/Dashboard.php"</script>';

}

?>
