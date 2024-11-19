
<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pass = password_hash($password, PASSWORD_BCRYPT);

   $setvalue_db = "INSERT INTO `users`
   (`username`, `password`, `email`) 
    VALUES ('$uname','$pass','$email'); ";

    $res = mysqli_query($con ,  $setvalue_db);

    if($res)
    {
        ?>
        <script>
            alert('Data store');
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('Not Store');
        </script>
        <?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./CSS/signup.css">

    
</head>
<body>
    
    <div class="sign">

    <form action="" method="post">
    <h1>Sign UP</h1>
    <p>Create your account</p>
        <label for="">Username</label>
        <br>
        <input type="text" name="username" id="" placeholder="" required>
        <br>
        <label for="">Email</label>
        <br>
        <input type="text" name="email" placeholder="" required>
        <br>
        <label for="">Password</label> 
        <br>
        <input type="password" name="password" id="" placeholder="" required>
        <br>
        <input type="submit" class="btn" name="submit"  value="Register"/> 
    <br>
    <button >Login</button>
    <br>
    <p>Already have an account? <a href="login.php">Login Here</a></p>
    </form>
</div>
    
</body>
</html>
  