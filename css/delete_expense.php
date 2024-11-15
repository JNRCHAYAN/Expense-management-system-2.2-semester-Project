<?php
include 'database.php';

$expense_id = $_GET['expense_id'];

$deleted = "DELETE FROM expenses WHERE expense_id =$expense_id" ;

$qery = mysqli_query( $con , $deleted);

header('location:income.php');

?>