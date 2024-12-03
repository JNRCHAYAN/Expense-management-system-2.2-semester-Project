<?php
include 'connect.php';
$idd = $_GET['id'];

$q = "DELETE FROM `product` WHERE id = $idd";
$run = mysqli_query($con,$q);
if($run)
{
    header('location:index.php');
}
?>