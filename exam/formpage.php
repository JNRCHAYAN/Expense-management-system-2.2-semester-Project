<?php
session_start();
include 'bridge.php';

$name = $address = $gender = $occupation = $email = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $gender = $conn->real_escape_string($_POST['gender']);
    $occupation = $conn->real_escape_string($_POST['occupation']);
    $email = $conn->real_escape_string($_POST['email']);

    if (!$name || !$address || !$gender || !$occupation || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'All fields are required and email must be valid.';
    } else {
        if ($id) {
            // Update user
            $query = "UPDATE users 
                      SET name='$name', address='$address', gender='$gender', occupation='$occupation', email='$email' 
                      WHERE id=$id";
        } else {
            // Insert user
            $query = "INSERT INTO users (name, address, gender, occupation, email) 
                      VALUES ('$name', '$address', '$gender', '$occupation', '$email')";
        }
        $conn->query($query);
        header('Location: index.php');
        exit;
    }
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
    $name = $user['name'];
    $address = $user['address'];
    $gender = $user['gender'];
    $occupation = $user['occupation'];
    $email = $user['email'];
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Form</title>
</head>
<body>
    <h1><?= isset($_GET['id']) ? 'Edit User' : 'Add User' ?></h1>
    <?php if ($error): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>
    <form method="post">
        <input type="hidden" name="id" value="<?= $_GET['id'] ?? '' ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>
        <label>Address:</label>
        <textarea name="address" required><?= htmlspecialchars($address) ?></textarea>
        <label>Gender:</label>
        <label><input type="radio" name="gender" value="Male" <?= $gender === 'Male' ? 'checked' : '' ?>> Male</label>
        <label><input type="radio" name="gender" value="Female" <?= $gender === 'Female' ? 'checked' : '' ?>> Female</label>
        <label><input type="radio" name="gender" value="Others" <?= $gender === 'Others' ? 'checked' : '' ?>> Others</label>
        <label>Occupation:</label>
        <select name="occupation" required>
            <option value="" disabled <?= !$occupation ? 'selected' : '' ?>>Select</option>
            <option value="Doctor" <?= $occupation === 'Doctor' ? 'selected' : '' ?>>Doctor</option>
            <option value="Engineer" <?= $occupation === 'Engineer' ? 'selected' : '' ?>>Engineer</option>
            <option value="Teacher" <?= $occupation === 'Teacher' ? 'selected' : '' ?>>Teacher</option>
            <option value="Banker" <?= $occupation === 'Banker' ? 'selected' : '' ?>>Banker</option>
            <option value="Others" <?= $occupation === 'Others' ? 'selected' : '' ?>>Others</option>
        </select>
        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($email) ?>" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
