<?php
session_start();
// Example variables, assuming they're set after session validation or database fetch
$user_name = $_SESSION['user_name'] ?? 'User';
$total_savings = 10000;
$monthly_savings = 800;
$savings_goal = 5000;
$savings_goal_progress = 80; // Percentage for goal progress
$emergency_fund = 2000;
$recent_contributions = [
    'April 15' => 100,
    'April 1' => 200,
    'March 20' => 150
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Money Management - Savings</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Savings management system">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome JS -->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>

    <!-- Custom CSS -->
    <link id="theme-style" rel="stylesheet" href="/assets/css/design.css">
</head> 

<body class="app">    
    <header class="app-header fixed-top"> 
        <div class="container-fluid py-2">
            <div class="row align-items-center">
                <div class="col-auto">
                    <a id="sidepanel-toggler" class="btn btn-outline-secondary d-inline-block d-xl-none" href="#">
                        <i class="fa-solid fa-bars"></i>
                    </a>
                </div>
                <div class="col">
                    <form class="d-flex app-search-form">
                        <input type="text" placeholder="Search savings..." name="search" class="form-control me-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="col-auto">
                    <a href="#" class="btn btn-secondary dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown">
                        <img src="assets/images/user.png" alt="Profile" class="rounded-circle" width="30">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="account.php">Account</a></li>
                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <div id="app-sidepanel" class="app-sidepanel"> 
        <div id="sidepanel-drop" class="sidepanel-drop"></div>
        <div class="sidepanel-inner d-flex flex-column">
            <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
            <div class="app-branding">
                <a class="app-logo" href="index.php">
                    <img class="logo-icon me-2" src="assets/images/app-logo.svg" alt="logo"><span class="logo-text">LOGO</span>
                </a>
            </div>
            
            <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
                <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                    <li class="nav-item">

                        <a class="nav-link active" href="index.php">
                            <span class="nav-icon"><i class="bi bi-house-door"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="docs.php">

                            <span class="nav-icon"><i class="bi bi-folder"></i></span>
                            <span class="nav-link-text">Documents</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="orders.php">
                            
                            <span class="nav-icon"><i class="bi bi-card-list"></i></span>
                            <span class="nav-link-text">Category</span>
                        </a>
                        <div id="submenu-1" class="collapse submenu" data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                <li class="submenu-item"><a class="submenu-link" href="#">Incomes</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Expenses</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Savings</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Investments</a></li>
                                <li class="submenu-item"><a class="submenu-link" href="#">Loans</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

            <div class="app-sidepanel-footer">
                <nav class="app-nav app-nav-footer">
                    <ul class="app-menu footer-menu list-unstyled">
                        <li class="nav-item">
                            <a class="nav-link" href="settings.php">
                                <span class="nav-icon"><i class="bi bi-gear"></i></span>
                                <span class="nav-link-text">Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="help.php">
                                <span class="nav-icon"><i class="bi bi-question-circle"></i></span>
                                <span class="nav-link-text">Help</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="app-wrapper d-flex">
        <div class="container-xl mt-5 pt-3">
            <h1 class="app-page-title text-center">Savings Dashboard</h1>

            <!-- Card Section for Quick Overview -->
            <div class="row g-4 mt-4">
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Total Savings</h4>
                            <p class="card-text display-6">$<?php echo number_format($total_savings, 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Monthly Savings</h4>
                            <p class="card-text display-6">$<?php echo number_format($monthly_savings, 2); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Savings Goal</h4>
                            <p class="card-text display-6"><?php echo $savings_goal_progress; ?>%</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h4 class="card-title">Emergency Fund</h4>
                            <p class="card-text display-6">$<?php echo number_format($emergency_fund, 2); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Savings Breakdown -->
            <div class="row mt-5">
                <div class="col-12 col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5>Savings Chart</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="savingsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5>Recent Contributions</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($recent_contributions as $date => $amount): ?>
                                <li class="list-group-item"><?php echo $date; ?> - $<?php echo number_format($amount, 2); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Savings Goal Section -->
            <div class="row g-4 mt-5">
                <div class="col-12 col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5>Set Savings Goals</h5>
                        </div>
                        <div class="card-body">
                            <form action="set_goal.php" method="post">
                                <div class="mb-3">
                                    <label for="goalAmount" class="form-label">Goal Amount</label>
                                    <input type="number" class="form-control" id="goalAmount" name="goal_amount" placeholder="$5000">
                                </div>
                                <button type="submit" class="btn btn-success w-100">Save Goal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sample data for the chart (PHP can be used to dynamically set these values if needed)
        const ctx = document.getElementById('savingsChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
                datasets: [{
                    label: 'Monthly Savings',
                    data: [200, 300, 250, 400, 450],
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
