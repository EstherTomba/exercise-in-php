<?php
    session_start();
    $errors = array();

    $host = "localhost";
    $user = "root";
    $password = "";
    $dbname = "exercise";

    // Create connection
    $con = mysqli_connect($host, $user, $password,$dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    //USER LOGIN
    if(isset($_POST['createAccount'])) {
        $fname = mysqli_real_escape_string($con, $_POST['fname']);
        $lname = mysqli_real_escape_string($con, $_POST['lname']);
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $address  = mysqli_real_escape_string($con, $_POST['address']);
        $password = mysqli_real_escape_string($con, $_POST['password']);
        $role = "User";
        // CHECK IF THERE IS ALREADY A USER WITH THAT EMAIL
        $checkUserQuery  = "SELECT * FROM user WHERE email='$email' LIMIT 1";
        $checkUserResult = mysqli_query($con, $checkUserQuery);
        $user = mysqli_fetch_assoc($checkUserResult);
        if($user) {
            if($user['email'] == $email ){
                array_push($errors, "Email already exists.");
            }
        }
        // CHECK IF THERE IS NO ERROR, CREATE THE USER
        if(count($errors) == 0 ){
            $hashedPassword = crypt($password, "salt@#.com");
            $creatUserQuery = "INSERT INTO user (firstName,lastName,email,address,role,password) VALUES
            ('$fname', '$lname','$email','$address','$role','$hashedPassword')";
            $creatUserResult = mysqli_query($con, $creatUserQuery);
            if($creatUserResult) {
                $_SESSION['success'] = "Account created successfully";
                header('Location: index.php');
            } else {
                array_push($errors, "Error, Could not create the account.");
            }
        }
    }


    // LOGIN
    if(isset($_POST['login'])) {
        $uname= mysqli_real_escape_string($con, $_POST['uname']);
        $psw= mysqli_real_escape_string($con, $_POST['psw']);
        $hashedPassword= crypt($psw,'salt@#.com');

        $loginQuery="SELECT * FROM user WHERE email='$uname' AND password='$hashedPassword' LIMIT 1";
        $loginResult= mysqli_query($con,$loginQuery);
        if(mysqli_num_rows($loginResult) == 1) {
            $user = mysqli_fetch_assoc($loginResult);
            if($user['role'] == "Admin") {
                $_SESSION['isAdmin'] = $user['role'];
                $_SESSION['userId'] = $user['userId'];
                header('Location: admin.php');
            } else if($user['role'] == "User") {
                $_SESSION['isUser'] = $user['role'];
                $_SESSION['userId'] = $user['userId'];
                header('Location: category.php');
            } else { 
                array_push($errors, "Sorry this account does not have privilege");
            }
        }else {
            array_push($errors, "Wrong Email or Password");
        }
    }


    // UPDATE PROFILE

    if(isset($_POST['updateProfile'])) {
        $firstName= mysqli_real_escape_string($con, $_POST['firstName']);
        $lastName= mysqli_real_escape_string($con, $_POST['lastName']);
        $email= mysqli_real_escape_string($con, $_POST['email']);
        $address= mysqli_real_escape_string($con, $_POST['address']);
        $userId = $_SESSION['userId'];
        $profileQuery="UPDATE user SET firstName='$firstName',lastName='$lastName',email='$email',address='$address' WHERE userId='$userId'";
        $profileResult= mysqli_query($con,$profileQuery);
        if($profileResult) {
            $_SESSION['success'] = "Profile Updated successfully";
        }else {
            array_push($errors,"error could not update your profile");
        }
    }

    // ADD CATEGORY
    if(isset($_POST['addCategory'])) {
        $name= mysqli_real_escape_string($con, $_POST['name']);
        $userId= $_SESSION['userId'];
        $categoryQuery= "SELECT * FROM category WHERE name='$name' AND userId='$userId' LIMIT 1";
        $categoryResult= mysqli_query($con,$categoryQuery);
        $categoryData= mysqli_fetch_assoc($categoryResult);
        if($categoryData) {
            if($categoryData['name'] == $name) {
               array_push($errors,"Name already exists");
            }
        }
        if(count($errors) == 0) {
            $addCategoryQuery= "INSERT INTO category (name,userId) VALUES ('$name','$userId')";
            $addCategoryResult= mysqli_query($con, $addCategoryQuery);
            if($addCategoryResult) {
                $_SESSION['success'] ="Category added successfully";
                header('location: category.php');
            } else {
                array_push($errors,"Errors, cannot create category");
            }
        }



    }

    // ADD PRODUCT 
    if(isset($_POST['addProduct'])) {
        $categoryId= mysqli_real_escape_string($con, $_POST['categoryId']); 
        $name= mysqli_real_escape_string($con, $_POST['name']);   
        $description= mysqli_real_escape_string($con, $_POST['description']);  
        $userId = $_SESSION['userId'];
        $productQuerry ="SELECT * FROM product WHERE name='$name' AND userId='$userId' LIMIT 1"; 
        $productResult= mysqli_query($con,$productQuerry);
        $productData= mysqli_fetch_assoc($productResult);
        if($productData) {
           if($productData['name'] == $name) {
               array_push($errors,"Name already exists");
           }
        }
        if(count($errors)== 0) {
            $addProductQuery = "INSERT INTO  product (name,categoryId,description,userId) VALUES('$name','$categoryId','$description','$userId')" ;
            $addProductResult= mysqli_query($con,$addProductQuery);
            if($addProductResult) {
                $_SESSION['success'] ="Product added successfully";
                header('location: product.php');

            }else{
                array_push($errors,"Errors, cannot create product");
            }
        }
    }


    if(isset($_POST['updateCategory'])) {
        $name= mysqli_real_escape_string($con, $_POST['name']);
        $categoryId= mysqli_real_escape_string($con, $_POST['categoryId']);
        $categoryQuery="UPDATE category SET name='$name' WHERE categoryId='$categoryId'";
        $categoryResult= mysqli_query($con,$categoryQuery);
        if($categoryResult) {
            $_SESSION['success'] = "Category Updated successfully";
            header('location: category.php');
        }else {
            array_push($errors,"error could not update your profile");
        }
    }


    if(isset($_POST['deleteCategory'])) {
        $categoryId= mysqli_real_escape_string($con, $_POST['categoryId']);
        $productQuerry ="DELETE FROM product WHERE categoryId='$categoryId'"; 
        $productResult= mysqli_query($con,$productQuerry);
        if($productResult) {
            $categoryQuery="DELETE FROM category WHERE categoryId='$categoryId'";
            $categoryResult= mysqli_query($con,$categoryQuery);
            if($categoryResult) {
                $_SESSION['success'] = "Category delete successfully";
                header('location: category.php');
            }else {
                array_push($errors,"error could not delete your profile");
            }
        }else {
            array_push($errors,"error could not delete your profile");
        } 
    }


    if(isset($_POST['updateProduct'])) {
        $productId= mysqli_real_escape_string($con, $_POST['productId']);
        $categoryId= mysqli_real_escape_string($con, $_POST['categoryId']);
        $name= mysqli_real_escape_string($con, $_POST['name']);
        $description= mysqli_real_escape_string($con, $_POST['description']);
        $productQuery= " UPDATE product SET name='$name', categoryId='$categoryId', description='$description' WHERE productId='$productId'";
        $productResult= mysqli_query($con,$productQuery);
        if($productResult) {
            $_SESSION['success'] = "Product updated successfully";
            header('location: product.php');
        }else {
            array_push($errors,"error could not update your product $productQuery");
        }
    }
    if(isset($_POST['deleteProduct'])) {
        $productId= mysqli_real_escape_string($con, $_POST['productId']);
        $productQuery="DELETE FROM product WHERE productId='$productId' ";
        $productResult= mysqli_query($con, $productQuery);
        if($productResult) {
           $_SESSION['success'] = "Product deleted successfully";
           header('location: product.php'); 
        }else {
            array_push($errors,"error could not deleted your product ");
        }
    }

 ?>

 