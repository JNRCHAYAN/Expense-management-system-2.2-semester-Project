<?php

include 'connect.php';
$idd = $_GET['id'];

$show = "SELECT * FROM `product` WHERE id =$idd " ;
$que = mysqli_query($con,$show);
$data = mysqli_fetch_array($que);

if(isset($_POST['submit']))
{
    $pname = $_POST['pname'];
    $category = $_POST['category'];
    $sdate = $_POST['sdate'];
    $quantity = $_POST['quantity'];
    $uprice = $_POST['uprice'];

    $q = "INSERT INTO `product`( `productname`, `category`, `stockdate`, `quantity`, `unitprice`) VALUES ('$pname','$category','$sdate','$quantity','$uprice')";


    $q= "UPDATE `product` SET `productname`='$pname',`category`='$category',`stockdate`='$sdate',`quantity`='$quantity',`unitprice`='$uprice' WHERE id = $idd "; 
    
    $run = mysqli_query($con,$q);
    if($run)
    {
        header('location:index.php');
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>

</head>
<body>

    <form action="" method="post" class="form p-3 m-3" >

        <label for="">Product Name</label>
        <input type="text" name="pname" value="<?php echo $data['productname'] ?>">
        <br><br>

        <label for="">Category</label>
        <select name="category" id="">
            <option value="foods"   <?php if($data['category'] == 'foods') echo 'selected'; ?> >Foods</option>

            <option value="electronics"   <?php if($data['category'] == 'electronics') echo 'selected'; ?> >Electronics</option>
            <option value="clothes"   <?php if($data['category'] == 'clothes') echo 'selected'; ?> >clothes</option>
            <option value="beverages"   <?php if($data['category'] == 'beverages') echo 'selected'; ?> >Beverages</option>
            <option value="Skin Cares"   <?php if($data['category'] == 'Skin Cares') echo 'selected'; ?> >Skin Cares</option>
        </select>
    
        <br><br>


        
        <label for="">Stock Date</label>
        <input type="date" name="sdate" value="<?php echo $data['stockdate'] ?>">
        <br><br>
        
        <label for="">Quantity</label>
        <input type="number" name="quantity" value="<?php echo $data['quantity'] ?>">
        <br><br>

        <label for="">Unit Price</label>
        <input type="number" name="uprice" value="<?php echo $data['unitprice'] ?>">
        <br><br>

        <input type="submit" name="submit" class="btn btn-primary p-2 m-2">

    </form>
    
</body>
</html>