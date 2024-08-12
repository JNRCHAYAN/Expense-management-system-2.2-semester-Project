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

<!-- Update login system  -->

<?php
include "connection.php";

if(isset($_POST['login']))
{
    $username = $_POST['username'];
    $pass = $_POST['password'];
}

?>



    <div class="mainbox">
        <h3>Login</h3>
        <br>

        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
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
            <p> Not have an account?  <a href="signup.php"> Signup Here</a> </p>
        </form>
    </div>
</body>
</html>








<!-- Old Login system  -->
<!-- 
<?php

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