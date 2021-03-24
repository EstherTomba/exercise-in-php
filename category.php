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
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <?php include('header.php') ?>  
  <a href="category-add.php" style="color: white;">
  <button> 
Add Category
  </button>
</a>
  <table id="customers">
  <div>
                <?php include("success.php") ?>
            </div>
      <tr>
        <th>Category</th>
        <th>Date</th>
      </tr>

      <?php 
      $userId= $_SESSION['userId'];
        $categoryQuery="SELECT * FROM category WHERE userId='$userId' ORDER BY createdAt DESC";
        $categoryResult= mysqli_query($con, $categoryQuery);
        while($row = mysqli_fetch_assoc($categoryResult)){
            ?>
                <tr>
                    <td><a href="category-update.php?id=<?php echo $row['categoryId'] ?>"><?php echo $row['name'] ?></a></td>
                    <td><?php echo date("Y-M-D", strtotime($row['createdAt']))?></td> 
                </tr>
            <?php
        }
      ?>       
  </table>
</body>
</html>