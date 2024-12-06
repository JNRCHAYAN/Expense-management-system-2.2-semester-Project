<?php
include 'connect.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html');
    exit();
}
$u = $_SESSION['user_id'];

// Fetch the income record based on income_id
$expense_ids = $_GET['expense_id'];
$showquery = "SELECT * FROM `expenses` WHERE expense_id = {$expense_ids}"; $showdata = mysqli_query($con, $showquery);
$arraydata = mysqli_fetch_array($showdata);
$error = "";

// Update Income record
if (isset($_POST['submit'])) {
    $idupdate = $_GET['expense_id'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = $u;
    if( $amount>0)
    {
        $updates = "UPDATE `expenses` SET `expense_date` = '$date', `category` = '$category', `amount` = '$amount' WHERE `expense_id` = '$idupdate'";
        $ress = mysqli_query($con, $updates);
        if ($ress) {

            header('location:Expanse.php');
            exit;
        }
    }
    else
    {
        $error= "Please put Amount is greater then 0";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Income</title>
    <link rel="stylesheet" href="./CSS/income_up_a.css">
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

            <div class="section">
                <div class="section-item">
                    <h2>Edit Income</h2>
                    <a href="Expanse.php">
                        <button id="backb">Back</button></a>
                        <br><br>
                    <form action="" method="post" class="in_form">
                        <div>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" value="<?php echo $arraydata['expense_date']; ?>" required>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <select name="category" id="category" required>
                                <option value="Housing" <?php if($arraydata['category'] == 'Housing') echo 'selected'; ?>>Housing</option>
                                <option value="Food" <?php if($arraydata['category'] == 'Food') echo 'selected'; ?>>Food</option>
                                <option value="Transportation" <?php if($arraydata['category'] == 'Transportation') echo 'selected'; ?>>Transportation</option>
                                <option value="Health" <?php if($arraydata['category'] == 'Health') echo 'selected'; ?>>Health</option>
                                <option value="Education" <?php if($arraydata['category'] == 'Education') echo 'selected'; ?>>Education</option>
                                <option value="Savings" <?php if($arraydata['category'] == 'Savings') echo 'selected'; ?>>Savings</option>
                                <option value="Clothing" <?php if($arraydata['category'] == 'Clothing') echo 'selected'; ?>>Clothing</option>
                                <option value="Others" <?php if($arraydata['category'] == 'Others') echo 'selected'; ?>>Others</option>
                            </select>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" value="<?php echo $arraydata['amount']; ?>" required>
                        </div>
                        <button class="btn" type="submit" name="submit">Update Expense</button>
                    </form>
                    <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
