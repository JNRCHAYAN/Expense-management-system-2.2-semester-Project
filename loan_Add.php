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
        header('Location: loan.php'); 
        // header("Location: " .$_SERVER['PHP_SELF']);
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
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
                <li><a href="Logout.php"><span class="icon">🔒</span> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
    
           

        <!-- ====================================== -->
        <br>
        <div>
        <section class="add_invest">
                
                <div class="in_form " id="formContainer">
                <h2>Add Loan</h2>
                <a href="loan.php">
                        <button id="backb">
                         Back
                       </button>
                        </a>
                        <br><br>
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
                </div>
            </section>

        </div>
    </div>
</body>
</html>
