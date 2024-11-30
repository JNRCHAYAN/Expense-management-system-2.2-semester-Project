<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
include 'connect.php';
$u = $_SESSION['user_id'];

        $showQuree = "select * from users where user_id = {$u} ";
        $showdata = mysqli_query( $con ,$showQuree);
        $arrdata = mysqli_fetch_array($showdata); 

        if(isset($_POST['updatee']))
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $mobile_nmber = $_POST['mobile_number'];


            $setvalue_DB= "UPDATE `users` SET `username`='$username' ,`email`='$email' , `mobile_number`='$mobile_nmber' where user_id = {$u} ";

                
            $res = mysqli_query($con ,  $setvalue_DB);
            if ($res) {
                ?>
                <script>
                    alert('Update Successful');
                    header('location:profile_Edit.php');
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert('Can not Update');
                    header('location:profile_Edit.php');
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
            <li><a href="home.php"><span class="icon"> 🏠</span> Home</a></li>
                <li><a href="income.php"><span class="icon">💰</span> Income</a></li>
                <li><a href="Expanse.php"><span class="icon">📊</span> Expenses</a></li>
                <li><a href="saving.php"><span class="icon">💲</span> Savings</a></li>
                <li><a href="loan.php"><span class="icon">💵</span> Loan</a></li>
                <li><a href="investment.php"><span class="icon">💱</span> Investment</a></li>
                <li><a href="profile_Edit.php"  class="active"><span class="icon">⚙️</span> Settings</a></li>
                <div class="log"><a href="logout.php">Logout</a></div>
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
            <label for="phone">Phone :</label>
            <input type="text" id="email" name="mobile_number" value="<?php echo $arrdata['mobile_number']; ?>">
            <button type="submit" class="btn" name="updatee">Update</button>

        
        </form>
            </div>
            </section>

 

         </div>

        </div>
    </div>
</body>
</html>
