<?php
include 'connect.php';

$saving_id = $_GET['saving_id'];

$deletq = "DELETE FROM `savings` WHERE saving_id =$saving_id" ;

$qery = mysqli_query( $con , $deletq);

header('location:investment.php');

?>