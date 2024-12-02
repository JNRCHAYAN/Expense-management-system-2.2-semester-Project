<?php
session_start();
include('bridge.php');

// Initialize message
$message = "";

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize and validate form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
    $phone_no = isset($_POST['phone_no']) ? $_POST['phone_no'] : '';
    $email_address = isset($_POST['email_address']) ? $_POST['email_address'] : '';

    // Check if all fields are provided
    if (empty($name) || empty($address) || empty($gender) || empty($occupation) || empty($phone_no) || empty($email_address)) {
        $message = "All fields are required.";
    } else {
        // Insert data into the database
        $insertQuery = $connect_to_the_database->prepare("INSERT INTO database_table (name, address, gender, occupation, phone_no, email_address) VALUES (?, ?, ?, ?, ?, ?)");
        $insertQuery->bind_param("ssssss", $name, $address, $gender, $occupation, $phone_no, $email_address);

        if ($insertQuery->execute()) {
            $message = "Data successfully added!";
        } else {
            $message = "Failed to insert the data.";
        }
    }
}

    // Handle record deletion
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id']; // Get the 'id' from the URL

    // Prepare the DELETE query
    // This deletes the record where the 'id' matches the one passed in the URL
    $deleteQuery = $connect_to_the_database->prepare("DELETE FROM database_table WHERE id = ?");
    
    // Bind the 'id' as an integer to the query
    $deleteQuery->bind_param("i", $id); // "i" means integer

    // Execute the DELETE query
    if ($deleteQuery->execute()) {
        $message = "Record successfully deleted!"; // Success message
    } else {
        $message = "Failed to delete the record."; // Error message
    }
}


// Query to fetch data from database
$query = 'SELECT id, name, address, gender, occupation, phone_no, email_address FROM database_table';
$result = $connect_to_the_database->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="content">
        <header>
            <div class="card-header">
                <h2>Heya!!!</h2>
            </div>
        </header>

        <!-- Display message -->
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

        <!-- Table to Display Data -->
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <td colspan="7">Records</td>
                        <td><a href="form.php"><button>Add</button></a></td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Gender</th>
                        <th>Occupation</th>
                        <th>Phone Number</th>
                        <th>Email Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['address']); ?></td>
                        <td><?php echo htmlspecialchars($row['gender']); ?></td>
                        <td><?php echo htmlspecialchars($row['occupation']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['email_address']); ?></td>
                        
                        <td>
                            <div class="button-container">
                            <a href="form.php?id=<?php echo $row['id']; ?>">
                                <button>Edit</button>
                            </a>
                            <a href="?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?')">
                                <button>Delete</button>
                            </a>
                            </div>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='8'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <footer></footer>
    </div>
</body>
</html>

<?php
// Close the database connection
mysqli_close($connect_to_the_database);
?>
