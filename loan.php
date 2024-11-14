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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <li><a href="investment.php"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>

        <div class="main">
          <?php        
            include 'connect.php';

            $selectquery = "SELECT SUM(amount) AS total FROM loans";

            $qery = mysqli_query( $con , $selectquery);
            $res = mysqli_fetch_array($qery);
            $amount = $res['total'];
            ?>
            <section>
                <h2 class="head_title">Loan Overview</h2>
                <div class="option_dev">
                    <div class="option_1">
                        <img src="loan.png" class="Op_image">
                        <h2><?php echo  $amount; ?> Taka</h2>
                        <p>Total Loan</p>
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
            <h2 class="head_title">My Investment</h2>

            <table>
                <thead><tr>
                    <th>Amount</th>
                    <th>Bank Name</th>
                    <th>Interest Rate</th>
                    <th>Loan Start Date</th>
                    <th>Loan End Date</th>
                    <th >Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    include 'connect.php';

                    $selectquery = "Select *from loans order by created_at desc";

                    $qery = mysqli_query( $con, $selectquery);

                    while ($res = mysqli_fetch_array($qery))
                    {
                      ?>      
                        <tr>
                        <td> <?php echo $res['amount']; ?></td>
                        <td> <?php echo $res['BankName']; ?></td>
                        <td> <?php echo $res['interest_rate']; ?></td>
                        <td> <?php echo $res['loan_start_date'] ;?></td>
                        <td> <?php echo $res['loan_end_date']; ?></td>
                        <td> <a href="Delete_Loan.php?loan_id=<?php echo $res['loan_id'] ?>"> <button class="btn">Delete</button> </a> </td>
                   
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
