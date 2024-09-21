<!-- <?php

$test = mysqli_connect('localhost','root','', );

if(!$test)
{
    die('could no connected : '.mysqli_error());
}

else
{
    echo "Connected !";
}

?> -->


<?php
$server = "localhost";
$username = "rot";
$password = "";
$database_name = "project";

$con = mysqli_connect($server,$username,$password,$database_name);

if($con)
{
    ?>
    <script>
        alert("Connection Successfull");
    </script>
    <?php
}
else
{
    ?>
    <script>
        alert("Not Connected");
    </script>
    <?php  
}


?>