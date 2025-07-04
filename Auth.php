<?php
class Auth {
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function login($email, $password){}
    public function logout(){}
    public function regester($email, $firstName, $lastName, $password){}
} 


?>