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
    <title>Update Category</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php include('header.php') ?>   
    <h2>Update Category</h2>

    <form name="categoryAddForm" method="POST" onsubmit="return categoryAddValidation()">
        <div class="container">
            <?php 
                  $categoryId  = $_GET['id'];
                  $categoryQuery="SELECT * FROM  category WHERE categoryId='$categoryId'";
                  $categoryResult= mysqli_query($con, $categoryQuery);
                  if($categoryResult) {
                      $categoryData= $categoryResult->fetch_assoc();
                  }
            ?>
            <label for="name"><b> Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name" value="<?php  echo $categoryData['name'];  ?>">
            <input type="hidden" name="categoryId" id="categoryId" value="<?php  echo $categoryData['categoryId'];  ?>">
            <button type="submit" name="updateCategory">Update</button>
        </div>
    </form>
    <form method="POST">
        <input type="hidden" name="categoryId" id="categoryId" value="<?php  echo $categoryData['categoryId'];  ?>">
        <button style="background-color:red;" type="submit" name="deleteCategory">Delete</button>
    </form>
    <script src="js/validation.js"></script>
</body>
</html>