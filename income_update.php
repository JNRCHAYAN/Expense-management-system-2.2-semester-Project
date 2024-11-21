
<?php
include 'dbcon.php';



$income_ids = $_GET['income_id'];

$showquery= "SELECT * FROM `income` WHERE income_id = $income_ids";


$showdata = mysqli_query( $con ,$showquery );


header('location:income.php');



if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $userid = 1;

    // Insert data into the database
    $setvalue_db = "INSERT INTO `income`(`user_id`, `DATE`, `category`, `amount`) 
                    VALUES ('$userid', '$date', '$category', '$amount')";

    $res = mysqli_query($con, $setvalue_db);

    if ($res) 
    {
        echo "<script>alert('Data stored successfully');</script>";
        
        // Redirect to avoid duplicate data on page reload
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "<script>alert('Failed to store data');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
    <link rel="stylesheet" href="income.css">
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
            

            <!--Logout button---->
             <div class="log">
             
             <a href="logout.php">Logout</a>
             </div>
        


            </ul>
        </div>

       

        <div class="main">
            <div class="head">
                <h1>Update Income Details </h1>
            </div>

        

            <div class="section">
                <div class="section-item">
                    <h2>Add Income</h2>
                    <form action="" method="post">
                        <div>
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" required>
                        </div>
                        <div>
                            <label for="category">Category</label>
                            <input type="text" name="category" id="category" required>
                        </div>
                        <div>
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" required>
                        </div>
                        <button class="btn" type="submit" name="submit">Add Income</button>
                    </form>
                </div>
              
            </div>
        </div>
    </div>
</body>
</html>
