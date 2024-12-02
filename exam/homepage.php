<?php
include 'bridge.php';

$query = "SELECT * FROM users";
$result = $conn->query($query);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>User Management</h1>
    <button onclick="window.location.href='form.php'">Add User</button>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Occupation</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['gender']) ?></td>
            <td><?= htmlspecialchars($row['occupation']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>
                <a href="form.php?id=<?= $row['id'] ?>">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
