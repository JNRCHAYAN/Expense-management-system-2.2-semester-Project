<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$con = new mysqli($servername, $username, $password, $database);

$sql = "SELECT name, email, image FROM user";
$result = $con->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<p>Name: " . $row['name'] . " | Email: " . $row['email'] . "</p>";
    echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "' style='width: 100px; height: auto;'><br>";
}
?>