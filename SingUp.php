<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="text" name="firstName" placeholder="First Name">
        <input type="text" name="lastName" placeholder="Last Name">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="SignUp">
        <a href="login.php">Login</a>
    </form>
</body>
</html>
<?php
include 'DB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "insert into users(First_Name, Last_Name, Email, Password) values ('$firstName', '$lastName',
    '$email', '$password');";
    if(mysqli_query($conn, $sql)){
        echo'account created succesfuly';
    }else{
        echo'error :'.mysqli_error($conn);
    }

}

?>