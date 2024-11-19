<?php
include 'dbcon.php';
$setv="SELECT SUM(amount) AS 'Amount' FROM expenses WHERE MONTH(created_at) =  MONTH(expense_date)";
$ress = mysqli_query($con, $setv);
$fach = mysqli_fetch_array($ress);
$sett = $fach['Amount']; 

$setv="SELECT SUM(amount) AS 'income_amount' FROM income WHERE MONTH(created_at) =  MONTH(DATE)";
$res = mysqli_query($con, $setv);
$income = mysqli_fetch_array($res);
$a_income = $income['income_amount']; 

$setv="SELECT SUM(amount) AS 'save_amount' FROM savings";
$re = mysqli_query($con, $setv);
$save = mysqli_fetch_array($re);
$save_amount = $save['save_amount']; 





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
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
                <li><a href="#"><span class="icon">🏠</span> Home</a></li>
                <li><a href="#"><span class="icon">💰</span> Income</a></li>
                <li><a href="#"><span class="icon">💸</span> Expenses</a></li>
                <li><a href="#"><span class="icon">📊</span> Loan</a></li>
                <li><a href="#"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">💵</span> Savings</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>

        <div class="main">
            <div class="head">
                <h1>Dashboard</h1>
            </div>

            <div class="section">
                <h3>Overview</h3>
                <div style="display: flex; justify-content: center;">
                    <div class="box income">
                        <h3>Income</h3>
                        <p><?php echo $a_income ?> TK</p>

                    </div>
                    <div class="box expense">
                        <h3>Expense</h3>
                        <p><?php echo $sett ?> TK</p>
                    </div>
                    <div class="box expense">
                        <h3>Savings</h3>
                        <p><?php echo $save_amounts ?> TK</p>
                      
                    </div>
                    <div class="box expense">
                        <h3>Loan</h3>
                    </div>
                </div>
            </div>

            

</body>
</html>
