<?php require_once("config/db.php");
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Login Form</h2>


    <form name="loginForm" method="POST" onsubmit="return loginValidation()">
        <div class="container">
            <div>
                <?php include("error.php") ?>
                <?php include("success.php") ?>
            </div>
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" >

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw">

            <button type="submit" name="login">Login</button>
        </div>

        <div class="container" style="background-color:#f1f1f1">

            <span class="psw"><a href="create-account.php">Create Account</a></span>
        </div>
    </form>
</body>
<script src="js/validation.js"></script>
</html>