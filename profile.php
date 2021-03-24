<?php 
  require_once('config/db.php');
    if (!isset($_SESSION['isUser'])) {
        header('location: index.php');
    }
    $userId=$_SESSION['userId'];
    $profileQuery="SELECT * FROM  user WHERE userId='$userId'";
    $profileResult= mysqli_query($con, $profileQuery);
    if($profileResult) {
        $profileData= $profileResult->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profile</title>
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
<?php include('header.php') ?>   
    <h2>Profile</h2>

    <form name="profileForm"  method="post"onsubmit="return profileValidation()" >

        <div class="container">
        <div>
                <?php include("error.php") ?>
                <?php include("success.php") ?>
            </div>
            <label for="firstName"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="firstName" value="<?php echo $profileData['firstName'] ?>">
            <label for="lastName"><b>LastName</b></label>
            <input type="text" placeholder="Enter Last Name" name="lastName" value= "<?php  echo $profileData['lastName']?>">
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter email" name="email" value= "<?php  echo $profileData['email']?>">
            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter Address" name="address" value= "<?php  echo $profileData['address']?>">

            <button type="submit" name="updateProfile">Update Profile</button>
        </div>
    </form>
</body>
<script src= js/header.js></script>
<script src= js/validation.js></script>
</html>