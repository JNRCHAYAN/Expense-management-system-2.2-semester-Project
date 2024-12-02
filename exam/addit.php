<?php
session_start();
include('bridge.php'); // Make sure this is connecting properly to the database

// Default values for the form
$label = 'Add'; 
$name = $address = $gender = $occupation = $phone_no = $email_address = '';
$message = '';

// Check if there's an ID for editing an existing record
if (isset($_GET['id'])) {
    // If an ID is passed, it's an edit operation
    $label = 'Edit';
    $id = $_GET['id'];

    // Fetch the existing data for the given ID
    $query = "SELECT * FROM database_table WHERE id = $id";
    $result = mysqli_query($connect_to_the_database, $query);
    $row = mysqli_fetch_assoc($result);

    // Populate form fields with existing data
    if ($row) {
        $name = $row['name'];
        $address = $row['address'];
        $gender = $row['gender'];
        $occupation = $row['occupation'];
        $phone_no = $row['phone_no'];
        $email_address = $row['email_address'];
    }
}

// Form submission handling for add or edit
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $phone_no = $_POST['phone_no'];
    $email_address = $_POST['email_address'];

    // Validate if fields are filled
    if (!empty($name) && !empty($address) && !empty($gender) && !empty($occupation) && !empty($phone_no) && !empty($email_address)) {
        if ($label === 'Add') {
            // Insert new data if it's the "Add" mode
            $query = "INSERT INTO database_table (name, address, gender, occupation, phone_no, email_address) 
                      VALUES ('$name', '$address', '$gender', '$occupation', '$phone_no', '$email_address')";
        } else {
            // Update data if it's the "Edit" mode
            $query = "UPDATE database_table SET 
                        name = '$name', address = '$address', gender = '$gender', occupation = '$occupation', 
                        phone_no = '$phone_no', email_address = '$email_address' WHERE id = $id";
        }

        // Execute the query
        if (mysqli_query($connect_to_the_database, $query)) {
            $message = ($label === 'Add') ? "Data successfully added!" : "Data successfully updated!";
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
    <title><?php echo $label; ?> Data</title>
</head>
<body>
    <h2><?php echo $label; ?> Data</h2>

    <div class="form-container">
        <form method="POST" action="">
            <header>
                <?php echo $label; ?> Data
            </header>
            <div class="input">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?php echo $address; ?>" required>

                <label for="gender">Gender</label>
                <input type="text" id="gender" name="gender" value="<?php echo $gender; ?>" required>

                <label for="occupation">Occupation</label>
                <input type="text" id="occupation" name="occupation" value="<?php echo $occupation; ?>" required>

                <label for="phone_no">Phone Number</label>
                <input type="text" id="phone_no" name="phone_no" value="<?php echo $phone_no; ?>" required>

                <label for="email_address">Email Address</label>
                <input type="text" id="email_address" name="email_address" value="<?php echo $email_address; ?>" required>

                <!-- <input type="submit" name="submit" value="<?php echo $label; ?> Data"> -->
                 
                    <button type="submit" name="submit"><?php echo $label; ?> Record</button>
                
                
            </div>
            <footer>
                <a href="index.php">Back to Records</a>
            </footer>
        </form>
    </div>

    <p><?php echo $message; ?></p>

</body>
</html>
