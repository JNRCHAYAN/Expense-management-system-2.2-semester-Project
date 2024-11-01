
<?php
session_start();

?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginn.css">
</head>
<body>

<?php
include'dbcon.php';
if(isset($_POST['submit']))
{
$username=$_POST['username'];
$password= $_POST['password'];
$name_search=(select * from registration where username ='$username');
$quary=mysqli_query($con,$name_search);
$name_count=mysqli_num_rows($quary);

if($name_count)
{
   $name_pass =mysql_fetch_assoc($quary);
   $db_pass=$name_pass['password'];

   $pass_decode= password_verify($password, $db_pass);

   if( $pass_decode)
   {

    echo "login successfull";

   }
   else 
   {
    echo "password incurret";
   }
}
else 
{
    echo "invalid username";
}
}

?>




    <div class="log">
        <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])?>;" method="post">
            <h1>Login</h1>

            <label for="">Username</label>
            <br>
            <input type="text" name="username"placeholder="">
            <br>

            <label for="">Password</label>
            <br>
            <input type="text" name="password" id="" placeholder="">
            <br>
        
        <label for=""><input type="checkbox">Remember me</label>
        <br>
        <button type="submit" name="submit">LOGIN</button>
            <br>
        </form>
    </div> 
</body>
</html>