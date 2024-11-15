
<?php
session_start();
?>

<?php
include 'database.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $Email = $_POST['email'];
    $Password = $_POST['password'];

$search="SELECT * FROM `users` WHERE `username` = '$username'";

$quary= mysqli_query($con,$serch);


   
}

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Management System - Profile Edit</title>
    <link rel="stylesheet" href="/css/profileedit.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#dashboard">Dashboard</a></li>
                <li><a href="#expenses">Expenses</a></li>
                <li><a href="#profile" class="active">Profile</a></li>
                <li><a href="#settings">Settings</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>Edit Profile</h1>
            <form id="profile-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required >

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" name="submit">Update Profile</button>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
