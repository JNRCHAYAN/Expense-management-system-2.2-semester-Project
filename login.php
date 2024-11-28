<?php
session_start();

if (isset($_GET['message']) && $_GET['message'] === 'success') {
    $mess = "<h2>Registration Successfull.</h2> "; 
    // echo "<p class='success-message'>Your registration is complete. Please log in.</p>";
}
else
{
    $mess = "";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link rel="stylesheet" href="./CSS/loginn.css">
</head>
<body>

<?php
include 'dbcon.php';

$error = ""; 

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $name_search = "SELECT * FROM `users` WHERE `username` = '$username'";
    $query = mysqli_query($con, $name_search);
    $name_count = mysqli_num_rows($query);

    if ($name_count) {
        $name_pass = mysqli_fetch_assoc($query);
        $db_pass = $name_pass['PASSWORD'];

        $pass_decode = password_verify($password, $db_pass);

        if ($pass_decode) {
            $_SESSION['user_id'] = $name_pass['user_id'];
            $_SESSION['username'] = $name_pass['username'];
            header("Location: home.php"); 
            exit();
        } else {
            $error = "Incorrect password"; 
        }
    } else {
        $error = "Invalid username"; 
    }
}
?>

<div class="log">
    <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <?php if ($mess): ?>
            <div class="messasge"><?php echo $mess; ?></div>
        <?php endif; ?>
        <br>
        <h1>Login</h1>

        <label for="username">Username</label>
        <br>
        <input type="text" name="username" placeholder="">
        <br>

        <label for="password">Password</label>
        <br>
        <input type="password" name="password" placeholder="">
 
        <button type="submit" name="submit">LOGIN</button>
        <br>
        <br>
        <br>
        <p>Create account <a href="signup.php">SignUp Here</a></p>

            <br>
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
