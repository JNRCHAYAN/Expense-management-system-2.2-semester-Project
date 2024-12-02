<?php

include 'connect.php';

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $email = $_POST['email'];

    $q = "INSERT INTO `student`(`name`, `address`, `gender`, `occupation`, `email`) VALUES ('$name','$address','$gender','$occupation','$email')";
    $run = mysqli_query($con,$q);
    if($run)
    {
        header('location:index.php');
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
</head>
<body>

    <form action="" method="post" class="form p-3 m-3" >

        <label for="">Name</label>
        <input type="text" name="name" required>
        <br><br>

        <label for="">Address</label>
        <textarea name="address" id="address" rows="4" cols="50" placeholder="Enter your address here..." required></textarea>
        <br><br>

        <label for="">Gender</label>
        <input type="radio" name="gender" value="Male" required>Male
        <input type="radio" name="gender" value="Female" required>Female
        <input type="radio" name="gender" value="Others" required>Others
        <br><br>

        <label for="">Occupation</label>
        <select name="occupation" id="">
            <option value="Doctor">Doctor</option>
            <option value="Engineer">Engineer</option>
            <option value="Teacher">Teacher</option>
            <option value="Banker">Banker</option>
            <option value="Others">Others</option>
        </select>
    
        <br><br>

        <label for="">Email</label>
        <input type="email" name="email" required>
        <br><br>

        <input type="submit" name="submit" class="btn btn-primary p-2 m-2">

    </form>
    
</body>
</html>