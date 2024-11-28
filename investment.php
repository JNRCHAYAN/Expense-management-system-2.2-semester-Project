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

// Get total investment amount for the user
$selectquery = "SELECT SUM(amount) AS total FROM invest WHERE user_id = $u";
$qery = mysqli_query($con, $selectquery);
$res = mysqli_fetch_array($qery);
$amount = $res['total'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Overview</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="./CSS/pic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
            <h2>Menu</h2>
            <ul>
                <li><a href="home.php"><span class="icon">🏠</span> Home</a></li>
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
                <h2 class="head_title">Investment Overview</h2>
                <div class="option_dev">
                    <div class="option_1">
                        <img src="./image/invest.png" alt="Investment Icon" class="Op_image">
                        <h2><?php echo $amount; ?> Taka</h2>
                        <p>Total Invest</p>
                        <br>
                        <a href="investment_Add.php">
                            <button class="btn" id="addRowButton">Add Investment</button>
                        </a>
                    </div>
                </div>
            </section>

            <section class="add_invest">
                <h2 class="head_title">My Investment</h2>
                <div class="in_form" id="formContainer">
                    <form action="" method="post">
                        <input type="text" id="amount" name="bank_name" placeholder="Search Your Bank Name" required>
                        <button type="submit" class="add" name="search">Search Your Bank Name</button>
                    </form>
                </div>

                <!-- Investment Table -->
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>User ID</th>
                            <th>Invest ID</th>
                            <th>Amount</th>
                            <th>Bank Name</th>
                            <th>Interest Rate</th>
                            <th>Investment Start Date</th>
                            <th>Total Investment Years</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['search'])) {
                            $bank = $_POST['bank_name'];
                            $selectquery = "SELECT * FROM invest WHERE user_id = $u AND `BankName` LIKE '%$bank%' ORDER BY created_at DESC";
                        } else {
                            $selectquery = "SELECT * FROM invest WHERE user_id = $u ORDER BY created_at DESC";
                        }

                        $qery = mysqli_query($con, $selectquery);
                        $coutt = 0;

                        if (mysqli_num_rows($qery) > 0) {
                            while ($res = mysqli_fetch_array($qery)) {
                                $coutt++;
                                ?>
                                <tr>
                                    <td><?php echo $coutt; ?></td>
                                    <td><?php echo $_SESSION['user_id']; ?></td>
                                    <td><?php echo $res['invest_id']; ?></td>
                                    <td><?php echo $res['amount']; ?></td>
                                    <td><?php echo $res['BankName']; ?></td>
                                    <td><?php echo $res['Interest']; ?></td>
                                    <td><?php echo date("F, Y", strtotime($res['Invest_Start'])); ?></td>
                                    <td><?php echo $res['Total_Years']; ?></td>
                                    <td><a href="up_Invest.php?invest_id=<?php echo $res['invest_id']; ?>"><button class="btn">EDIT</button></a></td>
                                    <td>
                                        <a href="Delete_Invest.php?invest_id=<?php echo $res['invest_id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">
                                            <button class="btn">Delete</button>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "<tr><td colspan='10'>No records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
