<?php
require('./database.php');

$querryAccount = "SELECT * FROM crud_system";
$sqlAccount = mysqli_query($connection, $querryAccount);
?>