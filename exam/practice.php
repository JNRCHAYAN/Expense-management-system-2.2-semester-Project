<?php
session_start();
include('bridge.php');

$message = '';

//handle delete sucmission

if(isset($_GET['user_id'])){
    $id = $_GET['user_id'];

    $query = 'DELETE FROM student WHERE user_id = $id';
    if(mysqli_query($connect_to_the_database, $query)){
        $message = 'deleted successfully';
    }
    else{
        $message = 'Failed: ' .mysqli_error($connect_to_the_database);
    }
}


$query = 'SELECT name, gender, id, department, phone_no, birthday FROM student';
$result = mysqli_query($connect_to_the_database, $query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="content">
        <header></header>
        <div class="table-container">
            <table border="1">
                <thead>
                    <tr>
                        <td colspan="6">
                            <h2>Records</h2>
                        </td>
                        <td><a href="abc.php"><button>Add</button></a></td>
                    </tr>
                    <tr>
                        <th>name</th>
                        <th>gender</th>
                        <th>id</th>
                        <th>department</th>
                        <th>phone_no</th>
                        <th>birthday</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['department']); ?></td>
                                <td><?php echo htmlspecialchars($row['phone_no']); ?></td>
                                <td><?php echo htmlspecialchars($row['birthday']); ?></td>

                                <td>
                                    <a href="abc.php?id=<?php echo $row['user_id']; ?>"><button>Edit</button></a>

                                    <a href="?id=<?php echo $row['user_id']; ?>" onclick = "return confirm('Are you sure you want to delete the record?')"></a><button>Delete</button></a>
                                </td>
                            </tr>

                            <?php
                        }
                    } else {
                        echo '<tr><td colspan="7">"No record found!"</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>