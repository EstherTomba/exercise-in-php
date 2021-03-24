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
    <a href="product-add.php" style="color: white;">
        <button> 
           Add Product
        </button>
      </a>
      <?php  include('success.php')?>

      
    <table id="customers">
        <tr>
          <th>Product Name</th>
          <th>Category Name</th>
          <th>Date</th>
          
        </tr>
        <?php 
            $productQuery = "SELECT category.name AS categoryName, product.name AS productName, product.categoryId, product.productId,
            product.description,product.createdAt 
            FROM product INNER JOIN category ON product.categoryId=category.categoryId  ORDER BY  product.createdAt DESC";
            $productResult= mysqli_query($con,$productQuery);
            while($row = mysqli_fetch_assoc($productResult)) {
                ?> 
                    <tr>
                        <td> <a href="product-update.php?id=<?php echo $row['productId'] ?>"><?php echo $row['productName'] ?></a> </td>
                        <td>  <?php echo $row['categoryName'] ?></td>
                        <td><?php echo date("M D Y", strtotime($row['createdAt']))?></td>
                    </tr>
                <?php
            }
        ?>
    </table>
  </body>
  </html>