<?php
include("bridge.php");
include("functions.php");

checkUser(); // Ensure the user is logged in
include("navbar.php");

$query = "SELECT * FROM savings ORDER BY created_at DESC"; // Fetch all rows from savings table
$res = mysqli_query($connect, $query);

// Error handling for query failure
if (!$res) {
    die("Query failed: " . mysqli_error($connect));
}

// Delete operation with redirect
if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['saving_id']) && $_GET['saving_id'] > 0) {
    $saving_id = get_safe_value($_GET['saving_id']);
    
    // Additional check to ensure the logged-in user can delete this saving record
    $user_id = $_SESSION['user_id']; // Assuming session is already set for user login
    
    // Check if the saving belongs to the logged-in user
    $check_query = "SELECT * FROM savings WHERE saving_id = '$saving_id' AND user_id = '$user_id'";
    $check_res = mysqli_query($connect, $check_query);
    if (mysqli_num_rows($check_res) > 0) {
        // Using regular query to delete without prepared statements
        $query = "DELETE FROM savings WHERE saving_id = '$saving_id'";
        $result = mysqli_query($connect, $query);
        
        // Check if deletion was successful and redirect
        if ($result) {
            Redirect('savings.php?message=deleted'); // Redirect to savings page after deletion
            exit();
        } else {
            $message = "Error: " . mysqli_error($connect);
        }
    } else {
        $message = "You are not authorized to delete this saving record.";
    }
}
//join?

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Savings</title>
    <link href="#" rel="stylesheet"> <!-- Correct stylesheet link -->
</head>
<body>
    <!-- Header -->
    <div class="header"></div>

    <!-- Main Container -->
    <div class="main_container">

                      <!-- cards -->
    <table>
            <tr>
                <td>Total savings</td>
                <td>
                <?php 
                    // To get total savings
                        $savings = getSavings('total savings');
                        echo $savings['amount'];  // Access 'amount' inside the array
                ?>
                </td>
            </tr>
            <tr>
                <td>Monthly savings</td>
                <td>
                <?php 
                        // To get total savings
                        $monthlySavings = getSavings('this month');
                        echo $monthlySavings['amount'];
                    ?>
                </td>
            </tr>
            <tr>
                <td>Savings goal</td>
                <td>
                <?php 
                  $monthlyGoal = getSavings('monthly savings goal');
                  echo $monthlyGoal['goal']; 
                ?>
                </td>
            </tr>
        </table>
                    <!-- /cards -->
                     <!-- table data  -->

    <h1>Savings</h1>
    <a href="update.php">Add New Savings</a>

    <!-- Display Message after Deletion -->
    <?php if (isset($_GET['message']) && $_GET['message'] == 'deleted'): ?>
        <p>Data deleted successfully.</p>
    <?php elseif (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>


        <?php if (mysqli_num_rows($res) > 0): ?>
            <table border="1">
                <!-- Table Header -->
                <tr>
                    <th>Saving ID</th>
                    <th>User ID</th>
                    <th>Amount</th>
                    <th>Goal</th>
                    <th>Date</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>

                <!-- Table Rows -->
                <?php while ($row = mysqli_fetch_assoc($res)): ?>
                    <tr>
                        <td><?php echo $row['saving_id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['goal']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td>
                            <a href="update.php?saving_id=<?php echo $row['saving_id']; ?>">Edit</a> 
                            <!-- Direct delete link without confirmation -->
                            <a href="?type=delete&saving_id=<?php echo $row['saving_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No data found.</p>
        <?php endif; ?>
        <!-- /table data -->
    </div>

    <!-- Footer -->
    <div class="footer">
        <br/><br/>
        &copy; <?php echo date('Y'); ?> <!-- Displaying the current year -->
    </div>
</body>
</html>
