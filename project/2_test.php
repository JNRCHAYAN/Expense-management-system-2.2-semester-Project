<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
include 'connect.php';
$user_id = $_SESSION['user_id'];
// $n = $_SESSION['username'];

        $showQuree = "select * from users where user_id = {$user_id} ";
        $showdata = mysqli_query( $con ,$showQuree);
        $arrdata = mysqli_fetch_array($showdata); 

        if(isset($_POST['updatee']))
        {
            $user = $_POST['username'];
            $emai = $_POST['email'];


            $setvalue_DB= "UPDATE `users` SET `username`='$user ' ,`email`='$emai' WHERE `user_id`=$user_id";

            // $setvalue_DB= "UPDATE `invest` SET `amount`='$amount',`BankName`='$Bank_name',`Interest`='$rate',`Invest_Start`='$s_date',`Total_Years`='$year' WHERE `invest_id` = '$s_id'";

            $res = mysqli_query($con ,  $setvalue_DB);
            if ($res) {
                echo "<script>alert('Data stored successfully');</script>";
                header('location:profile_Edit.php');
                exit;
            } else {
                echo "<script>alert('Failed to store data');</script>";
            }
            }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Overview</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
                <li><a href="#"><span class="icon">🏠</span> Home</a></li>
                <li><a href="#"><span class="icon">💰</span> Income</a></li>
                <li><a href="#"><span class="icon">💸</span> Expenses</a></li>
                <li><a href="loan.php"><span class="icon">📊</span> Loan</a></li>
                <li><a href="#"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="main">
        
        <section class="add_invest">
                <div class="in_form" id="formContainer">
    
                <form action="" method="post">
                    

            <h2>Profile Settings</h2>
            <label for="username">Username :</label>
            <input type="text" id="username" name="username" value="<?php echo $arrdata['username']; ?>">
            <label for="email">Eamil :</label>
            <input type="text" id="email" name="email" value="<?php echo $arrdata['email']; ?>">
            <button type="submit" class="btn" name="updatee">Update</button>
        
        </form>
            </div>
            </section>

 

         </div>

        </div>
    </div>
</body>
</html>
