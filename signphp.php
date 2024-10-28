<?php

include 'dbcon.php';
if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string( $con, $_POST['name']);
   
    $username = mysqli_real_escape_string($con, $_POST['username']);
   
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $date = mysqli_real_escape_string($con,$_POST['birth_date']);
    $adress =mysqli_real_escape_string($con, $_POST['adress']);
    $gender =mysqli_real_escape_string($con, $_POST['gender']);

    $pass =password_hash($password, PASSWORD_BCRYPT);
    $emailquary = " select * from registration where email='$email'";
    $quary = mysqli_quary($con, $emailquary );
    $emailcount = mysqli_num_rows($quary );

    if($emailcount>0)
    {
        echo "email already exits";
    }
    else{
        $insertquary = "insert into registration(id, name, username, email, password, date_of_birth, address, gender, signup, login) values('')"
    }
}

?>