<?php
    session_start(); //user has to put the right login_password to access the page in the website or to go from the one page to another we use session

    $connect = mysqli_connect("db","meself","DUCKY7pants9joe","moneyman");
?>
<!-- test of the server -->
<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>hello</h1>
    <p>
        <?php 
            // $servername = 'db'; // service name (matches the service name defined in docker-compose)
            // $username = 'meself'; // username
            // $password = 'DUCKY7pants9joe'; // password
            // $dbname = 'moneyman'; // database name

            // $connection = new mysqli($servername, $username, $password, $dbname);

            // if ($connection->connect_error) {
            //     die('connection failed: '. $connection->connect_error);
            // }
            // echo'connected successfully';
        ?>
    </p>
</body>
</html> -->

 