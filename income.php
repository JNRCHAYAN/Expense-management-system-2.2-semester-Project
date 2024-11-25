<?php
include 'dbcon.php';

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




 <?php
include 'dbcon.php';

$setvalue="SELECT SUM(amount) AS 'total' FROM income WHERE MONTH(created_at) =  MONTH(DATE)";
$res = mysqli_query($con, $setvalue);
$fetch = mysqli_fetch_array($res);
$set=$fetch['total']; 


$setv="SELECT SUM(amount) AS 'Amount' FROM expenses WHERE MONTH(created_at) =  MONTH(expense_date)";
$ress = mysqli_query($con, $setv);
$fac = mysqli_fetch_array($ress);
$sett=$fac['Amount'];
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Overview</title>
    <link rel="stylesheet" href="./CSS/income.css">
</head>
<body>
    <div class="container">
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

            <!--Logout button---->
             <div class="log">
             
             <a href="logout.php">Logout</a>
             </div>
        


            </ul>
        </div>

       

        <div class="main">
            <div class="head">
                <h1>INCOME</h1>
            </div>

            <div class="section">
                <h3>Overview</h3>
                <div style="display: flex; justify-content: center;">
                    <div class="box income">
                        <h3>Income</h3>
                <?php echo $set?>TK </p> 
                    </div>
                    <div class="box expense">
                        <h3>Expense</h3>
                        <?php echo $sett ?> TK</p>
                    </div>
                </div>
            </div>

            <div class="section">
                <h3>My Income</h3>
                <div class="my-income-card">

                    <form action="" method="post">
                        <h3>Filter Options</h3>
                        <div class="filter-group">
                            <div>
                                <label for="start-date">Start Date</label>
                                <input type="date" name="start" id="start-date">
                            </div>
                            <div>
                                <label for="end-date">End Date</label>
                                <input type="date" name="end" id="end-date">
                            </div>
                            <div>
                                <label for="category-filter">Category</label>
                                <input type="text" name="categoryy" id="end-date">
                            </div>
                        </div>
                        <button class="btn" type="submit" name="s">Filter</button>   
                    </form>

                    <table>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Income id</th>
                                <th>User_id</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Amount</th>
                                <th colspan="2">Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['s'])) {
                                $Sdate = $_POST['start'];
                                $Edate = $_POST['end'];
                                $category = $_POST['categoryy'];
                                $userid = 1;

                                $selectquery = "SELECT * FROM `income` WHERE user_id = $userid AND DATE BETWEEN '$Sdate' AND '$Edate' AND category = '$category'";
                                $qery = mysqli_query($con, $selectquery);

                                if (!$qery) {
                                    die("Query Failed: " . mysqli_error($con));
                                }

                                if (mysqli_num_rows($qery) > 0) {
                                    while ($res = mysqli_fetch_array($qery)) {
                                        ?>
                                        <tr>
                                            
                                            <td><?php echo $res['DATE']; ?></td>
                                            <td><?php echo $res['category']; ?></td>
                                            <td><?php echo $res['amount']; ?> Taka</td>
                                            <td><button class="btn">Update</button></td>
                                            <td><button class="btn">Delete</button></td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found for the selected filter.</td></tr>";
                                }
                            } else {
                                $selectquery = "SELECT * FROM `income` WHERE user_id = 1 ORDER BY created_at DESC";
                                $qery = mysqli_query($con, $selectquery);
                                $cot =0;
                                while ($res = mysqli_fetch_array($qery)) {
                                    $cot +=1;
                                    ?>
                                    <tr>
                                        <td><?php echo  $cot;?></td>
                                        <td> <?php echo $res['income_id']; ?></td>
                                        <td> <?php echo $res['user_id']; ?></td>
                                        <td><?php echo $res['DATE']; ?></td>
                                        <td><?php echo $res['category']; ?></td>
                                        <td><?php echo $res['amount']; ?> Taka</td>
                                        <td> <a href="income_update.php?income_id=<?php echo $res['income_id'] ?> ">
                                        <button class="btn">Update</button></a></td>

                                        <td> <a href="Delete_Income.php?income_id=<?php echo $res['income_id'] ?>"> 
                                            <button class="btn">Delete</button> </a> </td>
                                            
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>





        <br>
 <div>
        <button class="btn" onclick="showForm()">Click here to Add Income</button>

        <section class="add_income">
                
                <div class="in_form form-container" id="formContainer">
                    <form action="" method="post">
                        <h2>Add Income</h2>
                        <label for="date">Date</label>
                        <input type="date" name="date" id="date"  required>

                       <label for="category">Category</label>
                        <input type="text" name="category" id="category" required>

                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" required>
                    
                        <button type="submit" class="btn" name="submit">Add Income</button>
                    </form>
                </div>
            </section>

   

         </div>
                  
  




       
    </div> 
    <script>
        function showForm() {
            document.getElementById("formContainer").style.display = "block";
        }

        function showForm() {
            document.getElementById("formContainer").style.display = "block";
        }
    </script>
</body>
</html>