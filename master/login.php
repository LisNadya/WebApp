<?php
include "db/conn.php";
session_start(); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    $user = $_POST["usertype"];
    $userID = $userPass = $table = $insertVar = $location = "";
    // let by default be customer
    $userID = "cusID";
    $userPass = "cusPass";
    $table = "customer";
    $insertVar = "cusID, cusName, cusPass, cusEmail, cusContact";
    $location = "available_cars.php";
    
    if($user==1){
        $userID = "vendorID";
        $userPass = "vendorPass";
        $table = "vendor";
        $insertVar = "vendorID, vendorName, vendorPass, vendorEmail, vendorContact";
        $location = "vendor-dashboard.php";
    }
    else if($user==2){
        $userID = "adminID";
        $userPass = "adminPass";
        $table = "admin";
        $insertVar = "adminID, adminName, adminPass, adminEmail, adminContact";
        $location = "cartype.php";
    }


    if($_POST["action"]=="login"){
        $valid = true;
        $username = $_POST["username"];
        $pass = $_POST["password"];

        //check if username exists
        $conn = $DB->connect();
        $getUsername = $conn->query("select $userID from $table where $userID = '$username'");
        $conn->close();

        if($getUsername->num_rows == 0){
            $userErr_login = "Username does not exist";
            $valid = false;
        }

        if($valid){
            $conn = $DB->connect();
            $sql = "select $userID from $table where $userID = '$username' and $userPass = '$pass' LIMIT 1";
            $query = $conn->query($sql);
            $conn->close();
            if( !empty($query) && $query->num_rows > 0){
                while($row = $query->fetch_assoc()){
                    $_SESSION['userType'] = $user;
                    $_SESSION['userID'] = $row[$userID];
                    $_SESSION['login'] = true;
                    header("Location: $location");
                }
            }
            else{ //username or password is incorrect
                $userErr_login = "Incorrect username or password";
            }
        }
        
    }
    else if($_POST["action"]=="register"){
        $valid = true;
        $username = $_POST['username'];
        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $pass = $_POST['password'];
        $passConfirm = $_POST['confirmPassword'];

        //check username
        $conn = $DB->connect();
        $getUsername = $conn->query("select $userID from $table where $userID = '$username'");
        $conn->close();
        if($getUsername->num_rows > 0){
            $userErr_reg = "Username already exists";
            $valid = false;
        }
        if(preg_match('/\s/',$username)){
            $userErr_reg = "Blank spaces are not allowed in your username";
            $valid = false;
        }
        //check full name
        if(!preg_match("/[a-z]/i", $fullName)) {
            $nameErr = "Only alphabets are allowed in your name";
            $valid = false;
        }
        //check password
        if($pass != $passConfirm){
            $passErr_reg = "Password are not identical";
            $valid = false;
        }
        //check email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $valid = false;
        }
        //check phone number
        if(!preg_match("/^[0-9.]+$/", $contact) || preg_match('/\s/',$contact)) {
            $contactErr = "Invalid contact number format";
            $valid = false;
        }
        if($valid){
            $conn = $DB->connect();
            $sql = "INSERT INTO $table ($insertVar) VALUES ('$username', '$fullName', '$pass', '$email', '$contact')";
            $query = $conn->query($sql);
            $noRows = $conn->affected_rows;
            
            $conn->close();
            if ($noRows <1){
               $formErr = "Registration was not successful";
            }
            else{
               header("Location: $location");
            }
        }
    }
    
}
?>
<!DOCTYPE html>
<html lang='en'>
<head lang='en'>
   <meta charset='utf-8'>
   <meta content='width=device-width, initial-scale=1' name='viewport' />
   
   <link href='https://fonts.googleapis.com/css?family=Montserrat&display=swap' rel='stylesheet'>
   <title>Login</title>
   <!--    Custom styles   -->
   <link rel="icon" href="img/logo.jpg">
   <link rel='stylesheet' href='css/reset.css' />
   <link rel='stylesheet' href='css/default.css' />
   <link rel='stylesheet' href='css/login.css' />
   <script src="js/login.js"></script>
   <style>
    select{
        width:100%;
    }
    input,.error{
        width:96%;
    }
   </style>
</head>
<body>
    <section id='leftSide'>
        <form action='login.php' method='post' id="login">
            <fieldset id='loginForm'>
                <h1>Login</h1>
                <select name='usertype' class="loginRequired">
                    <option value=''>User Type</option>
                    <option value='0'>Customer</option>
                    <option value='1'>Vendor</option>
                    <option value='2'>Admin</option>
                </select>
                <?php 
                    if(isset($userErr_login) && !empty($userErr_login)){ 
                        echo "<div class='error'>⚠ $userErr_login</div>"; 
                    } 
                ?>
                <input type='text' name='username' placeholder='Username' class="loginRequired">
            

                <input type='password' name='password' placeholder='Password' class="loginRequired">
                
                
                <button type='submit' onclick="loginCheck()" name='action' value='login'>Log In <span class='raquo'>&raquo;</span></button>
            </fieldset>
        </form>
    </section>
    <section id='rightSide' style='overflow-y:auto;'>
        <form action='login.php' method='post' id="registration">
            <fieldset id='registerForm' >
                <p>Not a member yet?</p>
                <h1>Create Account</h1>

                <?php 
                    if(isset($formErr) && !empty($formErr)){ 
                        echo "<div class='error'>⚠ $formErr</div>";
                    } 
                ?>
                <select name='usertype' class="registerRequired">
                    <option value=''>User Type</option>
                    <option value='0'>Customer</option>
                    <option value='1'>Vendor</option>
                    <option value='2'>Admin</option>
                </select>

                <?php 
                    if(isset($userErr_reg) && !empty($userErr_reg)){ 
                        echo "<div class='error'  style='font-size:10pt; padding:2%;'>⚠ $userErr_reg</div>";
                    } 
                ?>
                <input type='text' name='username' title='Example: SamMendes95' placeholder='Username' class="registerRequired">
                <?php 
                    if(isset($nameErr) && !empty($nameErr)){ 
                        echo "<div class='error'>⚠ $nameErr</div>";
                    } 
                ?>
                <input type='text' name='fullName' title='If you are a vendor, place the full name of your manager' placeholder='Full Name' class="registerRequired">
                <?php 
                    if(isset($emailErr) && !empty($emailErr)){ 
                        echo "<div class='error'>⚠ $emailErr</div>";
                    } 
                ?>
                <input type='email' name='email' title='Example: abc123@gmail.com' placeholder='Email Address' class="registerRequired">
                <?php 
                    if(isset($contactErr) && !empty($contactErr)){ 
                        echo "<div class='error'>⚠ $contactErr</div>";
                    } 
                ?>
                <input type='tel' name='contact' title='Example: 01112345678' placeholder='Contact No.' class="registerRequired">
                <input type='password' name='password'  placeholder='Password' required>
                <?php 
                    if(isset($passErr_reg) && !empty($passErr_reg)){ 
                        echo "<div class='error'>⚠ $passErr_reg</div>";
                    } 
                ?>
                <input type='password' name='confirmPassword' placeholder='Confirm Password' class="registerRequired">
                
                <button type='submit' onclick="registerCheck()" name='action' value='register'>Create Account <span class='raquo'>&raquo;</span></button>
            </fieldset>
        </form>
    </section>
</body>
</html>