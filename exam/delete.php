<?php
include 'database.php';

$id = $_GET['id'];

$q = "DELETE FROM `user` WHERE ID = '$id' ;";

$run = mysqli_query($con,$q);

header('location:file.php');

?>