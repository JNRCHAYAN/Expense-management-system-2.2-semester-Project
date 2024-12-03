<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
$u = $_SESSION['user_id'];

// =======================================
include 'dbcon.php';
// =======================================
$setvalue = "SELECT SUM(amount) AS 'total' FROM income WHERE user_id = $u  and MONTH(created_at) = MONTH(DATE)" ;
$res = mysqli_query($con, $setvalue);
$fetch = mysqli_fetch_array($res);
$set = $fetch['total'];
?>


<!-- ======================================= -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income Overview</title>
    <link rel="stylesheet" href="./CSS/income.css">
</head>
<body>
    <div class="container">
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
                <div class="log"><a href="logout.php">Logout</a></div>
            </ul>
        </div>

        <div class="main">
            <div class="head">
                <h1>Income Overview</h1>
            </div>

            <div class="option_dev">
                <div style="display: flex; justify-content: center;">
                    <div class="box income option_1">
                        <img src="./image/wallet.png" alt="Paid Icon" class="Op_image">
                        <br>
                        <!-- <h2> <?php echo $set ?> Taka </h2> -->
                        <a href="income_add.php">
                            <button class="btn" id="addincome">Add Income</button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="section">
                <div class="my-income-card">
                    <br>
                    <form action="" method="post">
                        <h3>Filter Options</h3>
                        <div class="filter-group">
                            <div>
                                <label for="start-date">Start Date</label>
                                <input type="date" name="start" id="start-date" required>
                            </div>
                            <div>
                                <label for="end-date">End Date</label>
                                <input type="date" name="end" id="end-date" required>
                            </div>
                            <div>
                                <label for="category">Category</label>
                                <select name="category" id="category" required>
                                    <option value="All">All categories</option>
                                    <option value="Salary">Salary</option>
                                    <option value="House Property">House Property</option>
                                    <option value="Business">Business</option>
                                    <option value="Capital">Capital Gains</option>
                                    <option value="Other">Others</option>
                                </select>
                            </div>
                        </div>
                        <button class="btnn" type="submit" name="s">Filter</button>
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Income ID</th>
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
                                $userid =$u;

                                $queryParts = [];

                                if (!empty($Sdate)) {
                                    $queryParts[] = "DATE >= '$Sdate'";
                                }

                                if (!empty($Edate)) {
                                    $queryParts[] = "DATE <= '$Edate'";
                                }

                                if ($category !== "all") {
                                    $queryParts[] = "category = '$category'";
                                }

                                $queryCondition = implode(" AND ", $queryParts);
                                $queryCondition = $queryCondition ? "AND $queryCondition" : "";

                                $selectquery = "SELECT * FROM `income` WHERE user_id = $u $queryCondition ORDER BY DATE DESC";
                                $qery = mysqli_query($con, $selectquery);

                                if (!$qery) {
                                    die("Query Failed: " . mysqli_error($con));
                                }

                                if (mysqli_num_rows($qery) > 0) {
                                    $cot = 1;
                                    while ($res = mysqli_fetch_array($qery)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $cot++; ?></td>
                                            <td><?php echo $res['income_id']; ?></td>
                                            <td><?php echo $res['user_id']; ?></td>
                                            <td><?php echo $res['DATE']; ?></td>
                                            <td><?php echo $res['category']; ?></td>
                                            <td><?php echo $res['amount']; ?> Taka</td>
                                            <td><a href="income_update.php?income_id=<?php echo $res['income_id'] ?>"><button class="btn">Update</button></a></td>

                                            <td>
                                      <a href="Delete_Income.php?income_id=<?php echo $res['income_id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                            <button class="btn">Delete</button>
                                        </a>
                                    </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No records found for the selected filter.</td></tr>";
                                }
                            } else {
                                $selectquery = "SELECT * FROM `income` WHERE user_id = $u  ORDER BY created_at DESC";
                                $qery = mysqli_query($con, $selectquery);
                                $cot = 1;
                                while ($res = mysqli_fetch_array($qery)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $cot++; ?></td>
                                        <td><?php echo $res['income_id']; ?></td>
                                        <td><?php echo $res['user_id']; ?></td>
                                        <td><?php echo $res['DATE']; ?></td>
                                        <td><?php echo $res['category']; ?></td>
                                        <td><?php echo $res['amount']; ?> Taka</td>
                                        <td><a href="income_update.php?income_id=<?php echo $res['income_id'] ?>"><button class="btn">Update</button></a></td>
                                        <td>
                                       <a href="Delete_Income.php?income_id=<?php echo $res['income_id'] ?>" onclick="return confirm('Are you sure you want to delete this record?');">
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