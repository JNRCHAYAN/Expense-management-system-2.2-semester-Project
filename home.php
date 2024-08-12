<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>My Email Address : <?php  echo  $_SESSION['email']; ?> </h1>
    <h1>My name : <?php  echo  $_SESSION['name']; ?> </h1>

    <a href="logout.php">logout</a>
</body>
</html>