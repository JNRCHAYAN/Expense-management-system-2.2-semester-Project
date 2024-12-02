<?php
include 'database.php';
if(isset($_POST['submit']))
{
    $name = ($_POST['name']);
    $address = ($_POST['address']);
    $gender = ($_POST['gender']);
    $occupation = ($_POST['option']);
    $email = ($_POST['email']);


    $q = "INSERT INTO `user`(`name`, `address`, `gender`, `occupation`, `email`) VALUES ('$name','$address','$gender','$occupation','$email') ;";
    
    $run = mysqli_query($con, $q);

    if($run)
    {
        header('location:file.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
</head>
<body>

    <form action="" method="post" class="p-3 m-4">



    <label for="">Name</label>
    <input type="text" name="name" required>
    <br><br>

    <label for="">Email</label>
    <input type="email" name="email" required>
    <br><br>

    <label for="">Address</label>
    <input type="text" name="address" required>
    <br><br>

    <label for="">Gender</label>
    <input type="radio" name="gender" value="Male" required> Male
    <input type="radio" name="gender" value="Female" required> Female
    <input type="radio" name="gender" value="Others" required> Others
    <br><br>

    <label for="">Occupation</label>
    <select name="option" >
    <option value="Office" >Office</option>
    <option value="Doctor">Doctor</option>
    <option value="Teacher">Teacher</option>
    <option value="Student">Student</option>
    </select>
    <br><br>


    <br><br>

    <input type="submit" name="submit" class="btn btn-primary">

    </form>
</body>
</html>