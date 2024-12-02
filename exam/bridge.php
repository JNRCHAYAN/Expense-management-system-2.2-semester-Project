<?php
    $username = "root";        // Default username for MySQL in XAMPP
    $password = "";            // Default password is usually empty
    $server = 'localhost';     // Refers to the local webserver (usually XAMPP or WAMP)
    $database = 'database_name'; // Replace with the actual name of your database

    // Establish connection
    $connect_to_the_database = mysqli_connect($server, $username, $password, $database);

    // Check the connection
    // if (!$connect_to_the_database) {
    //     die("Connection failed: " . mysqli_connect_error());
    // } else {
    //     echo "Connected successfully!";
    // }
?>
