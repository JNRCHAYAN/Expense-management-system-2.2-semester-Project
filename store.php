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
   
   $setvalue_db = "INSERT INTO `savings`(`user_id`,`amount`, `BankName`, `Interest`, `Invest_Start`, `Total_Years`) 
   VALUES ('$user_id','$amount','$Bank_name','$rate','$s_date','$year'); ";

    $res = mysqli_query($con ,  $setvalue_db);

    if($res)
    {
        ?>
        <script>
            alert('Data store');
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert('Not Store');
        </script>
        <?php
    }
}
?>