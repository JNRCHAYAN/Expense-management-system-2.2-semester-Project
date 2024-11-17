<?php
include("bridge.php");
include("functions.php");

checkUser(); // Ensure the user is logged in
include("navbar.php");

$label = 'Add'; // Default label for add mode
$amount = '';   // Default value for the amount field
$goal = '';     // Default value for the goal field
$date = '';     // Default value for the date field
$saving_id = null; // Default saving_id

$message = ''; // Variable to display messages

// Check if this is an edit operation
if (isset($_GET['saving_id']) && $_GET['saving_id'] > 0) {
    $label = 'Edit'; // Change label for edit mode
    $saving_id = get_safe_value($_GET['saving_id']);
    
    // Fetch the current savings data for editing
    $query = "SELECT * FROM savings WHERE saving_id = '$saving_id'";
    $res = mysqli_query($connect, $query);
//no unknown one can access so redirect
if(mysqli_num_rows($res) == 0) {
    Redirect('savings.php');
    exit();
}

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $amount = $row['amount'];   // Pre-fill the amount field with the existing value
        $goal = $row['goal'];
        $date = $row['date']; // Pre-fill the date field with the existing value

    } else {
        $message = "Invalid saving ID.";
        Redirect('savings.php'); // Redirect to the savings page if invalid ID
        exit();//prevent further code execution
    }
}

if (isset($_POST['add'])) {
    // Get and validate the input
    $amount = (float)get_safe_value($_POST['amount']); 
    $goal = (float)get_safe_value($_POST['goal']);
    $date = get_safe_value($_POST['date']);


    if ($amount > 0) {
        $user_id = $_SESSION['user_id']; // Get the user ID from session

        // Insert or update based on whether it's "Add" or "Edit"
        if ($label === 'Add') {
            $query = "INSERT INTO savings (user_id, amount, goal, date, created_at) 
                      VALUES ('$user_id', '$amount', '$goal', '$date', NOW())";  // Use NOW() for created_at
        } else {
            $query = "UPDATE savings SET amount = '$amount', goal = '$goal', date = '$date' WHERE saving_id = '$saving_id'";
        }

        $res = mysqli_query($connect, $query);

        if ($res) {
            // $message = "Savings successfully " . strtolower($label) . "ed.";
            Redirect('savings.php'); // Redirect to the savings page after successful operation
            exit();
        } else {
            $message = "Error: " . mysqli_error($connect);
        }
    } else {
        $message = "Please enter a valid amount greater than zero.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $label; ?> Savings</title>
</head>
<body>
    <h1><?php echo $label; ?> Savings</h1>
    <a href="savings.php">Back</a>

    <!-- Display Message -->
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

    <div class="main_container">
        <form method="post">
            <table>
                <tr>
                    <td>Amount</td>
                    <td><input type="number" name="amount" required value="<?php echo htmlspecialchars($amount); ?>"></td>
                    <td>Goal</td>
                    <td><input type="number" name="goal" required value="<?php echo htmlspecialchars($goal); ?>"></td>
                    <td>Date</td>
                    <td><input type="date" name="date" required value="<?php echo htmlspecialchars($date); ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" name="add" value="<?php echo $label; ?>"></td>
                </tr>
            </table>
        </form>
    </div>

    <div class="footer">
        <br/><br/>
        &copy; <?php echo date('Y'); ?>
    </div>
</body>
</html>
