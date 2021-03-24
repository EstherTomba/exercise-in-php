<?php 
  require_once('config/db.php');
  if (!isset($_SESSION['isUser'])) {
    header('location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php include('header.php') ?>  
    <h2>Update Product</h2>
    

    <form name="productAddForm" method="POST" onsubmit="return  productAddValidation()">


        <div class="container">
        <?php include('error.php') ?>
        <?php 
            $productId= $_GET['id'];
            $productQuery="SELECT * FROM product WHERE productId='$productId'";
            $productResult= mysqli_query($con, $productQuery);
            if($productResult) {
                $productData= $productResult->fetch_assoc();
            }

        ?>
            <label for="categoryId"><b>Category</b></label>
            <select name="categoryId" id="categoryId">  
                <option value=""> Select Category</option>
                <?php 
                    $userId= $_SESSION['userId'];
                    $categoryQuery="SELECT * FROM  category WHERE userId='$userId' ORDER BY createdAt DESC";
                    $categoryResult= mysqli_query($con, $categoryQuery);
                    while($row = mysqli_fetch_assoc($categoryResult)) {
                        ?>
                            <option value="<?php echo $row['categoryId'] ?>"><?php echo $row['name'] ?></option>
                        <?php
                    }
                ?>
            </select>
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter  Name" name="name" value="<?php echo $productData['name'] ?>">
            <input type="hidden" name="productId" value="<?php echo $productData['productId'] ?>">

            <label for="description"><b>Description</b></label>
            <textarea name="description" id="description" cols="30" rows="10">
                <?php echo $productData['description'] ?>
            </textarea>
            <button type="submit" name="updateProduct" >Update</button>
        </div>
    </form>
    <form method="POST">
        <input type="hidden" name="productId" id="productId" value="<?php  echo $productData['productId'];  ?>">
        <button style="background-color:red;" type="submit" name="deleteProduct">Delete</button>
    </form>
<script src= "js/validation.js" ></script>
</body>
</html>