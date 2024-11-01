<?php
$username = "root";
$password = "";
$server = 'localhost';
$db = 'expense_management';
$con = mysqli_connect($server,$username,$password,$db);
if($con)
{
   
    ?>
    <script>
        alert('Connection Successful');
    </script>
    <?php
}
else
{
 echo "No Connection";
 die("No connection" .mysqli_connect_error());

}
?>