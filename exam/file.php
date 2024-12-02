<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
</head>
<body>
   <br>
<table class="table table-bordered table-gray table-hover" >
    <thead >
        <tr> 
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Occupation</th>
            <th>Email</th>
            <th colspan="2">Opreation</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'database.php';

        $slq = "SELECT * FROM `user`;";
        $q = mysqli_query($con,$slq);

        while($r = mysqli_fetch_array($q))
        { 
            ?>
            <tr>
                <td><?php echo $r['ID']?></td>
                <td><?php echo $r['name']?></td>
                <td><?php echo $r['address']?></td>
                <td><?php echo $r['gender']?></td>
                <td><?php echo $r['occupation']?></td>
                <td><?php echo $r['email']?></td>
                <td><a href="edit.php?id=<?php echo $r['ID'] ?>"><button class="btn btn-primary">EDIT</button></a>
            </td>

                <td><a href="delete.php?id=<?php echo $r['ID']?>"><button class="btn btn-primary">Delete</button></a></td>
             
            </tr>
            <?php
        }
        
        ?>
    </tbody>
    <br>
    <br>
    <br>
    <a href="Add.php"><button class="btn btn-primary">ADD New User</button></a>
    <br><br>



</table>
</body>
</html>