<?php

include 'dbcon.php';
if(isset($_POST['submit']))
{
   
   
    $username = mysqli_real_escape_string($con, $_POST['username']);
   
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
   


    $pass =password_hash($password, PASSWORD_BCRYPT);
    $emailquary = " select * from registration where email='$email'";
    $quary = mysqli_quary($con, $emailquary );
    $emailcount = mysqli_num_rows($quary );

    if($emailcount>0)
    {
        echo "email already exits";
    }
    
}

?>