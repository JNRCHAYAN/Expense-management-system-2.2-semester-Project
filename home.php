<?php
include 'connect.php';  // Database connection file
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}

$user_name = $_SESSION['username'];
$user = $_SESSION['user_id']; // User ID from session

// Handle filters for month and year
$month = isset($_GET['month']) && $_GET['month'] !== '' ? $_GET['month'] : 'all';
$year = isset($_GET['year']) && $_GET['year'] !== '' ? $_GET['year'] : 'all';

// Function to calculate total amount for any given query
function getTotalAmount($query, $con)
{
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'] ?? 0;
}

// Sanitize inputs
$month = mysqli_real_escape_string($con, $month);
$year = mysqli_real_escape_string($con, $year);

// Queries for income, expenses, savings, loans, and investments
$incomeQuery = "SELECT SUM(amount) AS total FROM income WHERE user_id = '$user' ";
if ($month !== 'all') {
    $incomeQuery .= "AND MONTH(DATE) = '$month' ";
}
if ($year !== 'all') {
    $incomeQuery .= "AND YEAR(DATE) = '$year' ";
}
$incomeTotal = getTotalAmount($incomeQuery, $con);

$expenseQuery = "SELECT SUM(amount) AS total FROM expenses WHERE user_id = '$user' ";
if ($month !== 'all') {
    $expenseQuery .= "AND MONTH(expense_date) = '$month' ";
}
if ($year !== 'all') {
    $expenseQuery .= "AND YEAR(expense_date) = '$year' ";
}
$expenseTotal = getTotalAmount($expenseQuery, $con);

$savingsQuery = "SELECT SUM(amount) AS total FROM savings WHERE user_id = '$user' ";
if ($month !== 'all') {
    $savingsQuery .= "AND MONTH(date) = '$month' ";
}
if ($year !== 'all') {
    $savingsQuery .= "AND YEAR(date) = '$year' ";
}
$savingsTotal = getTotalAmount($savingsQuery, $con);

$loansQuery = "SELECT SUM(amount) AS total FROM loans WHERE user_id = '$user' ";
if ($month !== 'all') {
    $loansQuery .= "AND MONTH(loan_start_date) = '$month' ";
}
if ($year !== 'all') {
    $loansQuery .= "AND YEAR(loan_start_date) = '$year' ";
}
$loansTotal = getTotalAmount($loansQuery, $con);

