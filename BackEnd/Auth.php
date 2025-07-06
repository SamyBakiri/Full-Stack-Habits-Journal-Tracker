<?php
class Auth {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function login($email, $password){
        $sql = "SELECT * FROM Users WHERE Email = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($user = $result->fetch_assoc()){
            if(password_verify($password, $user['Password'])){
                session_start();
                $_SESSION['Email'] = $email;
                $_SESSION['UserId'] = $user['Id'];
                //can add first name and last name later 
                header('location: index.php');
            }else{
                echo 'password incorrect';
            }
        }else{
            echo 'user not found';
        }
    }


    public function logout(){
        session_destroy();
        header('location: login.php');
    }

    public function regester($email, $firstName, $lastName, $password){
        $sql = "INSERT INTO Users(FirstName, LastName, Email, Password) VALUES('?', '?', '?', '?');";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss',$firstName, $lastName, $email, $password);
        if ($stmt->execute()){
            echo 'account created successfuly';
        }else{
            echo 'error:'. $this->conn->error;
        }
    }
} 
?>
