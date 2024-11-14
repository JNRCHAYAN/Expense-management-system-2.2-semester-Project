<?php
include 'connect.php';
if(isset($_POST['submit']))
{
    $amount = $_POST['amount'];
    $Bank_name = $_POST['Bank_name'];
    $rate = $_POST['rate'];
    $s_date = $_POST['s_date'];
    $e_date = $_POST['e-date'];
    $user_id = 1;
    $setvalue_db = "INSERT INTO `loans`(`user_id`,`amount`, `BankName`, 
    `interest_rate`, `loan_start_date`, `loan_end_date`) 
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
                <li><a href="#"><span class="icon">🏠</span> Home</a></li>
                <li><a href="#"><span class="icon">💰</span> Income</a></li>
                <li><a href="#"><span class="icon">💸</span> Expenses</a></li>
                <li><a href="#"><span class="icon">📊</span> Loan</a></li>
                <li><a href="index.html"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">💵</span> Savings</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>

        <div class="main">
            <section>
                <h2 class="head_title">Loan Overview</h2>
                <div class="option_dev">
                    <div class="option_1">
                        <img src="loan.png" alt="Loan Icon" class="Op_image">
                        <h2>10</h2>
                        <p>Total Active Loan</p>
                    </div>
                    <div class="option_1">
                        <img src="loan.png" alt="Balance Icon" class="Op_image">
                        <h2>10,000 <span>&#2547;</span></h2>
                        <p>Total Balance of Loan</p>
                    </div>
                    <div class="option_1">
                        <img src="loan.png" alt="Paid Icon" class="Op_image">
                        <h2>10,000 <span>&#2547;</span></h2>
                        <p>Total Amount of Loan Paid</p>
                    </div>
                    <div class="option_1">
                        <img src="loan.png" alt="Overdue Icon" class="Op_image">
                        <h2>10,000 <span>&#2547;</span></h2>
                        <p>Total Amount of Loan Overdue</p>
                    </div>
                    <div class="option_1">
                        <img src="loan.png" alt="Next Payment Icon" class="Op_image">
                        <h2>1,200 <span>&#2547;</span></h2>
                        <p>Next Payment Amount</p>
                    </div>
                </div>
            </section>
            <section class="add_invest">
                <h2>Add Loan</h2>
                <div class="in_form">
                    <form action="" method="post">
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" placeholder="Amount" name="amount" required>
                        
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" id="bank_name" placeholder="Bank Name" name="Bank_name" required>
                        
                        <label for="interest_rate">Interest Rate:</label>
                        <input type="text" id="interest_rate" placeholder="Interest Rate" name="rate" required>
                        
                        <label for="start_date">Loan Start Date:</label>
                        <input type="date" id="start_date" name="s_date" required>
                        
                        <label for="end_date">Loan End Date:</label>
                        <input type="date" id="end_date" name="e-date" required>

                        <button name="submit" type="submit" class="btn">Add Loan</button>
                    </form>
                </div>
            </section>
        </div>
  


</body>
</html>
