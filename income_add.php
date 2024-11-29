<?php
include 'dbcon.php';

// Insert Income
if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = 1;

    // Insert data into the database
    $setvalue_db = "INSERT INTO `income`(`user_id`, `DATE`, `category`, `amount`) 
                    VALUES ('$userid', '$date', '$category', '$amount')";

    $res = mysqli_query($con, $setvalue_db);

    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        header('location:income.php');
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
    <link rel="stylesheet" href="income.css">
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

                <!--Logout button-->
                <div class="log">
                    <a href="logout.php">Logout</a>
                </div>
            </ul>
        </div>

        <!-- Main content -->
        <div class="main">
        
            <br>
            <div>
                <!-- <button class="btn" onclick="showForm()">Click here to Add Income</button>
                <section class="add_income">
                    <div class="in_form form-container" id="formContainer"> -->
                        <form action="" method="post">
                            <h2>Add Income</h2>
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
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script>
        function showForm() {
            document.getElementById("formContainer").style.display = "block";
        }
    </script>
</body>
</html>
