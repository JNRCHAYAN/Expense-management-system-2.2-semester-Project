<?php
session_start();
include("connect.php");

if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit();
}

$user = $_SESSION["user_id"]; 
$message = ""; 

// ============================
if (isset($_POST["submit"])) {
    $amount = filter_var($_POST['amount']);
    $date = filter_var($_POST['date']);

    if ($amount > 0 && !empty($date)) {
        $insertQuery = "INSERT INTO savings (user_id, amount, date) VALUES ('$user', '$amount', '$date')";
        if (mysqli_query($con, $insertQuery)) {
            $message = "Savings added successfully!";
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        } else {
            $message = "Error: Could not store data.";
        }
    } else {
        $message = "Please enter a valid amount and date.";
    }
}

// ============================
if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['saving_id'])) {
    $saving_id = intval($_GET['saving_id']); 
    $checkQuery = "SELECT * FROM savings WHERE saving_id = '$saving_id' AND user_id = '$user'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        $deleteQuery = "DELETE FROM savings WHERE saving_id = '$saving_id'";
        if (mysqli_query($con, $deleteQuery)) {
            $message = "Record deleted successfully.";
            header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        } else {
            $message = "Error: Unable to delete record.";
        }
    } else {
        $message = "You are not authorized to delete this record.";
    }
}

// ============================
$totalQuery = "SELECT SUM(amount) AS total FROM savings WHERE user_id = '$user'";
$totalResult = mysqli_query($con, $totalQuery);
$totalData = mysqli_fetch_assoc($totalResult);
$totalAmount = $totalData['total'] ?? 0;

// ============================
$savingsQuery = "SELECT * FROM savings WHERE user_id = '$user' ORDER BY date DESC";
$savingsRecords = mysqli_query($con, $savingsQuery);
?>


<!-- ======================================= -->

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
    <div class="container">

        <div class="navigation">
            <h2>Menu</h2>
            <ul>
            <li><a href="home.php"><span class="icon"> 🏠</span> Home</a></li>
                <li><a href="income.php"><span class="icon">💰</span> Income</a></li>
                <li><a href="Expanse.php"><span class="icon">📊</span> Expenses</a></li>
                <li><a href="saving.php"  class="active"><span class="icon">💲</span> Savings</a></li>
                <li><a href="loan.php"><span class="icon">💵</span> Loan</a></li>
                <li><a href="investment.php"><span class="icon">💱</span> Investment</a></li>
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
                <div class="log"><a href="logout.php">Logout</a></div>
            </ul>
        </div>


        <div class="content">
            <header>
     
                <div class="col">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                            <h2 class="stats-type mb-1">Total Savings</h2>
                            <div class="stats-figure">
                                <?php echo htmlspecialchars(number_format($totalAmount, 2)); ?> Taka
                            </div>
                        </div>
                        
                    </div>
                </div>
            </header>


            <?php if (!empty($message)): ?>
                <p class="notification"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <div class="table-container">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <td>
                                        <h3 class="title fw-semibold">Savings Table</h3>
                                    </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td class="add_button">
                                        <a href="Up_Saving.php">
                                            <button class="btn btn-sm btn-primary px-3" id="addRowButton">
                                                Add
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            </thead>
                            <thead class="bg-light">
                                <tr class="text-muted">
                                    <th>Serial No.</th>
                                    <th>User ID</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $count = 1; 
                                if (mysqli_num_rows($savingsRecords) > 0):
                                    while ($row = mysqli_fetch_assoc($savingsRecords)): ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo htmlspecialchars($row['user_id']); ?></td>
                                            <td><?php echo htmlspecialchars(number_format($row['amount'], 2)); ?></td>
                                            <td><?php echo htmlspecialchars(date("d-m-y", strtotime($row['date']))); ?></td>
                                            <td class="button">
                                                <a href="Up_Saving.php?saving_id=<?php echo $row['saving_id']; ?>" title="Edit">
                                                    <button class="btn btn-outline-primary btn-sm" id="editRowButton">Edit</button>
                                                </a>
                                                <a href="?type=delete&saving_id=<?php echo $row['saving_id']; ?>"
                                                   onclick="return confirm('Are you sure you want to delete this record?');" title="Delete">
                                                    <button class="btn btn-outline-danger btn-sm" id="deleteRowButton">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5">No savings records found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
</html>