$investQuery = "SELECT SUM(amount) AS total FROM invest WHERE user_id = '$user' ";
if ($month !== 'all') {
    $investQuery .= "AND MONTH(Invest_Start) = '$month' ";
}
if ($year !== 'all') {
    $investQuery .= "AND YEAR(Invest_Start) = '$year' ";
}
$investTotal = getTotalAmount($investQuery, $con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management</title>
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Lavishly+Yours&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>

<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
            <li><a href="home.php"><span class="icon"> 🏠</span> Home</a></li>
                <li><a href="income.php"><span class="icon">💰</span> Income</a></li>
                <li><a href="Expanse.php"  class="active"><span class="icon">📊</span> Expenses</a></li>
                <li><a href="saving.php"><span class="icon">💲</span> Savings</a></li>
                <li><a href="loan.php"><span class="icon">💵</span> Loan</a></li>
                <li><a href="investment.php"><span class="icon">💱</span> Investment</a></li>
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
                <div class="log"><a href="logout.php">Logout</a></div>
            </ul>
            
        </div>

        <!-- Main Content -->
        <div class="main">
            <section>
                <header>
                    <!-- date range -->
                    <div class="col">
                        <div class="app-card app-card-stat shadow-sm h-100">
                            <div class="app-card-body p-3 p-lg-4">
                                <!-- <h2 class="head_title">Welcome <?php //echo $user_name; ?> </h2> -->
                                <img src="./image/welcome.png" alt="Icon" class="Op_image_welcome">
                                <h2>Dashboard</h2>
                                <p>
                                    <?php
                                    if ($month === "all" && $year === "all") {
                                        echo "Here are the total finances over the years";
                                    } elseif ($month === "all") {
                                        echo "All Months in $year";
                                    } elseif ($year === "all") {
                                        echo DateTime::createFromFormat('!m', $month)->format('F') . " (All Years)";
                                    } else {
                                        echo DateTime::createFromFormat('!m', $month)->format('F') . " $year";
                                    }
                                    ?>
                                </p>

                            </div><!--//app-card-body-->
                        </div><!--//app-card-->
                    </div><!--//col-->
                </header>

                <div class="filter-container">
                    <form class="filter-form" method="GET">
                        <div class="filter-item">
                            <label for="month">Month</label>
                            <select name="month" id="month-filter" class="month-dropdown">
                                <option value="">Select</option>

                                <?php
                                for ($m = 1; $m <= 12; $m++) {
                                    $monthName = DateTime::createFromFormat('!m', $m)->format('F');
                                    $monthValue = str_pad($m, 2, '0', STR_PAD_LEFT);
                                    echo "<option value='$monthValue' " . (($month == $monthValue) ? 'selected' : '') . ">$monthName</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="filter-item">
                            <label for="year">Year</label>
                            <select name="year" id="year-filter" class="year-dropdown">
                                <option value="">Select</option>

                                <?php
                                $startYear = 2019;
                                $endYear = date('Y') + 6;
                                for ($y = $startYear; $y <= $endYear; $y++) {
                                    echo "<option value='$y' " . (($year == $y) ? 'selected' : '') . ">$y</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="filter-item">
                            <button type="submit" class="filter-btn">Filter</button>
                        </div>
                    </form>
                </div>



                <!-- Displaying the Results -->
                <div class="option_dev">
                    <div class="option_1">
                        <img src="./image/wallet.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo $incomeTotal; ?> Taka</h2>
                        <p>Total Income</p>
                        <footer class="add">
                            <a href="income.php" style="text-decoration: none;">
                                <h3 class="btn">Add Income</h3>
                            </a>
                        </footer>
                        <br>
                        <footer class="add">
                            <a href="Income_report.php" style="text-decoration: none;">
                                <h3 class="btn">Income Report</h3>
                            </a>
                        </footer>
                    </div>

                    <div class="option_1">
                        <img src="./image/budget.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo $expenseTotal; ?> Taka</h2>
                        <p>Total Expense</p>
                        <footer class="add">
                            <a href="expense.php" style="text-decoration: none;">
                                <h3 class="btn">Add Expense</h3>
                            </a>
                        </footer>
                        <br>
                        <footer class="add">
                            <a href="Expense_report.php" style="text-decoration: none;">
                                <h3 class="btn">Expense Report</h3>
                            </a>
                        </footer>
                    </div>

                    <div class="option_1">
                        <img src="./image/jar.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo $savingsTotal; ?> Taka</h2>
                        <p>Total Savings</p>
                        <footer class="add">
                            <a href="saving.php" style="text-decoration: none;">
                                <h3 class="btn">Add Savings</h3>
                            </a>
                        </footer>
                        <br>
                        <footer class="add">
                            <a href="saving_Report.php" style="text-decoration: none;">
                                <h3 class="btn">Savings Report</h3>
                            </a>
                        </footer>
                    </div>

                    <div class="option_1">
                        <img src="./image/invest.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo $investTotal; ?> Taka</h2>
                        <p>Total Investment</p>
                        <footer class="add">
                            <a href="investment.php" style="text-decoration: none;">
                                <h3 class="btn">Add Investment</h3>
                            </a>
                        </footer>
                        <br>
                        <footer class="add">
                            <a href="invest_Report.php" style="text-decoration: none;">
                                <h3 class="btn">Investment Report</h3>
                            </a>
                        </footer>
                    </div>

                    <div class="option_1">
                        <img src="./image/loan.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo $loansTotal; ?> Taka</h2>
                        <p>Total Loan</p>
                        <footer class="add">
                            <a href="loan.php" style="text-decoration: none;">
                                <h3 class="btn">Add Loan</h3>
                            </a>
                        </footer>
                        <br>
                        <footer class="add">
                            <a href="loan_Report.php" style="text-decoration: none;">
                                <h3 class="btn">Loan Report</h3>
                            </a>
                        </footer>
                    </div>
                </div>

            </section>
            <footer>
                <div class="footer-button">
                    <a href="home.php">Back</a>
                </div>
            </footer>
        </div>

    </div>
</body>

</html>