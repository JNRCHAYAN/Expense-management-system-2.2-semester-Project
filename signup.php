<?php
session_start();
?>
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
        <h3>Create Account</h3>
        <p>It's free and only takes a minute</p>
<!-- <?php echo htmlentities($_SERVER['PHP_SELF']); ?>   For save our page to hack  -->
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
            <div>
                <label for="Name">Name</label>
                <br>
                <input type="text" name="name" placeholder="Enter Your Name" required>
            </div>
            <div>
                <label for="UserName">User Name</label>
                <br>
                <input type="text" name="username" placeholder="Enter Your UserName" required>
            </div>
            <div>
                <label for="Age">Age</label>
                <br>
                <input type="number" name="age" placeholder="Enter Your Age" required>
            </div>
            <div>
                <label for="phone">Phone</label>
                <br>
                <input type="number" name="phone" placeholder="Enter Your Number" required>
            </div>
            <div>
                <label for="email">Email</label>
                <br>
                <input type="email" name="email" placeholder="Enter Your Email" required>
            </div>
            <div>
                <label for="pasword">Password</label>
                <br> 
                <input type="password" name="password" placeholder="Enter Your Password" required> 
            </div>
            <div>
                <input class="sbtn" type="submit" name="signup" value="Signup" required>
            </div>
            <p id="doa">Already have an account? <a href="login.php">Login Here</a> </p>

        </form>
    </div>
</body>
</html>

        <?php

        include "connection.php";

        if(isset($_POST['signup']))
        {
            $name = $_POST['name'];
            $username = $_POST['username'];
            $age = $_POST['age'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            // Use Password encryption 
            $password_sq = password_hash($password, PASSWORD_BCRYPT);  

            $Store_DB = " INSERT INTO `userlist`( `name`, `username`, `age`, `phone`, `email`, `password`) 
            VALUES ('$name','$username','$age',' $phone','$email','$password_sq') ";

            $st = mysqli_query( $con , $Store_DB);
            if($st)
            {
                header('location:login.php');
            }
            else
            {
                print "<h5>Change Your User Name or Email </h5>";  
            }

        }

        ?>
