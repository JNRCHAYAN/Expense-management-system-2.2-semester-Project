<?php
include 'database.php';

$id = $_GET['id'];
$q = "SELECT * FROM  `user` where ID = '$id';";

$run = mysqli_query($con,$q);
$data = mysqli_fetch_array(($run));


if(isset($_POST['submit']))
{
    $name = ($_POST['name']);
    $address = ($_POST['address']);
    $gender = ($_POST['gender']);
    $occupation = ($_POST['option']);
    $email = ($_POST['email']);


    $q = "UPDATE `user` SET `name`='$name',`address`='$address',`gender`='$gender',`occupation`='$occupation',`email`='$email' WHERE ID = '$id';";
    
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
    <input type="text" name="name" value="<?php echo $data['name']; ?>" require>
    <br><br>

    <label for="">Email</label>
    <input type="email" name="email" value="<?php echo $data['email']; ?>" require>
    <br><br>

    <label for="">Address</label>
    <input type="text" name="address" value="<?php echo $data['address']; ?>" require>
    <br><br>

    <label for="">Gender</label>
    <input type="radio" name="gender" value="Male" <?php if($data['gender'] == 'Male') echo 'checked'; ?>> Male
    <input type="radio" name="gender" value="Female" <?php if($data['gender'] == 'Female') echo 'checked'; ?>> Female
    <input type="radio" name="gender" value="Others" <?php if($data['gender'] == 'Others') echo 'checked'; ?>> Others
    <br><br>

    <label for="">Occupation</label>
    <select name="option" >
    <option value="Office" <?php if($data['occupation'] == 'Office') echo 'selected'; ?>>Office</option>
    <option value="Doctor" <?php if($data['occupation'] == 'Doctor') echo 'selected'; ?>>Doctor</option>
    <option value="Teacher" <?php if($data['occupation'] == 'Teacher') echo 'selected'; ?>>Teacher</option>
    <option value="Student" <?php if($data['occupation'] == 'Student') echo 'selected'; ?>>Student</option>
    </select>
    <br><br>


    <br><br>

    <input type="submit" name="submit" class="btn btn-primary">

    </form>
</body>
</html>