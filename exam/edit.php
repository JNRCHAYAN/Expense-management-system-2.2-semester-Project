<?php

include 'connect.php';
$idd = $_GET['id'];

$show = "SELECT *FROM `student` WHERE id= $idd" ;
$que = mysqli_query($con,$show);
$data = mysqli_fetch_array($que);


if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $email = $_POST['email'];

    $q = "INSERT INTO `student`(`name`, `address`, `gender`, `occupation`, `email`) VALUES ('$name','$address','$gender','$occupation','$email')";
    $q = "UPDATE `student` SET `name`='$name',`address`='$address',`gender`='$gender',`occupation`='$occupation',`email`='$email' WHERE id = $idd";
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
        <input type="text" name="name" value="<?php echo $data['name'] ?>" required>
        <br><br>

        <label for="">Address</label>
        <textarea name="address" id="address" rows="4" cols="50" required><?php echo $data['address']?></textarea>
        <br><br>

        <label for="">Gender</label>
        <input type="radio" name="gender" value="Male" <?php if($data['gender'] == 'Male') echo 'checked'; ?> required>Male
        <input type="radio" name="gender" value="Female" <?php if($data['gender'] == 'Female') echo 'checked'; ?>  required>Female
        <input type="radio" name="gender" value="Others"  <?php if($data['gender'] == 'Others') echo 'checked'; ?> required>Others
        <br><br>

        <label for="">Occupation</label>
        <select name="occupation" id="">
            <option value="Doctor"   <?php if($data['occupation'] == 'Doctor') echo 'selected'; ?> >Doctor</option>
            <option value="Engineer" <?php if($data['occupation'] == 'Engineer') echo 'selected'; ?>>Engineer</option>
            <option value="Teacher" <?php if($data['occupation'] == 'Teacher') echo 'selected'; ?> >Teacher</option>
            <option value="Banker" <?php if($data['occupation'] == 'Banker') echo 'selected'; ?> >Banker</option>
            <option value="Others" <?php if($data['occupation'] == 'Others') echo 'selected'; ?> >Others</option>
        </select>
    
        <br><br>

        <label for="">Email</label>
        <input type="email" name="email" value="<?php echo $data['email']?>" required>
        <br><br>

        <input type="submit" name="submit" class="btn btn-primary p-2 m-2">

    </form>
    
</body>
</html>