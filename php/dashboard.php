<?php
    include("bridge.php");
    include("functions.php");
    checkUser(); // Ensure user login/logout functionality
    include("navbar.php");

    //user_id 
    $user_id = mysqli_real_escape_string($connect, $_SESSION['user_id']);

    //start the charts
    //fetch financial data for the logged-in user for the charts 
    $query = "SELECT * FROM charts WHERE user_id = '$user_id'";
    $res = mysqli_query($connect, $query);

    $chartData = [];
    if ($res && mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $month = $row['month'];
            $income = $row['income'];
            $expenses = $row['expenses'];
            $loans = $row['loans'];
            $savings = $row['savings'];
            // Add to chart data array
            $chartData[] = "['$month', $income, $expenses, $loans, $savings]";
        }
    }

    // Optionally, fetch total income, expenses, loans, and savings for card display
    $income = getDashboard('total income');
    $expenses = getDashboard('total expenses');
    $loans = getDashboard('total loans');
    $savings = getDashboard('total savings');

    // Close connection if needed
 // mysqli_close($connect);
//end of the charts  
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="styles.css" rel="stylesheet"> <!-- Correct stylesheet link -->

    <!-- Google Charts -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Month', 'Income', 'Expenses', 'Loans', 'Savings'],
                <?php echo implode(',', $chartData); ?>
            ]);

            var options = {
                chart: {
                    title: 'Income, Expenses, Loans, and Savings',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>

</head>
<body>
    <!-- Main Layout -->

        <!-- Main Content -->
        <div class="main">
            <!-- Header Section -->
            <div class="head">
                <h1>Welcome, User!</h1>
            </div>

            <!-- Dashboard Cards -->
            <div class="section">
                <div class="dashboard-container">
                    <div class="box income">
                        <h3>Income</h3>
                        <p>
                            <?php
                            echo '#';
                            ?>
                        </p>
                    </div>
                    <div class="box expense">
                        <h3>Expenses</h3>
                        <p>
                        <?php
                            echo '#';
                            ?>
                        </p>
                    </div>
                    <div class="box loans">
                        <h3>Loans</h3>
                        <p>
                        <?php
                            echo '#';
                            ?>
                        </p>
                    </div>
                    <div class="box savings">
                        <h3>Savings</h3>
                        <p>
                            <?php echo "$" . htmlspecialchars($savings['amount'], ENT_QUOTES, 'UTF-8'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="section chart-container">
                <h4>Chart</h4>
                <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <?php echo date('Y'); ?> My App. All rights reserved.
    </div>
</body>
</html>
