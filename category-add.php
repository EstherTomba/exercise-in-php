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
    <title>Add Category</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php include('header.php') ?>   
    <h2>Add Category</h2>

    <form name="categoryAddForm" method="POST" onsubmit="return categoryAddValidation()">


        <div class="container">
            <div>
                <?php include("error.php") ?>
            </div>
            <label for="name"><b> Name</b></label>
            <input type="text" placeholder="Enter Name" name="name" id="name">
            <button type="submit" name="addCategory">Save</button>
        </div>
    </form>
    <script src="js/validation.js"></script>
</body>
</html>