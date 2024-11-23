<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
$u = $_SESSION['user_id'];
?>

<?php
include 'connect.php';
if(isset($_POST['submit']))
{
    
    $amount = $_POST['amount'];
    $Bank_name = $_POST['Bank_name'];
    $rate = $_POST['rate'];
    $s_date = $_POST['s_date'];
    $e_date = $_POST['e-date'];
    $user_id = $u;
    $setvalue_db = "INSERT INTO `loans`(`user_id`,`amount`, `BankName`, `interest_rate`, `loan_start_date`, `loan_end_date`) 
     VALUES ('$user_id','$amount','$Bank_name','$rate','$s_date','$e_date'); ";
    $res = mysqli_query($con ,  $setvalue_db);
    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        header("Location: " .$_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<script>alert('Failed to store data');</script>";
    }
}
    $selectquery = "SELECT SUM(amount) AS total FROM loans WHERE user_id = $u";
    $qery = mysqli_query( $con , $selectquery);
    $res = mysqli_fetch_array($qery);
    $amount = $res['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
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
                <li><a href="report.php"><span class="icon">💱</span> Report</a></li>
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
                <li><a href="Logout.php"><span class="icon">🔒</span> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
    
            <section>
                <h2 class="head_title">Loan Overview</h2>
                <div class="option_dev">
                    <div class="option_1">
                        <img src="./image/loan.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $amount; ?> Taka</h2>
                        <p>Total Loan</p><br>
                        <a href="loan_Add.php">
                        <button class="btn " id="addRowButton">
                         Add Loan
                       </button>
                        </a>
                        </div>
                    </div>
                 
            </section>

            <section class="add_invest">
            <h2 class="head_title">My Loan</h2>
            <div class="in_form  id="formContainer" >
            <form action="" method="post">
                        <!-- <label for="amount">Search:</label> -->
                        <input type="text" id="amount" name="bank_name" placeholder="Search Your Bank Name" required>
                        <button type="submit" class="add" name="search">Search Your Bank Name</button>
                    </form>
            </div>
            <!-- =========================================== -->
         <table>
             <thead><tr>
                 <th>NO</th>
                 <th>User ID</th>
                 <th>Laon ID</th>
                 <th>Amount</th>
                <th>Bank Name</th>
                <th>Interest Rate</th>
                <th>Loan Start Date</th>
                <th>Loan End Date</th>
                <th >Operation</th>
                 <th colspan="2">Operation</th>
             </tr>
         </thead>
         <tbody>
             <?php

                 include 'connect.php';
                    
                 $selectquery = "SELECT * FROM loans WHERE user_id = $u ORDER BY created_at DESC;";

                 $qery = mysqli_query( $con, $selectquery);
                 $coutt=0;
                 while ($res = mysqli_fetch_array($qery))
                 {
                    $coutt +=1;
                   ?>      
                     <tr>
                     <td> <?php echo $coutt; ?></td>
                     <td> <?php echo $_SESSION['user_id'] ; ?></td>
                     <td> <?php echo $res['loan_id']; ?></td>
                     <td> <?php echo $res['amount']; ?></td>
                        <td> <?php echo $res['BankName']; ?></td>
                        <td> <?php echo $res['interest_rate']; ?></td>
                     <td> <?php echo date("F, Y", strtotime($res['loan_start_date'])); ?></td>
                     <td> <?php echo date("F, Y", strtotime($res['loan_end_date'])); ?></td>
                     <td> <a href="Up_Loan.php?loan_id=<?php echo $res['loan_id'] ?>"> <button class="btn">EDIT</button> </a> </td>
                     <td> <a href="Delete_Loan.php?loan_id=<?php echo $res['loan_id'] ?>"> <button class="btn">Delete</button> </a> </td>
                  </tr>

                  <?php
                 }
                 ?>
         </tbody>
         </table>
        </section>

        <!-- ====================================== -->
       
    </div>
</body>
</html>
