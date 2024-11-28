
<?php
include 'dbcon.php';
if(isset($_POST['submit']))
{
    $uname = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);
    $mobile=$_POST['mobile'];
    $emailquery="select * from users where email='$email'";
    $equery = mysqli_query($con,$emailquery);
    $emailcount= mysqli_num_rows($equery);

    if($emailcount > 0)
    {
        echo "email already exixts";
    }
    else
    {
        if($password === $cpassword)
        {
            $setvalue_db = "INSERT INTO `users` (`username`, `password`, `email`,`mobile_number`)
             VALUES ('$uname','$pass','$email','$mobile');";

            $iquery = mysqli_query($con,$setvalue_db);
           
                if($iquery)
                {
                    ?>
                    <script>
                        alert('Data insert');
                    </script>
                    <?php
                }
                else
                {
                    ?>
                    <script>
                        alert('not insert');
                    </script>
                    <?php
                }  
            
        }
        else{
            echo "password are not matchine";
        }
    }
}

//    $setvalue_db = "INSERT INTO `users` (`username`, `password`, `email`,`mobile_number`) 
//     VALUES ('$uname','$pass','$email','$mobile');";

//     $res = mysqli_query($con,$setvalue_db);

//     if($res)
//     {
//         ?>
//         <script>
//             alert('Data store');
//         </script>
//         <?php
//     }
//     else
//     {
//         ?>
//         <script>
//             alert('Not Store');
//         </script>
//         <?php
//     }

  
// //     if(filter_var($email,FILTER_VALIDATE_EMAIL))
// // {
// //  echo "email is valid"; 

// // }
// // else
// // {
// //      echo "Unvalid email";
  
// // }


// }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">

    
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
        <label for="">Repate password</label>
        <br>
        <input type="password" name="cpassword" required>
        <br>
        <label for="">Mobile_number</label>
        <br>
        <input type="number" name="mobile" required>
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
  