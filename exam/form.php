<?php
session_start();
include("bridge.php"); // Ensure this connects to the database

// Initialize default values
$label = 'Add'; // Default label for form
$message = ''; // Message to display feedback
$name = $address = $gender = $occupation = $phone_no = $email_address = '';

// Check if this is an edit operation
if (isset($_GET['id'])) {
    $label = 'Edit'; // Change label for edit mode
    $id = $_GET['id']; // Ensure ID is an integer

    // Fetch the existing record
    $query = "SELECT * FROM database_table WHERE id = $id";
    $result = mysqli_query($connect_to_the_database, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $address = $row['address'];
        $gender = $row['gender'];
        $occupation = $row['occupation'];
        $phone_no = $row['phone_no'];
        $email_address = $row['email_address'];
    } else {
        $message = "Invalid record ID.";
    }
}

// Handle form submission
if (isset($_POST['submit'])) {
    // Get form data and sanitize
    $name = $_POST['name'] ?? '';
    $address = $_POST['address'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $occupation = $_POST['occupation'] ?? '';
    $phone_no = $_POST['phone_no'] ?? '';
    $email_address = $_POST['email_address'] ?? '';

    // Validate required fields
    if (!empty($name) && !empty($address) && !empty($gender) && !empty($occupation) && !empty($phone_no) && !empty($email_address)) {
        if ($label === 'Add') {
            // Insert a new record
            $query = "INSERT INTO database_table (name, address, gender, occupation, phone_no, email_address) 
                      VALUES ('$name', '$address', '$gender', '$occupation', '$phone_no', '$email_address')";
        } else {
            // Update an existing record
            $query = "UPDATE database_table SET 
                      name = '$name', address = '$address', gender = '$gender', 
                      occupation = '$occupation', phone_no = '$phone_no', email_address = '$email_address' 
                      WHERE id = $id";
        }

        // Execute the query
        if (mysqli_query($connect_to_the_database, $query)) {
            $message = "Record successfully " . ($label === 'Add' ? "added!" : "updated!");
            header("Location: index.php");
            exit();
        } else {
            $message = "Error: " . mysqli_error($connect_to_the_database);
        }
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $label; ?> Record</title>
    <link rel="stylesheet" href="./style.css">
</head>

<body>
    <h2><?php echo $label; ?> Record</h2>
    
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" required><br>

        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?> required>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?> required>
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="gender" value="Other" <?php echo ($gender === 'Other') ? 'checked' : ''; ?> required>
        <label for="other">Other</label><br>

        <label for="occupation">Occupation:</label>
        <select id="occupation" name="occupation" required>
            <option value="" disabled <?php echo empty($occupation) ? 'selected' : ''; ?>>Select Occupation</option>
            <option value="engineer" <?php echo ($occupation === 'engineer') ? 'selected' : ''; ?>>Engineer</option>
            <option value="doctor" <?php echo ($occupation === 'doctor') ? 'selected' : ''; ?>>Doctor</option>
            <option value="others" <?php echo ($occupation === 'others') ? 'selected' : ''; ?>>Others</option>
        </select><br>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" value="<?php echo htmlspecialchars($phone_no); ?>" maxlength="11" minlength="11" required><br>

        <label for="email_address">Email Address:</label>
        <input type="email" id="email_address" name="email_address" value="<?php echo htmlspecialchars($email_address); ?>" required><br>

        <input type="submit" name="submit" value="<?php echo $label; ?> Record">
    </form>

    <p><?php echo $message; ?></p>
    <a href="index.php">Back to Records</a>
</body>

</html>
