<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


</head>
<body>
    <br>
    <a href="add.php" class="btn btn-primary ">Add Data</a>
    <br>
    <br>
<table border="2px">
<thead >
    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Category</th>
        <th>Stock Date</th>
        <th>Quantity</th>
        <th>Unit Price</th>
        <th colspan="2">Opration</th>
    </tr>
</thead>
<tbody>
   <?php
    include 'connect.php';

    $q = "SELECT * FROM `product`;";
    $run = mysqli_query($con,$q);
    while($data = mysqli_fetch_array($run))
    {
        ?>
        <tr>
            <td><?php echo $data['id'] ?></td>
            <td><?php echo $data['productname'] ?></td>
            <td><?php echo $data['category'] ?></td>
            <td><?php echo $data['stockdate'] ?></td>
            <td><?php echo $data['quantity'] ?></td>
            <td><?php echo $data['unitprice'] ?> Taka</td>
            <td><a href="edit.php?id=<?php echo $data['id']?>"><button class="btn btn-primary">Edit</button></a></td>
            <td><a  href="delete.php?id=<?php echo $data['id']?>" onclick="return confirm('Are you sure you want to delete this record?');">
            <button class="btn btn-primary">Delete</button> </a>
             </td>
             
        </tr>




        <?php
    }



   ?>
</tbody>


</table>

</body>
</html>