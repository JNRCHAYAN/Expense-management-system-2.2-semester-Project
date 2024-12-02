<?php
session_start();
include('bridge.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file_upload'])) {
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filePath = $uploadDir . basename($_FILES['file_upload']['name']);
    if (move_uploaded_file($_FILES['file_upload']['tmp_name'], $filePath)) {
        $_SESSION['uploaded_file_path'] = $filePath; // Store file path in session
        $_SESSION['upload_message'] = "File uploaded successfully!";
    } else {
        $_SESSION['upload_message'] = "Error uploading file.";
    }
} else {
    $_SESSION['upload_message'] = "No file uploaded.";
}

header("Location: index.php"); // Redirect back to the main page
exit();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <!-- file attachment -->
    <form method="POST" action="uploadFile.php" enctype="multipart/form-data">
        <label for="file_upload">Attach a File:</label>
        <input type="file" name="file_upload" id="file_upload" required>
        <button type="submit" name="submit">Submit</button>
    </form>
</body>
</html>