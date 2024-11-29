<?php
include 'database.php';

// Insert expense
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = 1;

    // Insert data into the database
    $setvalue_db = "INSERT INTO `expenses`(`user_id`, `expense_date`, `category`, `amount`) 
                    VALUES ('$userid', '$date', '$category', '$amount')";

    $res = mysqli_query($con, $setvalue_db);

    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        header('location:expense.php');
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
    <link rel="stylesheet" href="sty.css">
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
                <li><a href="#"><span class="icon">🏠</span> <span>Home</span></a></li>
                <li><a href="#" class="active"><span class="icon">💰</span> <span>Income</span></a></li>
                <li><a href="#"><span class="icon">💸</span> <span>Expenses</span></a></li>
                <li><a href="#"><span class="icon">📊</span> <span>Loan</span></a></li>
                <li><a href="#"><span class="icon">💼</span> <span>Investment</span></a></li>
                <li><a href="#"><span class="icon">💵</span> <span>Savings</span></a></li>
                <li><a href="#"><span class="icon">🔒</span> <span>Profile</span></a></li>
                <li><a href="#"><span class="icon">⚙️</span> <span>Settings</span></a></li>
                <div class="log"><a href="logout.php">Logout</a>
            </div>
            </ul>
           
        </div>

        <!-- Main Content -->
        <div class="main">
            <div class="add_invest">
            <h2>Add Income</h2>
            <a href="expense.php"><button id="backb"> Back</button></a>
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
