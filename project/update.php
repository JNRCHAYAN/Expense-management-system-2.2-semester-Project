<?php
session_start();
include("connect.php");

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

$label = 'Add'; // Default label for add mode
$user_id = $_SESSION['user_id']; // Logged-in user's ID
$amount = '';
$date = '';
$message = '';

// Helper function to sanitize input
function get_safe_value($data, $connection)
{
    return mysqli_real_escape_string($connection, trim($data));
}

// Check if this is an edit operation
if (isset($_GET['saving_id']) && is_numeric($_GET['saving_id'])) {
    $label = 'Edit'; // Change label for edit mode
    $saving_id = get_safe_value($_GET['saving_id'], $con);

    // Fetch current savings data
    $query = "SELECT * FROM savings WHERE saving_id = '$saving_id' AND user_id = '$user_id'";
    $res = mysqli_query($con, $query);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $amount = $row['amount'];
        $date = $row['date'];
    } else {
        $message = "Invalid saving ID.";
        header("Location: saving.php");
        exit();
    }
}

// Handle form submission
if (isset($_POST['add'])) {
    $amount = get_safe_value($_POST['amount'], $con);
    $date = get_safe_value($_POST['date'], $con);

    if ($amount > 0 && !empty($date)) {
        if ($label === 'Add') {
            $query = "INSERT INTO savings (user_id, amount, date) VALUES ('$user_id', '$amount', '$date')";
        } else {
            $query = "UPDATE savings SET amount = '$amount', date = '$date' WHERE saving_id = '$saving_id' AND user_id = '$user_id'";
        }

        $res = mysqli_query($con, $query);

        if ($res) {
            header("Location: saving.php");
            exit();
        } else {
            $message = "Error: " . mysqli_error($con);
        }
    } else {
        $message = "Please enter a valid amount and date.";
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management - Savings</title>
    <link rel="stylesheet" href="./CSS/savings.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>   
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
        <img src="./image/menubar3.png" alt="Icon" class="Op_image_menu">
            <ul>
                <li><a href="home.php"><i class="fas fa-bars"></i> <span class="nav-title">Menu</span></a></li>
                <li><a href="home.php"><i class="fas fa-home"></i> <span class="nav-title">Home</span></a></li>
                <li><a href="income.php"><i class="fas fa-wallet"></i> <span class="nav-title">Income</span></a></li>
                <li><a href="expense.php"><i class="fas fa-file-invoice-dollar"></i> <span
                            class="nav-title">Expenses</span></a></li>
                <li><a href="saving.php"><i class="fas fa-ghost"></i> <span class="nav-title">Savings</span></a>
                </li>
                <li><a href="loan.php"><i class="fas fa-hand-holding-usd"></i> <span class="nav-title">Loan</span></a>
                </li>
                <li><a href="investment.php"><i class="fas fa-chart-line"></i> <span
                            class="nav-title">Investments</span></a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> <span class="nav-title">Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span class="nav-title">Logout</span></a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="app-content">
        <!-- <div class="col"> -->

        <!-- <div class="app-card-update"> -->
                        
                            
                            
                        



        <!-- Add/Edit Savings Form -->
        <div class="container">
        
            
            <!--Display message if any -->
            <?php if ($message != ''): ?>
                <div class="alert alert-danger"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST" action="" class="update">
            <img src="./image/money-box.png" alt="Icon" class="Op_image_menu">
                <header class="header"><h2><?php echo $label; ?> Savings</h2></header>

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $amount; ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo $date; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add"><?php echo $label; ?></button>


            <footer class="app-footer" style="padding: 10px 0;">
                <div class="container text-center py-3">
                <a href="saving.php">Back</a>
		    </div>
	    </footer>
            </form>
        </div>
    
    <!--//app-card-->                    
<!-- </div> -->
    <!-- //col -->
<!-- </div>          -->
  
    </div> <!--//app-content-->


    </div>
</body>
</html>