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

        <form action="home.php" method="post">
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
                <input class="sbtn" type="submit" name="signup" value="Login" required>
            </div>
        <br>
        <br>
            <p>Create an account  <a href="signup.php"> Signup Here</a> </p>

        </form>



    </div>
</body>
</html>

<?php

include "connection.php";



?>