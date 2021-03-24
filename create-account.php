<?php require_once("config/db.php");
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Create Account</h2>

    <form name="createAccountForm" method="POST" onsubmit="return createAccountValidation()">
       
        <div class="container">
            <div>
                <?php include("error.php") ?>
            </div>
            <label for="fname"><b>First Name</b></label>
            <input type="text" placeholder="Enter First Name" name="fname">
            <label for="lname"><b>LastName</b></label>
            <input type="text" placeholder="Enter Last Name" name="lname">
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter email" name="email">
            <label for="address"><b>Address</b></label>
            <input type="text" placeholder="Enter address" name="address">
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password">
            <label for="conformPassword"><b>Conform Password</b></label>
            <input type="password" placeholder="Conform Password" name="confirmPassword">


            <button type="submit" name="createAccount">Create Account</button>

        </div>
    </form>
</body>
<script src="js/validation.js"></script>
</html>