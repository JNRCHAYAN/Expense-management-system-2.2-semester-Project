<?php
include 'connect.php';
if(isset($_POST['submit']))
{
    $amount = $_POST['amount'];
    $Bank_name = $_POST['Bank_name'];
    $rate = $_POST['rate'];
    $s_date = $_POST['s_date'];
    $year = $_POST['year'];
    $user_id = 1;
    $setvalue_db = "INSERT INTO `invest`(`user_id`,`amount`, `BankName`, `Interest`, `Invest_Start`, `Total_Years`) 
     VALUES ('$user_id','$amount','$Bank_name','$rate','$s_date','$year'); ";
    $res = mysqli_query($con ,  $setvalue_db);
    if ($res) {
        echo "<script>alert('Data stored successfully');</script>";
        header("Location: " .$_SERVER['PHP_SELF']);
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
    <title>Investment Overview</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                <li><a href="loan.php"><span class="icon">📊</span> Loan</a></li>
                <li><a href="#"><span class="icon">💼</span> Investment</a></li>
                <li><a href="#"><span class="icon">🔒</span> Profile</a></li>
                <li><a href="#"><span class="icon">⚙️</span> Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main">
          <?php        
            include 'connect.php';
            $selectquery = "SELECT SUM(amount) AS total FROM savings";
            $qery = mysqli_query( $con , $selectquery);
            $res = mysqli_fetch_array($qery);
            $amount = $res['total'];

            ?>
        
            <section>
                <h2 class="head_title">Investment Overview</h2>
                <!-- <div class="option_dev">
                    <div class="option_1">
                        <img src="loan.png" alt="Paid Icon" class="Op_image">
                        <h2><?php echo  $amount; ?> Taka</h2>
                        <p>Invest Amount</p>
                        </div>
                    </div> -->
                 
            </section>

            <section class="add_invest">
            <h2 class="head_title">My Investment</h2>
         <table>
             <thead><tr>
                 <th>NO</th>
                 <th>Invest ID</th>
                 <th>Amount</th>
                 <th>Bank Name</th>
                 <th>Interest Rate</th>
                 <th>Investment Start Date</th>
                 <th>Total Investment Years</th>
                 <th colspan="2">Operation</th>
             </tr>
         </thead>
         <tbody>
             <?php

                 include 'connect.php';

                 $selectquery = "Select *from invest order by created_at desc";

                 $qery = mysqli_query( $con, $selectquery);
                 $coutt=0;
                 while ($res = mysqli_fetch_array($qery))
                 {
                    $coutt +=1;
                   ?>      
                     <tr>
                     <td> <?php echo $coutt; ?></td>
                     <td> <?php echo $res['invest_id']; ?></td>
                     <td> <?php echo $res['amount']; ?></td>
                     <td> <?php echo $res['BankName']; ?></td>
                     <td> <?php echo $res['Interest']; ?></td>
                     <td> <?php echo date("F, Y", strtotime($res['Invest_Start'])); ?></td>
                     <td> <?php echo $res['Total_Years']; ?></td>
                     <td> <a href="up_Invest.php?invest_id=<?php echo $res['invest_id'] ?>"> <button class="btn">EDIT</button> </a> </td>
                     <td> <a href="Delete_Invest.php?invest_id=<?php echo $res['invest_id'] ?>"> <button class="btn">Delete</button> </a> </td>
                  </tr>
                  <?php
                 }
                 ?>
         </tbody>
         </table>
        </section>

        <!-- ====================================== -->
        <br>
        <div>
        <button class="add" onclick="showForm()">Click here to Add Invesment</button>

        <section class="add_invest">
                
                <div class="in_form form-container" id="formContainer">
                    <form action="" method="post">
                        <h2>Add Investment</h2>
                        <label for="amount">Amount:</label>
                        <input type="number" id="amount" name="amount" placeholder="Amount" required>
                        <label for="bank_name">Bank Name:</label>
                        <input type="text" id="bank_name" name="Bank_name" placeholder="Bank Name" required>
                        <label for="interest_rate">Interest Rate:</label>
                        <input type="number" id="interest_rate" name="rate" placeholder="Interest Rate" required>
                        <label for="start_date">Investment Start Date:</label>
                        <input type="date" id="start_date" name="s_date" required>
                        <label for="total_years">Total Investment Years:</label>
                        <input type="number" id="total_years" name="year" placeholder="Total Years" required>
                        <button type="submit" class="btn" name="submit">Add Investment</button>
                    </form>
                </div>
            </section>

            
    <script>
        function showForm() {
            document.getElementById("formContainer").style.display = "block";
        }

        function showForm() {
            document.getElementById("formContainer").style.display = "block";
        }
    </script>

         </div>

        </div>
    </div>
</body>
</html>