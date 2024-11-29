<?php
include 'dbcon.php';

// Fetch the income record based on income_id
$income_ids = $_GET['income_id'];
$showquery = "SELECT * FROM `income` WHERE income_id = {$income_ids}";
$showdata = mysqli_query($con, $showquery);
$arraydata = mysqli_fetch_array($showdata);

// Update Income record
if (isset($_POST['submit'])) {
    $idupdate = $_GET['income_id'];
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = 1;

    $updates = "UPDATE `income` SET `DATE` = '$date', `category` = '$category', `amount` = '$amount' WHERE `income_id` = '$idupdate'";

    $ress = mysqli_query($con, $updates);

    if ($ress) {
        echo "<script>alert('Data updated successfully');</script>";
        // Redirect to avoid duplicate data on page reload
        header('location:income.php');
        exit;
    } else {
        echo "<script>alert('Failed to update data');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Income</title>
    <link rel="stylesheet" href="sty.css">
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
            </ul>
            <div class="log">
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main">

            <div class="section">
                <div class="section-item">
                    <h2>Edit Income</h2>
                    <a href="income.php">
                        <button id="backb">
                         Back
                       </button>
                        </a>
                        <br><br>
                    <form action="" method="post" class="in_form">
                        <div>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" value="<?php echo $arraydata['DATE']; ?>" required>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <select name="category" id="category" required>
                                <option value="salary" <?php if($arraydata['category'] == 'salary') echo 'selected'; ?>>Salary</option>
                                <option value="house" <?php if($arraydata['category'] == 'house') echo 'selected'; ?>>House Property</option>
                                <option value="business" <?php if($arraydata['category'] == 'business') echo 'selected'; ?>>Business</option>
                                <option value="capital" <?php if($arraydata['category'] == 'capital') echo 'selected'; ?>>Capital Gains</option>
                                <option value="other" <?php if($arraydata['category'] == 'other') echo 'selected'; ?>>Others</option>
                            </select>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" value="<?php echo $arraydata['amount']; ?>" required>
                        </div>
                        <button class="btn" type="submit" name="submit">Update Income</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
