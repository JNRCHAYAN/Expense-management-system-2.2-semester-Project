<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
$u = $_SESSION['user_id'];
$n = $_SESSION['username'];

?>

<?php
include 'connect.php';
if (isset($_POST['month']) && !empty($_POST['month'])) {
    $selectedMonth = $_POST['month'];
    $date = DateTime::createFromFormat('m', $selectedMonth);
    $monthName = $date->format('F');

    $query1 = "SELECT SUM(amount) AS Tincome FROM income WHERE user_id = $u AND MONTH(DATE) = '$selectedMonth'";
    $query1_result = mysqli_query($con, $query1);
    $res1 = mysqli_fetch_array($query1_result);
    $income = $res1['Tincome'];

    $query2 = "SELECT SUM(amount) AS Texpenses FROM expenses WHERE user_id = $u AND MONTH(expense_date) = '$selectedMonth'";
    $qery2 = mysqli_query( $con , $query2);
    $res2 = mysqli_fetch_array($qery2);
    $expense = $res2['Texpenses'];

    $query3 = "SELECT SUM(amount) AS Tsaving FROM savings WHERE user_id = $u AND MONTH(date) = '$selectedMonth'";
    $qery3 = mysqli_query( $con , $query3);
    $res3 = mysqli_fetch_array($qery3);
    $saving  = $res3['Tsaving'];

    $query4 = "SELECT SUM(amount) AS Tinvest FROM invest WHERE user_id = $u AND MONTH(Invest_Start) = '$selectedMonth'";
    $qery4 = mysqli_query( $con , $query4);
    $res4 = mysqli_fetch_array($qery4);
    $invest = $res4['Tinvest'];

    $query5 = "SELECT SUM(amount) AS Tloans FROM loans WHERE user_id = $u AND MONTH(loan_start_date) = '$selectedMonth'";
    $qery5 = mysqli_query( $con , $query5);
    $res5 = mysqli_fetch_array($qery5);
    $loans = $res5['Tloans'];
    
} 

else {
    $currentDate = date('m');
    $date = DateTime::createFromFormat('m', $currentDate);
    $monthName = $date->format('F');
    
    $query1 = "SELECT SUM(amount) AS Tincome FROM income WHERE user_id = $u  AND MONTH(DATE) = $currentDate ; ";
    $qery1 = mysqli_query( $con , $query1);
    $res1 = mysqli_fetch_array($qery1);
    $income = $res1['Tincome'];

    $query2 = "SELECT SUM(amount) AS Texpenses FROM expenses WHERE user_id = $u AND MONTH(expense_date) = $currentDate ;";
    $qery2 = mysqli_query( $con , $query2);
    $res2 = mysqli_fetch_array($qery2);
    $expense = $res2['Texpenses'];

    $query3 = "SELECT SUM(amount) AS Tsaving FROM savings WHERE user_id = $u AND MONTH(DATE) = $currentDate ;";
    $qery3 = mysqli_query( $con , $query3);
    $res3 = mysqli_fetch_array($qery3);
    $saving  = $res3['Tsaving'];

    $query4 = "SELECT SUM(amount) AS Tinvest FROM invest WHERE user_id = $u AND MONTH(Invest_Start) = $currentDate ; ";
    $qery4 = mysqli_query( $con , $query4);
    $res4 = mysqli_fetch_array($qery4);
    $invest = $res4['Tinvest'];

    $query5 = "SELECT SUM(amount) AS Tloans FROM loans WHERE user_id = $u AND MONTH(loan_start_date) = $currentDate ;";
    $qery5 = mysqli_query( $con , $query5);
    $res5 = mysqli_fetch_array($qery5);
    $loans = $res5['Tloans'];
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
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
                <li><a href="Logout.php"><span class="icon">🔒</span> Logout</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
    
            <section>
                <h2 class="head_title">Welcome <?php echo  $n; ?>  to Expanse Management System </h2>
                <h2 class="head_title">Month : <?php echo  $monthName; ?>   </h2>

                <h3>Filter by Month: </h3>
                <br>
                <form method="POST" action="">
                <select id="month-filter" name="month" class="month-dropdown">
                        <option value="">Select</option>
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <input type="submit" value="Filter">
                </form>

                <br>
                <br>
                <br>
                <div class="option_dev">
                    <div class="option_1">
                        <img src="./image/wallet.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $income; ?> Taka</h2>
                        <p>Total Income</p>
                        <br>
                        <a href="income.php" style="text-decoration: none;"><span class="icon"></span><h3 class="btn">Add Income</h3></a>
                        </div>

                        <div class="option_1">
                        <img src="./image/budget.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $expense; ?> Taka</h2>
                        <p>Total Expanse</p>
                        <br>
                        <a href="Expanse.php" style="text-decoration: none;"><span class="icon"></span><h3 class="btn">Add Expanse</h3></a>
                        </div>

                        <div class="option_1">
                        <img src="./image/jar.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $saving ; ?> Taka</h2>
                        <p>Total Savings</p>
                        <br>
                        <a href="saving.php" style="text-decoration: none;"><span class="icon"></span><h3 class="btn">Add Savings</h3></a>
                        </div>

                        <div class="option_1">
                        <img src="./image/invest.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $invest; ?> Taka</h2>
                        <p>Total Invesment</p>
                        <br>
                        <a href="investment.php" style="text-decoration: none;"><span class="icon"></span><h3 class="btn">Add Invesment</h3></a>
                        </div>

                        <div class="option_1">
                        <img src="./image/loan.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $loans; ?> Taka</h2>
                        <p>Total Loan</p>
                        <br>
                        <a href="loan.php" style="text-decoration: none;"><span class="icon"></span><h3 class="btn">Add Loan</h3></a>
                        </div>
                    </div>
                 
            </section>

        </div>


</body>
</html>
