<?php
include 'connect.php';

$expense_id = $_GET['expense_id'];

$deletq = "DELETE FROM `expenses` WHERE expense_id = $expense_id" ;

$qery = mysqli_query( $con , $deletq);

header('location:Expanse.php');

?>