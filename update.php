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
</head>

<body>   
    < class="container">
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

            <form method="POST" action="">
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

  
    </div> 


    </div>
</body>
</html>