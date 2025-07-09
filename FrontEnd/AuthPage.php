<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HabTrack - Log in or sign up</title>
    <link rel="stylesheet" href="Style/Main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
/>


</head>
<body>  
    <div class="fullpage">
        <div class="leftside">
            <a class="title mobile_title" href="#">
                <img src="Assets/habits.png" alt="logo" srcset="">
                <h1>HabTrack</h1>
            </a>
        </div>
        <div class="rightside">
            <a class="title desktop_title" href="#">
                <img src="Assets/habits.png" alt="logo" srcset="">
                <h1>HabTrack</h1>
            </a>
        </div>
        <div class="formCard">
            <div class="formChoice">
                <button  id="signup" type="button">Sign Up</button>
                <button class="buttonOFF" id="signin" type="button">Sign in</button>
            </div>
            <p>Create an account</p>
            <form class="form" action="" method="post" onsubmit="return form_validation">
                <div class="nameContainer">
                    <div class="input_container">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="fname"  id="fname" placeholder="First Name" required >
                    </div>
                    <div class="input_container">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                    </div>
                    
                </div>
                <div class="input_container">
                    <i class="fa-solid fa-envelope long_input_icon"></i>
                    <input type="email" name="email" id="email" placeholder="Email"  required>
                </div>
                <div class="input_container">
                    <i class="fa-solid fa-key long_input_icon"></i>
                    <input type="password" name="password" id="password" placeholder="Password"  required>
                </div>
                
                <div class="input_container">
                    <i class="fa-solid fa-key long_input_icon"></i>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" name="register">Register</button>
                <p class="have_account">Already have an account? <a href="#">login</a></p>
            </form>

        </div>

    </div>
    
    <script src="Auth_Page.js"></script>
</body>
</html>
<?php
include '../BackEnd/Auth.php';
include '../BackEnd/DB.php';
session_start();
if(isset($_SESSION['success'])){
    echo $_SESSION['returnMsg'];
    unset($_SESSION['success']);
    unset($_SESSION['returnMsg']);
    
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth($conn);
    if(isset($_POST['register'])){
        $auth->register($_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['password']);
    }
    if(isset($_POST['login'])){
        $auth->login($_POST['email'], $_POST['password']);
    }
    echo $msg;
}
?>