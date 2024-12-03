<?php
include 'database.php';

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
?>


<?php
include 'database.php';


 
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
    <link rel="stylesheet" href="expense.css">
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
                <li><a href="#"><span class="icon">⚙</span> Settings</a></li>
                <div class="log"><a href="logout.php">Logout</a></div>
            </ul>
        </div>

        <div class="main">
            <div class="head">
                <h1>Expenses</h1>
            </div>

            <div class="section">
                <h3>Overview</h3>
                <div style="display: flex; justify-content: center;">
                    
                    <div class="box expense">
                        <h3>Expense</h3>
                        <p><?php echo $sets ?> TK</p>
                        <a href="expense_add.php">
                            <button class="btn" id="addexpense">Add Expense</button>
                        </a>
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
                            </div>
                        </div>
                        <button class="btn" type="submit" name="s">Filter</button>   
                    </form>

                    <table>
                        <thead>
                            <tr>
                            <th>No</th>
                                <th>Expense ID</th>
                                <th>User ID</th>
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
                                $category = $_POST['category'];
                                $userid = 1;
                                $queryParts = [];

                                if (!empty($Sdate)) {
                                    $queryParts[] = "expense_date >= '$Sdate'";
                                }

                                if (!empty($Edate)) {
                                    $queryParts[] = "expense_date <= '$Edate'";
                                }

                                if ($category !== "all") {
                                    $queryParts[] = "category = '$category'";
                                }

                                $queryCondition = implode(" AND ", $queryParts);
                                $queryCondition = $queryCondition ? "AND $queryCondition" : "";
                                $selectquery = "SELECT * FROM `expenses` WHERE user_id = $userid $queryCondition ORDER BY expense_date DESC";

                                // $selectquery = "SELECT * FROM expenses WHERE user_id = $userid AND expense_date BETWEEN '$Sdate' AND '$Edate' 
                                // AND category = '$category'";
                                $qery = mysqli_query($con, $selectquery);

                                if (!$qery) {
                                    die("Query Failed: " . mysqli_error($con));
                                }

                                if (mysqli_num_rows($qery) > 0) {
                                    $cot=1;
                                    while ($res = mysqli_fetch_array($qery)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cot++; ?></td>
                                            <td><?php echo $res['expense_id']; ?></td>
                                            <td><?php echo $res['user_id']; ?></td>
                                            <td><?php echo $res['expense_date']; ?></td>
                                            <td><?php echo $res['category']; ?></td>
                                            <td><?php echo $res['amount']; ?> Taka</td>
                                            <td><a href="expense_update.php?expense_id=<?php echo $res['expense_id'] ?>"><button class="btn">Update</button></a></td>
                                            <!-- <td><a href="Delete_Income.php?income_id=<?php echo $res['expense_id'] ?>"><button class="btn">Delete</button></a></td> -->

                                            <td>
                                      <a href="delete_expense.php?expense_id=<?php echo $res['expense_id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                            <button class="btn">Delete</button>
                                        </a>
                                    </td>


                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found for the selected filter.</td></tr>";
                                }
                            } else {
                                $selectquery = "SELECT * FROM expenses WHERE user_id = 1 ORDER BY created_at DESC";
                                $qery = mysqli_query($con, $selectquery);
                                $cot=1;

                                while ($res = mysqli_fetch_array($qery)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cot++; ?></td>
                                        <td><?php echo $res['expense_id']; ?></td>
                                        <td><?php echo $res['user_id']; ?></td>
                                        <td><?php echo $res['expense_date']; ?></td>
                                        <td><?php echo $res['category']; ?></td>
                                        <td><?php echo $res['amount']; ?> Taka</td>
                                        <td><a href="expense_update.php?expense_id=<?php echo $res['expense_id'] ?>"><button class="btn">Update</button></a></td>
                                        <!-- <td><a href="Delete_Income.php?income_id=<?php echo $res['expense_id'] ?>"><button class="btn">Delete</button></a></td> -->

                                        <td>
                                       <a href="delete_expense.php?expense_id=<?php echo $res['expense_id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                            <button class="btn">Delete</button>
                                        </a>
                                    </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

           
        </div>
    </div>
</body>
</html>