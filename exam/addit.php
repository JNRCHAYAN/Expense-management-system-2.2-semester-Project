<?php
session_start();
include("bridge.php"); // Ensure this connects to the database

// Initialize default values
$label = 'Add'; // Default label
$message = '';
$name = $address = $gender = $occupation = $phone_no = $email_address = '';

// Check if this is an edit operation
if (isset($_GET['id'])) {
    $label = 'Edit'; // Change label for edit mode
    $id = $_GET['id']; // Get the ID from the URL

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
    // Get form data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $phone_no = $_POST['phone_no'];
    $email_address = $_POST['email_address'];

    // Initialize error messages
    $email_error = '';

    // Validate the email address
    if (!filter_var($email_address, FILTER_VALIDATE_EMAIL)) {
        $email_error = "Please enter a valid email address."; // Show an error message if invalid
    }

    // Check if all fields are filled and email is valid
    if (!empty($name) && !empty($address) && !empty($gender) && !empty($occupation) && !empty($phone_no) && !empty($email_address) && !$email_error) {
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
        if ($email_error) {
            $message = $email_error; // Display the email validation error
        } else {
            $message = "Please fill in all fields.";
        }
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
        <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>" required><br>

        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender === 'Male') ? 'checked' : ''; ?>
            required>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender === 'Female') ? 'checked' : ''; ?> required>
        <label for="female">Female</label><br>
        <input type="radio" id="other" name="gender" value="Other" <?php echo ($gender === 'Other') ? 'checked' : ''; ?>
            required>
        <label for="other">Other</label><br>

        <label for="occupation">Occupation:</label>
        <select id="occupation" name="occupation" required>
            <option value="" disabled <?php echo empty($occupation) ? 'selected' : ''; ?>>Select Occupation</option>
            <option value="engineer" <?php echo ($occupation === 'engineer') ? 'selected' : ''; ?>>Engineer</option>
            <option value="doctor" <?php echo ($occupation === 'doctor') ? 'selected' : ''; ?>>Doctor</option>
            <option value="others" <?php echo ($occupation === 'others') ? 'selected' : ''; ?>>Others</option>
        </select><br>

        <label for="phone_no">Phone Number:</label>
        <input type="text" id="phone_no" name="phone_no" value="<?php echo $phone_no; ?>" maxlength="11" minlength="11"
            required><br>

        <label for="email_address">Email Address:</label>
        <input type="text" id="email_address" name="email_address" value="<?php echo $email_address; ?>" required><br>

        <input type="submit" name="submit" value="<?php echo $label; ?> Record">
    </form>

    <p><?php echo $message; ?></p>
    <a href="index.php">Back to Records</a>
</body>

</html>


<!-- some index file -->

<?php
session_start();
include('bridge.php'); // Database connection

// Initialize message
$message = "";

// // Handle form submission for adding data
// if (isset($_POST['submit'])) {
//     // Get form inputs
//     $name = $_POST['name'] ?? '';
//     $address = $_POST['address'] ?? '';
//     $gender = $_POST['gender'] ?? '';
//     $occupation = $_POST['occupation'] ?? '';
//     $phone_no = $_POST['phone_no'] ?? '';
//     $email_address = $_POST['email_address'] ?? '';

//     // Check if all fields are filled
//     if (empty($name) || empty($address) || empty($gender) || empty($occupation) || empty($phone_no) || empty($email_address)) {
//         $message = "All fields are required.";
//     } else {
//         // Insert data into the database
//         $query = "INSERT INTO database_table (name, address, gender, occupation, phone_no, email_address) 
//                   VALUES ('$name', '$address', '$gender', '$occupation', '$phone_no', '$email_address')";

//         if (mysqli_query($connect_to_the_database, $query)) {
//             $message = "Data successfully added!";
//         } else {
//             $message = "Failed to insert the data: " . mysqli_error($connect_to_the_database);
//         }
//     }
// }

// Handle record deletion
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $query = "DELETE FROM database_table WHERE id = $id";

    if (mysqli_query($connect_to_the_database, $query)) {
        $message = "Record successfully deleted!";
    } else {
        $message = "Failed to delete the record: " . mysqli_error($connect_to_the_database);
    }
}

// Fetch data from database
$query = "SELECT id, name, address, gender, occupation, phone_no, email_address FROM database_table";
$result = mysqli_query($connect_to_the_database, $query);
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
        <!-- <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?> -->

        <!-- Table to Display Data -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <td colspan="7">#Records</td>
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