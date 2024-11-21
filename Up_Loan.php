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
        
        <section class="add_invest">
                <div class="in_form" id="formContainer">
                            
        <?php
                    include 'connect.php';
                    $loan_id = $_GET['loan_id'];
                    $showQuree = "select * from loans where loan_id = {$loan_id}";
                    $showdata = mysqli_query( $con ,$showQuree);
                    $arrdata = mysqli_fetch_array($showdata);  

                    if(isset($_POST['updatee']))
                    {
                        $amount = $_POST['amount'];
                        $Bank_name = $_POST['Bank_name'];
                        $rate = $_POST['rate'];
                        $s_date = $_POST['s_date'];
                        $e_date = $_POST['e_date'];
               

                        $setvalue_DB  =  "UPDATE `loans` SET `amount`='$amount',`interest_rate`='$rate',`BankName`='$Bank_name',`loan_start_date`='$s_date',`loan_end_date`='$e_date' WHERE `loan_id` = '$loan_id' ";



                        $res = mysqli_query($con ,  $setvalue_DB);
                        if ($res) {
                            echo "<script>alert('Data stored successfully');</script>";
                            header('location:loan.php');
                            exit;
                        } else {
                            echo "<script>alert('Failed to store data');</script>";
                        }
                    }
            ?>


                   
                <form action="" method="post">
                    

            <h2>Update Loan</h2>
            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo $arrdata['amount']; ?>">
            <label for="bank_name">Bank Name:</label>
            <input type="text" id="bank_name" name="Bank_name" value="<?php echo $arrdata['BankName']; ?>">
            <label for="interest_rate">Interest Rate:</label>
            <input type="number" id="interest_rate" name="rate"  value="<?php echo $arrdata['interest_rate']; ?>">
            <label for="start_date">Loan Start Date:</label>
            <input type="date" id="start_date" name="s_date" value="<?php echo $arrdata['loan_start_date']; ?>">

            <label for="start_date">Loan End Date:</label>
            <input type="date" id="start_date" name="e_date" value="<?php echo $arrdata['loan_end_date']; ?>">
    
            <button type="submit" class="btn" name="updatee">Update</button>
           
        </form>
                </div>
            </section>

 

         </div>

        </div>
    </div>
</body>
</html>
