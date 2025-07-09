<?php
class Auth {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function login($email, $password){
        $sql = "SELECT * FROM Users WHERE Email = ?;";
        try{
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if($user = $result->fetch_assoc()){
            if(password_verify($password, $user['Password'])){
                $_SESSION['Email'] = $email;
                $_SESSION['UserId'] = $user['Id'];
                //can add first name and last name later 
                header('location: index.php');
                exit;
            }else{
                $_SESSION['success'] = false;
                $_SESSION['returnMsg'] = 'password incorrect';
                header('location: AuthPage.php');
                exit;
            }
        }else{
            $_SESSION['success'] = false;
            $_SESSION['returnMsg'] = 'user not found';
            header('location: AuthPage.php');
            exit;
        }
    }catch(mysqli_sql_exception $e){
        $_SESSION['success'] = false;
        $_SESSION['returnMsg'] = 'something went wrong :'. $e->getMessage();
    }
}


    public function logout(){
        session_destroy();
        header('location: login.php');
    }

    public function register($email, $firstName, $lastName, $password){
        $sql = "INSERT INTO Users(FirstName, LastName, Email, Password) VALUES(?, ?, ?, ?);";
        try{
        $stmt = $this->conn->prepare($sql);
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bind_param('ssss',$firstName, $lastName, $email, $password_hashed);
        $stmt->execute();
        $_SESSION['success'] = true;
        $_SESSION['returnMsg'] = 'Account created successfuly';
        header('location: AuthPage.php');
        exit;
    }catch(mysqli_sql_exception $e){
        $_SESSION['success'] = false;
        if(str_contains($e->getMessage(), "Duplicate entry")){
            $_SESSION['returnMsg'] = 'this email is used before';
        }else{
            $_SESSION['returnMsg'] = 'something went wrong :'. $e->getMessage();
        }
        header('location: AuthPage.php');
        exit;
    }
} 
}
?>
