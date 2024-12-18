<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: index.html'); 
    exit();
}
$u = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investment Overview</title>
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">

        <div class="navigation">
            <h2>Menu</h2>
            <ul>
            <li><a href="home.php"><span class="icon"> 🏠</span> Home</a></li>
                <li><a href="income.php"><span class="icon">💰</span> Income</a></li>
                <li><a href="Expanse.php"><span class="icon">📊</span> Expenses</a></li>
                <li><a href="saving.php"><span class="icon">💲</span> Savings</a></li>
                <li><a href="loan.php"><span class="icon">💵</span> Loan</a></li>
                <li><a href="investment.php"  class="active"><span class="icon">💱</span> Investment</a></li>
                <li><a href="profile_Edit.php"><span class="icon">⚙️</span> Settings</a></li>
                <div class="log"><a href="logout.php">Logout</a></div>
            </ul>
        </div>

        <div class="main">
        
        <section class="add_invest">
                <div class="in_form" id="formContainer">
                            
        <?php
                    include 'connect.php';
                    $error = "";
                    $invest_id = $_GET['invest_id'];
                    $showQuree = "select * from invest where invest_id={$invest_id}";
                    $showdata = mysqli_query( $con ,$showQuree);
                    $arrdata = mysqli_fetch_array($showdata);  

                    if(isset($_POST['updatee']))
                    {
                        $s_id = $_GET['invest_id'];
                        $amount = $_POST['amount'];
                        $Bank_name = $_POST['Bank_name'];
                        $rate = $_POST['rate'];
                        $s_date = $_POST['s_date'];
                        $year = $_POST['year'];
                        $user_id = $u;
                        if($amount >0){
                            if($rate>0)
                            {

                                $setvalue_DB= "UPDATE `invest` SET `amount`='$amount',`BankName`='$Bank_name',`Interest`='$rate',`Invest_Start`='$s_date',`Total_Years`='$year' WHERE `invest_id` = '$s_id'";
                                $res = mysqli_query($con ,  $setvalue_DB);
                                if ($res) {
                                    header('location:investment.php');
                                    exit;
                                } 
                            }
                            else
                            {
                                $error= "Please put Interest Rate rate then 0";
                            }
                        }
                        else
                        {
                            $error= "Please put Amount then 0";
                        }   
                    }
            ?>


                    <h2>Update Investment</h2>
                                <a href="investment.php">
                        <button id="backb">
                         Back
                       </button>
                        </a>
                        <br><br>
                   
                <form action="" method="post">
                    

            <label for="amount">Amount:</label>
            <input type="number" id="amount" name="amount" value="<?php echo $arrdata['amount']; ?>">
            <label for="bank_name">Bank Name:</label>
            <input type="text" id="bank_name" name="Bank_name" value="<?php echo $arrdata['BankName']; ?>">
            <label for="interest_rate">Interest Rate:</label>
            <input type="number" id="interest_rate" name="rate"  value="<?php echo $arrdata['Interest']; ?>">
            <label for="start_date">Investment Start Date:</label>
            <input type="date" id="start_date" name="s_date" value="<?php echo $arrdata['Invest_Start']; ?>">
            <label for="total_years">Total Investment Years:</label>
            <input type="number" id="total_years" name="year" value="<?php echo $arrdata['Total_Years']; ?>">
            <button type="submit" class="btn" name="updatee">Update</button>
           
        </form>
        <?php if ($error): ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php endif; ?>
                </div>
            </section>

 

         </div>

        </div>
    </div>
</body>
</html>
