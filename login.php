<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <link rel="stylesheet" href="./CSS/singupSt.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
</head>
<body>
    <div class="mainbox">
        <h3>Login</h3>
        <br>

        <form action="#" method="post">
            <div>
                <label for="UserName">User Name</label>
                <br>
                <input type="text" name="username" placeholder="Enter Your UserName" required>
            </div>
            <div>
                <label for="pasword">Password</label>
                <br> 
                <input type="password" name="password" placeholder="Enter Your Password" required> 
            </div>
            <div>
                <input class="sbtn" type="submit" name="login" value="Login" required>
            </div>
            <p>Create an account  <a href="signup.php"> Signup Here</a> </p>
        </form>
    </div>
</body>
</html>


<?php

include "connection.php";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $pass = $_POST['password'];

    // $find =0;
    // // $match = "SELECT * FROM `userlist` WHERE `username` = '$username' and `password`=  $password" ; 
    // $selectquery = "Select * from userlist";

    // $qery = mysqli_query( $con , $selectquery);
    // $num =  mysqli_num_rows($qery);
    // $res = mysqli_fetch_array($qery);

    // while ($num>=0)
    // {
    //     if($res['username'] == $username) 
    //     {
    //         $find = 1;
    //         echo "Data find";
    //     }

    //     $num--;
    // }
  

    $query = "SELECT * FROM userlist WHERE username = '$username' " ;
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        if($hashedPassword == $pass)
        {
            header("Location: home.php");  
        }
        else {
            echo "Invalid password.";
        }
       
    } 
    else {
        echo "User not found.";
    }





}

?>