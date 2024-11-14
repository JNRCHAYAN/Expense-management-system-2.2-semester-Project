<?php
include 'connect.php';

$loan_id = $_GET['loan_id'];

$deletq = "DELETE FROM `loans` WHERE loan_id =$loan_id" ;

$qery = mysqli_query( $con , $deletq);

header('location:loan.php');

?>