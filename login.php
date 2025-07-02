<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="login">
        
    </form>
    <a href="SingUp.php">SingUp</a>
</body>
</html>
<?php
include 'DB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "select * from users where email = '$email';";
    if ($user =mysqli_fetch_assoc(mysqli_query($conn ,$sql))){
        if(password_verify($password, $user['Password'])){
            $_SESSION['userId'] = $user['Id'];
            $_SESSION['email'] = $user['Email'];
            header('location: Index.php');
        }else{
            echo 'password incorrect';
        }

    }else{
        echo "user not found";
    }

}
?>