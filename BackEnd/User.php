<?php
session_start();
class User{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function get_user_info_by_email($email){
        $sql = "SELECT * FROM Users WHERE Email = ? ;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }


    public function set_email($newEmail, $password){
        $currentEmail = $_SESSION['Email'] ;
        $sql = "UPDATE Users SET Email = ? WHERE Email = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss",$currentEmail, $newEmail);
        if($stmt->execute()){
            echo"email changed successfully";
        }else{
            echo "error :". $this->conn->error;
        }
    }


    public function set_password($currentPassword, $newPassword){
        if(password_verify($currentPassword, $this->get_user_info_by_email($_SESSION['Email'])['Password'])){
            $sql = "UPDATE Users SET Password = ? WHERE Email = ?;";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("ss",$newPassword, $_SESSION['Email']);
            if($stmt->execute()) {
                echo 'password changed successfully';
            }else{
                echo 'error :'. $this->conn->error;
            }
        }else{
            echo 'incorrect password';
        }
    }


    public function set_firstName($newfirstName){
        $sql = "UPDATE Users SET FirstName = ? WHERE Email = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss",$newfirstName, $_SESSION['Email']);
        if($stmt->execute()){
            echo 'first name changed successfully';
        }else{
            echo 'error'. $this->conn->error;
        }
    }
    
    public function set_lastName($newlastName){
    $sql = "UPDATE Users SET LastName = ? WHERE Email = ?;";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ss",$newlastName, $_SESSION['Email']);
    if($stmt->execute()){
            echo 'last name changed successfully';
        }else{
            echo 'error'. $this->conn->error;
        }
    }
}
?>