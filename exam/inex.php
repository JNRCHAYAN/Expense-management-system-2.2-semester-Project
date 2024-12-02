<?php
include 'database.php';

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $number = $_POST['number'];
  $email = $_POST['Email'];
  $dob = $_POST['dob'];
  $file = $_POST['file'];

  $Q = "INSERT INTO `user`(`name`, `number`, `email`, `dob`, `file`) VALUES ('$name','$number','$email','$dob','$file');";

  $run = mysqli_query($con,$Q);

  

}


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    
</head>
<body>

 <div class="container p-3 m-5">

   <form action="" method="post">

    <label for="">Name : </label>
    <input type="text" placeholder="Enter your name" name="name" required>
    <br>
    <br>
    <label for="">Number : </label>
    <input type="number" placeholder="Enter your number" name="number" required>
    <br>
    <br>
    <label for="">Email : </label>
    <input type="Email" placeholder="Enter your Email" name="Email" required>
    <br>
    <br>
    <label for="">Date of birth : </label>
    <input type="date" placeholder="Enter your date" name="dob">
    <br>
    <br>
    <label for="">File</label>
    <input type="file" name="file"> 
    <br>
    <br>
    <input type="submit" class="btn btn-primary" name="submit" >

   </form>
  </div>

</body>
</html>