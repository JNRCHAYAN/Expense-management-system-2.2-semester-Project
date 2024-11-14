<?php
include 'connect.php';
if(isset($_POST['submit']))
{
    $amount = $_POST['amount'];
    $Bank_name = $_POST['Bank_name'];
    $rate = $_POST['rate'];
    $s_date = $_POST['s_date'];
    $year = $_POST['year'];
    $user_id = 1;
    $setvalue_db = "INSERT INTO `savings`(`user_id`,`amount`, `bank_name`, `interest_rate`, `invest_start`, `total_years`) 
     VALUES ('$user_id','$amount','$Bank_name','$rate','$s_date','$year'); ";
    $res = mysqli_query($con ,  $setvalue_db);
    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        
        header("Location: " . $_SERVER['PHP_SELF']);
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
    <link rel="stylesheet" href="style.css">
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
                <li><a href="loan.html"><span class="icon">📊</span> Loan</a></li>
                <li><a href="#"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">💵</span> Savings</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
          <?php        
            include 'connect.php';

            $selectquery = "SELECT SUM(amount) AS total FROM savings";

            $qery = mysqli_query( $con , $selectquery);
            $res = mysqli_fetch_array($qery);
            $amount = $res['total'];

            ?>
        
            <section>
                <h2 class="head_title">Investment Overview</h2>
                <div class="option_dev">
                    <div class="option_1">
                        <img src="loan.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $amount; ?> Taka</h2>
                        <p>Invest Amount</p>
                        </div>
                    </div>
                 
            </section>
            

            <section class="add_invest">
                <h2>Add Investment</h2>
                <div class="in_form">
                    <form action="" method="post">
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" placeholder="Amount" required>
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" id="bank_name" name="Bank_name" placeholder="Bank Name" required>
                        <label for="interest_rate">Interest Rate:</label>
                        <input type="number" id="interest_rate" name="rate" placeholder="Interest Rate" required>
                        <label for="start_date">Investment Start Date:</label>
                        <input type="date" id="start_date" name="s_date" required>
                        <label for="total_years">Total Investment Years:</label>
                        <input type="number" id="total_years" name="year" placeholder="Total Years" required>
                        <button type="submit" class="btn" name="submit">Add Investment</button>
                    </form>
                </div>
            </section>
            <h2 class="head_title">My Investment</h2>
         
            <table>
                <thead><tr>
                    <th>Amount</th>
                    <th>Bank Name</th>
                    <th>Interest Rate</th>
                    <th>Investment Start Date</th>
                    <th>Total Investment Years</th>
                    <th colspan="2">Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    include 'connect.php';

                    $selectquery = "Select *from savings order by created_at desc";

                    $qery = mysqli_query( $con, $selectquery);

                    while ($res = mysqli_fetch_array($qery))
                    {
                      ?>      
                        <tr>
                        <td> <?php echo $res['amount']; ?></td>
                        <td> <?php echo $res['bank_name']; ?></td>
                        <td> <?php echo $res['interest_rate']; ?></td>
                        <td> <?php echo $res['invest_start'] ;?></td>
                        <td> <?php echo $res['total_years']; ?></td>
                        <td><button class="btn">Edit</button></td>
                        <td><button class="btn">Delete</button></td>
                     </tr>
                     <?php
                    }
                    ?>
            </tbody>
            </table>


        </div>
    </div>
</body>
</html>
