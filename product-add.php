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
    <h2>Add Product</h2>

    <form name="productAddForm" method="POST" onsubmit="return  productAddValidation()">


        <div class="container">
        <div>
                <?php include("error.php") ?>
            </div>
            <label for="categoryId"><b>Category</b></label>
            <select name="categoryId" id="categoryId"> 
                <option value="">Select Category</option>
               <?php 
                    $userId=$_SESSION['userId'];
                    $categoryQuery = "SELECT * FROM category WHERE userId='$userId' ORDER BY createdAt DESC"; 
                    $categoryResult= mysqli_query($con,$categoryQuery);
                    while($row= mysqli_fetch_assoc($categoryResult)){
                        ?>
                            <option value="<?php echo $row['categoryId'] ?>"><?php echo $row['name'] ?></option>
                        <?php 
                    }
               ?>

            </select>
            <label for="name"><b>Name</b></label>
            <input type="text" placeholder="Enter  Name" name="name" >

            <label for="image">Image</label>
            <input type="file" name="image">

            <label for="description"><b>Description</b></label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <button type="submit" name="addProduct" >Save</button>
        </div>
    </form>
<script src= "js/validation.js" ></script>
</body>
</html>