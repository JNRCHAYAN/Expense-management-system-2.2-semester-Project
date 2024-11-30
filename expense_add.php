<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
$u = $_SESSION['user_id'];

// Insert expense
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = $u;

    // Insert data into the database
    $setvalue_db = "INSERT INTO `expenses`(`user_id`, `expense_date`, `category`, `amount`) 
                    VALUES ('$userid', '$date', '$category', '$amount')";

    $res = mysqli_query($con, $setvalue_db);

    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        header('location:Expanse.php');
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
    <title>Expense Overview</title>
    <link rel="stylesheet" href="./CSS/income_up_a.css">
</head>
<body>
    <div class="container">

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
            <div class="add_invest">
            <h2>Add Expense</h2>
            <a href="Expanse.php"><button id="backb"> Back</button></a>
                        <br><br>
                <form action="" method="post" class="in_form">
            
                    
                    <form action="" method="post">
                    
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" required>

                    <label for="category">Category</label>
                    <select name="category" id="category">
                                    <option value="All">All categories</option>
                                    <option value="Housing">Housing</option>
                                    <option value="Food">Food</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Health">Health</option>
                                    <option value="Education">Education</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Clothing">Clothing</option>
                                    <option value="Others">Others</option>
                    </select>

                    <label for="amount">Amount</label>
                    <input type="number" name="amount" id="amount" required>

                    <button type="submit" name="submit" class="btn">Add Expense</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>