<?php
session_start();
include("connect.php");

// Redirect if not logged in
if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit();
}

$user = $_SESSION["user_id"]; // Get logged-in user ID
$message = ""; // Initialize feedback message

// Handle adding savings
if (isset($_POST["submit"])) {
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);

    if ($amount > 0 && !empty($date)) {
        $insertQuery = $con->prepare("INSERT INTO savings (user_id, amount, date) VALUES (?, ?, ?)");
        $insertQuery->bind_param("sss", $user, $amount, $date);
        if ($insertQuery->execute()) {
            $message = "Savings added successfully!";
            header("Location: " . $_SERVER['PHP_SELF']); // Prevent form resubmission
            exit();
        } else {
            $message = "Error: Could not store data.";
        }
    } else {
        $message = "Please enter a valid amount and date.";
    }
}

// Handle deletion of a savings record
if (isset($_GET['type']) && $_GET['type'] === 'delete' && isset($_GET['saving_id'])) {
    $saving_id = intval($_GET['saving_id']); // Ensure it’s an integer
    $checkQuery = $con->prepare("SELECT * FROM savings WHERE saving_id = ? AND user_id = ?");
    $checkQuery->bind_param("is", $saving_id, $user);
    $checkQuery->execute();
    $checkResult = $checkQuery->get_result();

    if ($checkResult->num_rows > 0) {
        $deleteQuery = $con->prepare("DELETE FROM savings WHERE saving_id = ?");
        $deleteQuery->bind_param("i", $saving_id);
        if ($deleteQuery->execute()) {
            $message = "Record deleted successfully.";
            header("Location: " . $_SERVER['PHP_SELF']); // Redirect after deletion
            exit();
        } else {
            $message = "Error: Unable to delete record.";
        }
    } else {
        $message = "You are not authorized to delete this record.";
    }
}

// Calculate total savings
$totalQuery = "SELECT SUM(amount) AS total FROM savings WHERE user_id = '$user'";
$totalResult = mysqli_query($con, $totalQuery);
$totalData = mysqli_fetch_assoc($totalResult);
$totalAmount = $totalData['total'] ?? 0;


// Fetch all savings records with filters
$year = isset($_GET['year']) ? htmlspecialchars($_GET['year']) : '';
$month = isset($_GET['month']) ? htmlspecialchars($_GET['month']) : '';
$date = isset($_GET['date']) ? htmlspecialchars($_GET['date']) : '';

// Fetch savings records with filters
$savingsQuery = "SELECT * FROM savings WHERE user_id = '$user'";

if ($year) {
    $savingsQuery .= " AND YEAR(date) = '$year'";
}
if ($month) {
    $savingsQuery .= " AND MONTH(date) = '$month'";
}
if ($date) {
    $savingsQuery .= " AND DAY(date) = '$date'";  // Correct usage for filtering by day
}

$savingsQuery .= " ORDER BY date DESC";
$savingsRecords = mysqli_query($con, $savingsQuery);

// Check if records exist
if (mysqli_num_rows($savingsRecords) == 0) {
    echo "No records found for the user.";
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

    <!-- a little js to check the date thing to automatically update in tune with the year and the month -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const yearSelect = document.getElementById('year-filter');
            const monthSelect = document.getElementById('month-filter');
            const dateSelect = document.getElementById('date-filter');

            // Function to check if a year is a leap year
            function isLeapYear(year) {
                return (year % 4 === 0 && year % 100 !== 0) || (year % 400 === 0);
            }

            // Function to get number of days in a month
            function getDaysInMonth(month, year) {
                // Use the month (1-12) and year to return the number of days
                const daysInMonth = [31, isLeapYear(year) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
                return daysInMonth[month - 1];
            }

            // Function to update the date dropdown
            function updateDateDropdown() {
                const year = yearSelect.value;
                const month = monthSelect.value;

                if (year && month) {
                    const daysInMonth = getDaysInMonth(month, year);
                    dateSelect.innerHTML = '<option value="">Select</option>'; // Clear previous options

                    // Populate the date dropdown with new options
                    for (let i = 1; i <= daysInMonth; i++) {
                        const day = i < 10 ? '0' + i : i; // Add leading zero if needed
                        const option = document.createElement('option');
                        option.value = day;
                        option.textContent = day;
                        dateSelect.appendChild(option);
                    }
                }
            }

            // Event listeners for changes in year and month
            yearSelect.addEventListener('change', updateDateDropdown);
            monthSelect.addEventListener('change', updateDateDropdown);

            // Initialize the dropdown when the page loads
            updateDateDropdown();
        });
    </script>


