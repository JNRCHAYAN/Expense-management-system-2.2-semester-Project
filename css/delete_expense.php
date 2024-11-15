<?php
include 'dbcon.php';

$income_id = $_GET['income_id'];

$deletq = "DELETE FROM income WHERE income_id =$income_id" ;

$qery = mysqli_query( $con , $deletq);

header('location:income.php');

?>