<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "test";

$con = new mysqli($servername, $username, $password, $database);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Handle image upload
    $imageName = $_FILES['image']['name'];
    $imageData = file_get_contents($_FILES['image']['tmp_name']); // Read the image content
    $imageType = $_FILES['image']['type']; // Get the image MIME type

    // Validate file type
    if (substr($imageType, 0, 5) === "image") {
        // Insert data into the database
        $stmt = $con->prepare("INSERT INTO user (name, email, image) VALUES (?, ?, ?)");
        $stmt->bind_param("ssb", $name, $email, $null);

        $stmt->send_long_data(2, $imageData); // Send binary image data
        if ($stmt->execute()) {
            echo "Image uploaded and saved in the database successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Please upload a valid image file.";
    }
}

$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Upload Image</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" class="form-control" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
            <br>
            <label for="image">Select Image:</label>
            <input type="file" name="image" accept="image/*" class="form-control" required>
            <br>
            <input type="submit" name="submit" value="Upload" class="btn btn-primary">
        </form>
    </div>
</body>
</html>