</head>

<body>
    <div class="container">
        <!-- Sidebar Navigation -->
        <div class="navigation">
        <img src="./image/menubar3.png" alt="Icon" class="Op_image_menu">
            <ul>
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
        <div class="content">
            <header>
                <!-- Total savings -->
                <div class="col">
                    <div class="app-card app-card-stat shadow-sm h-100">
                        <div class="app-card-body p-3 p-lg-4">
                        <img src="./image/growth.png" alt="Icon" class="Op_image_menu">
                            <h2>Total Savings</h2>
                            <p>
                                <?php echo htmlspecialchars(number_format($totalAmount, 2)); ?>
                            </p>
                        </div><!--//app-card-body-->
                    </div><!--//app-card-->
                </div><!--//col-->
            </header>

            <!-- Feedback Message -->
            <?php if (!empty($message)): ?>
                <p class="notification"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>

            <!-- Search and Filter -->

            <div class="filter-container">
                <form class="filter-form" method="GET">


                    <!-- Filter by Year -->
                    <div class="filter-item">
                        <label for="year">Year</label>
                        <select name="year" id="year-filter" class="year-dropdown">
                            <option value="">Select</option>
                            <?php
                            $currentYear = date('Y');
                            for ($yearOption = 2019; $yearOption <= $currentYear + 10; $yearOption++) {
                                echo '<option value="' . $yearOption . '" ' . (($yearOption == $year) ? 'selected' : '') . '>' . $yearOption . '</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <!-- Filter by Month -->
                    <div class="filter-item">
                        <label for="month">Month</label>
                        <select name="month" id="month-filter" class="month-dropdown">
                                <option value="">Select</option>
                                <?php
                                for ($m = 1; $m <= 12; $m++) {
                                    $monthName = DateTime::createFromFormat('!m', $m)->format('F');
                                    $monthValue = str_pad($m, 2, '0', STR_PAD_LEFT);
                                    echo "<option value='$monthValue' " . (($month == $monthValue) ? 'selected' : '') . ">$monthName</option>";
                                }
                                ?>
                            </select>
                    </div>

                    <!-- Filter by Date -->
                    <div class="filter-item">
                        <label for="date">Date</label>
                        <select name="date" id="date-filter" class="date-dropdown">
                            <option value="">Select</option>
                            <?php
                            // Get the number of days in the selected month and year
                            $currentMonth = $month ?: date('m'); // Use the selected month or current month
                            $currentYear = $year ?: date('Y'); // Use the selected year or current year
                            
                            // Handle number of days in the month
                            $numDays = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);

                            // Loop through each day and generate options
                            for ($day = 1; $day <= $numDays; $day++) {
                                $formattedDay = str_pad($day, 2, '0', STR_PAD_LEFT); // Format day to two digits
                                echo '<option value="' . $formattedDay . '" ' . (($formattedDay == $date) ? 'selected' : '') . '>' . $formattedDay . '</option>';
                            }
                            ?>
                        </select>
                    </div>



                    <button type="submit" class="filter-btn">Apply Filters</button>
                </form>
            </div>


            <!-- Savings Records Table -->
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
                                        <a href="update.php">
                                            <button class="btn btn-sm btn-primary px-3" id="addRowButton">Add</button>
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
                                                <a href="update.php?saving_id=<?php echo $row['saving_id']; ?>" title="Edit">
                                                    <button class="btn btn-outline-primary btn-sm"
                                                        id="editRowButton">Edit</button>
                                                </a>
                                                <a href="?type=delete&saving_id=<?php echo $row['saving_id']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this record?');"
                                                    title="Delete">
                                                    <button class="btn btn-outline-danger btn-sm"
                                                        id="deleteRowButton">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" style="color: tomato; text-align: center; font-weight: bold;">No savings records found.
                                        </td>
                                    </tr>

                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <footer>
                <div class="footer-button">
                    <a href="saving.php">Back</a>
                </div>
            </footer>
        </div>

    </div>
</body>

</html>