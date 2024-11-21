<?php
include 'connect.php';

$invest_id = $_GET['invest_id'];

$deletq = "DELETE FROM `invest` WHERE invest_id =$invest_id" ;

$qery = mysqli_query( $con , $deletq);

header('location:investment.php');

?>