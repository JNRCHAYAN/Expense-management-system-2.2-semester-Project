<?php
include 'dbcon.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
$u = $_SESSION['user_id'];

$error = "";

// Insert Income
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = $u;
    if($amount>0)
    {
        $setvalue_db = "INSERT INTO `income`(`user_id`, `DATE`, `category`, `amount`) 
                    VALUES ('$userid', '$date', '$category', '$amount')";

    $res = mysqli_query($con, $setvalue_db);

    if ($res) {
        header('location:income.php');
        exit;
    } 
    }
    else
    {
        $error= "Please put Amount is greater then 0";
    }


    // Insert data into the database
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Overview</title>
    <link rel="stylesheet" href="./CSS/income_up_a.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
            <li><a href="home.php"><span class="icon"> 🏠</span> Home</a></li>
                <li><a href="income.php"  class="active"><span class="icon">💰</span> Income</a></li>
                <li><a href="Expanse.php"><span class="icon">📊</span> Expenses</a></li>
                <li><a href="saving.php"><span class="icon">💲</span> Savings</a></li>
                <li><a href="loan.php"><span class="icon">💵</span> Loan</a></li>
                <li><a href="investment.php"><span class="icon">💱</span> Investment</a></li>
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
            <div class="log">
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="add_invest">
            <h2>Add Income</h2>
            <a href="income.php">
                        <button id="backb">
                         Back
                       </button>
                        </a>
                        <br><br>
                <form action="" method="post" class="in_form">
            
                    
                    <form action="" method="post">
                    
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" required>

                    <label for="category">Category</label>
                    <select name="category" id="category">
                        <option value="salary">Salary</option>
                        <option value="house">House Property</option>
                        <option value="business">Business</option>
                        <option value="capital">Capital Gains</option>
                        <option value="other">Others</option>
                    </select>

                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" required>

                    <button type="submit" name="submit" class="btn">Add Income</button>
                </form>
                <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>