<?php

// ame  product name table create korse and database name user

include 'connect.php';

if(isset($_POST['submit']))
{
    $pname = $_POST['pname'];
    $category = $_POST['category'];
    $sdate = $_POST['sdate'];
    $quantity = $_POST['quantity'];
    $uprice = $_POST['uprice'];

    if($quantity > 0 )
    {
        if($uprice>0)
        {
            $q = "INSERT INTO `product`( `productname`, `category`, `stockdate`, `quantity`, `unitprice`) VALUES ('$pname','$category','$sdate','$quantity','$uprice')";
    
            $run = mysqli_query($con,$q);
            if($run)
            {
                header('location:index.php');
            }

        }
        else 
        {
            echo "Please add uprice is greater then 0";

        }
       
    }
    else
    {
        echo "Please add quantity is greater then 0";
    }

    
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
</head>
<body>

    <form action="" method="post" class="form p-3 m-3" >

        <label for="">Product Name</label>
        <input type="text" name="pname" required>
        <br><br>

        
        <label for="">Category</label>
        <select name="category" id="" required>
            <option value="foods">Foods</option>
            <option value="electronics">Electronics</option>
            <option value="clothes">Clothes</option>
            <option value="beverages">Beverages</option>
            <option value="Skin Cares">Skin Cares</option>
        </select>
    
        <br><br>

        <label for="">Stock Date</label>
        <input type="date" name="sdate" required>
        <br><br>

        <label for="">Quantity</label>
        <input type="number" name="quantity" required>
        <br><br>

        <label for="">Unit Price</label>
        <input type="number" name="uprice" required>
        <br><br>

        <input type="submit" name="submit" class="btn btn-primary p-2 m-2">

    </form>
    
</body>
</html>