<?php
session_start();
include('bridge.php'); // Database connection

// Initialize message
$message = "";

// Handle record deletion
if (isset($_GET['id'])) {
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
        <?php if ($message): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>

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