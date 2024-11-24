<?php
include 'connect.php';

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = 1;

    $setvalue="INSERT INTO `expenses` (`user_id`, `category`, `amount`, `expense_date`) 
    VALUES ('$userid','$category','$amount','$date')";

    $res = mysqli_query($con,$setvalue);

    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        
        // Redirect to avoid duplicate data on page reload
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<script>alert('Failed to store data');</script>";
    }
}

        $setvalue="SELECT SUM(amount) AS 'Total' FROM income WHERE MONTH(created_at) =  MONTH(DATE)";
        $res = mysqli_query($con, $setvalue);
        $fetch = mysqli_fetch_array($res);
        $set=$fetch['Total']; 
        
        $setvariable="SELECT SUM(amount) AS 'Total_Expenses' FROM expenses WHERE MONTH(created_at) =  MONTH(expense_date)";
        $val = mysqli_query($con, $setvariable);
        $value = mysqli_fetch_array($val);
        $sets=$value['Total_Expenses']; 
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
    <link rel="stylesheet" href="./CSS/expense.css">
    <link rel="stylesheet" href="./CSS/pic.css">
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

        <div class="main">
            <div class="head">
                <h1>Expenses</h1>
            </div>

            <div class="section">
                <h3>Overview</h3>
                <div style="display: flex; justify-content: center;">
                    <div class="box income">
                        <h3>Income</h3>
                      <p><?php echo $set?>TK </p>
                    </div>
                    <div class="box expense">
                        <h3>Expense</h3>
                        <p><?php echo $sets ?> TK</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>My Expense</h3>
                <div class="my-income-card">

                    <form action="" method="post">
                        <h3>Filter Options</h3>
                        <div class="filter-group">
                            <div>
                                <label for="start-date">Start Date</label>
                                <input type="date" name="start" id="start-date">
                            </div>
                            <div>
                                <label for="end-date">End Date</label>
                                <input type="date" name="end" id="end-date">
                            </div>
                            <div>
                                <label for="category-filter">Category</label>
                                <input type="text" name="categoryy" id="end-date">
                            </div>
                        </div>
                        <button class="btn" type="submit" name="s">Filter</button>   
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th colspan="2">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['s'])) {
                                $Sdate = $_POST['start'];
                                $Edate = $_POST['end'];
                                $category = $_POST['categoryy'];
                                $userid = 1;

                                $selectquery = "SELECT * FROM expenses WHERE user_id = $userid AND expense_date BETWEEN '$Sdate' AND '$Edate' 
                                AND category = '$category'";
                                $qery = mysqli_query($con, $selectquery);

                                if (!$qery) {
                                    die("Query Failed: " . mysqli_error($con));
                                }

                                if (mysqli_num_rows($qery) > 0) {
                                    while ($res = mysqli_fetch_array($qery)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $res['expense_date']; ?></td>
                                            <td><?php echo $res['category']; ?></td>
                                            <td><?php echo $res['amount']; ?> Taka</td>
                                            <td><button class="btn">Edit</button></td>
                                            <td><button class="btn">Delete</button></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found for the selected filter.</td></tr>";
                                }
                            } else {
                                $selectquery = "SELECT * FROM expenses WHERE user_id = 1 ORDER BY created_at DESC";
                                $qery = mysqli_query($con, $selectquery);

                                while ($res = mysqli_fetch_array($qery)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $res['expense_date']; ?></td>
                                        <td><?php echo $res['category']; ?></td>
                                        <td><?php echo $res['amount']; ?> Taka</td>
                                        <td> <a href="delete_expense.php?expense_id=<?php echo $res['expense_id'] ?>"> 
                                            <button class="btn">Delete</button> </a> </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="section">
                <div class="section-item">
                    <h2>Add Expense</h2>
                    <form action="" method="post">
                        <div>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" required>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" required>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" required>
                        </div>
                        <button class="btn" type="submit" name="submit">Add Expense</button>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</body>
</html>