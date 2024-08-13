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
        <h3>Login</h3>
        <br>

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>  " method="post">
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
            <div id="checkbox">
            <p>Remember Me</p>
            <input type="checkbox" name= "rememberme" > 
            </div>
            <div>
                <input class="sbtn" type="submit" name="login" value="Login" required>
            </div>
            <p> Not have an account?  <a href="signup.php"> Signup Here</a> </p>
        </form>
    </div>
    
</body>
</html>

<!-- Update login system  -->

<?php
include "connection.php";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $username_search =  "SELECT * FROM userlist WHERE username = '$username' " ;
    $query = mysqli_query($con, $username_search);

    $username_count = mysqli_num_rows($query);

   if($username_count) {
     $user_pass = mysqli_fetch_assoc($query);   // password find on database
     $db_pass = $user_pass['password'];   //password get and store a variable 

     $_SESSION['email']= $user_pass['email'];   // Others Information pass on this home page 
     $_SESSION['name']= $user_pass['name'];   // Others Information pass on this home page 

     $pass_decode = password_verify($pass,$db_pass);
     if($pass_decode)
     {
        if(isset($_POST['rememberme']))
        {
            header("Location: home.php"); 
            setcookie('emailco',$username,time()+86400);
            setcookie('passcp',$pass,time()+86400);
        }
       else
       {
          header("Location: home.php"); 
       }
       
        // ?>
        // <script> 
        //     location.replace("home.php");
        // </script>
        // <?php
     }
     else
     {
        echo "Wrong password";
     }
   }
   else
   {
    echo "Wrong Username";
   }

}
?>

<!-- Old Login system  -->

<!-- <?php

include "connection.php";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM userlist WHERE username = '$username' " ;
    $result = mysqli_query($con, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $hashedPassword = $row['password'];
        if($hashedPassword == $pass)
        {
            $_SESSION['user_id'] = $row['user_id'];
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

?> -->