// LOGIN VALIDATION
function loginValidation() {
    var uname = document.forms["loginForm"]["uname"].value;   
    var psw = document.forms["loginForm"]["psw"].value; 
    if(uname == '') {
        alert("User Name is required");
        document.loginForm.uname.focus();
        return false;
    }else if(psw == '') {
        alert("Password is required");
        document.loginForm.psw.focus();
        return false;
    } 
}
// CREATE ACCOUNT VALIDATION
function createAccountValidation() {
    var fname = document.forms["createAccountForm"]["fname"].value;
    var lname = document.forms["createAccountForm"]["lname"].value;
    var email = document.forms["createAccountForm"]["email"].value;
    var address = document.forms["createAccountForm"]["address"].value;
    var password = document.forms["createAccountForm"]["password"].value;
    var confirmPassword = document.forms["createAccountForm"]["confirmPassword"].value;
    if(fname == '') {
        alert("First Name is required");
        document.createAccountForm.fname.focus();
        return false;
    }else if(lname == '') {
        alert("Last Name is required");
        document.createAccountForm.lname.focus();
        return false;
    }else if(email == '') {
        alert("Email is required");
        document.createAccountForm.email.focus();
        return false; 
    }else if(address == '') {
        alert("Address is required");
        document.createAccountForm.address.focus();
        return false;   
    }else if(password == '') {
        alert("Password is required");
        document.createAccountForm.password.focus();
        return false;   
    }else if(confirmPassword == '') {
        alert("Conform Password");
        document.createAccountForm.confirmPassword.focus();
        return false;
    } else if(password != confirmPassword) {
        alert("Passwords do not match");
        document.createAccountForm.confirmPassword.focus();
        return false;
    }
}
function profileValidation() {
    var firstName = document.forms["profileForm"]["firstName"].value;
    var lastName = document.forms["profileForm"]["lastName"].value;
     var email = document.forms["profileForm"]["email"].value;
     var address = document.forms["profileForm"]["address"].value;

    if(firstName == '') {
        alert("First Name is required");
        document.profileForm.firstName.focus();
        return false;
    }else if(lastName == '') {
        alert("Last Name is required");
        document.profileForm.lastName.focus();
        return false; 
    }else if(email == '') {
        alert("Email is required");
        document.profileForm.email.focus();
        return false;
    }else if(address == '') {
        alert("Address is required");
        document.profileForm.address.focus();
        return false;
    }
}
// ADD CATEGORY VALIDATION
 function categoryAddValidation() {
    var name = document.forms["categoryAddForm"]["name"].value;
    if(name == '') {
        alert("Name is required");
        document.categoryAddForm.name.focus();
        return false;  
    }
}
// ADD PRODUCT VALIDATION
 function productAddValidation() {
    var categoryId = document.forms["productAddForm"]["categoryId"].value; 
    var name = document.forms["productAddForm"]["name"].value;  
    var description = document.forms["productAddForm"]["description"].value; 
    if(categoryId == ''){
        alert("Category Name is required");
        document.productAddForm.categoryId.focus();
        return false; 
    }else if(name == '') {
        alert(" Name is required");
        document.productAddForm.name.focus();
        return false; 
    }else if(description == '') {
        alert(" Description is required");
        document.productAddForm.description.focus();
        return false; 
    }
 }