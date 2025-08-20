<?php
namespace app\Models;
class User{
    private $Db_conn;

    public function __construct($db){
        $this->Db_conn = $db;
    }

    public function find($id){
        $sql = "SELECT * FROM users WHERE User_Id = ?;";
        $stmt = $this->Db_conn->prepare($sql);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function all(){
        $sql = "SELECT * FROM users;";
        return $this->Db_conn->query($sql)->fetch_assoc();
    }

    public function create($data){
        $sql = "INSERT INTO users(FirstName, LastName, Email, Password)
        values(?, ?, ?, ?);";
        $stmt = $this->Db_conn->prepare($sql);
        $stmt->bind_param('ssss',$data['FirstName'], $data['LastName'], $data['Email'], password_hash($data['Password'],PASSWORD_DEFAULT));
        return $stmt->execute();
    }

    public function update($id, $data){
        $sql = "UPDATE users SET FirstName = ?, LastName = ?, Email = ?, Password = ? WHERE User_Id = ?;";
        $stmt = $this->Db_conn->prepare($sql);
        $stmt->bind_param('ssssi',$data['FirstName'], $data['LastName'], $data['Email'], password_hash($data['Password'],PASSWORD_DEFAULT), $id);
        return $stmt->execute();
    }

    public function delete($id){
        $sql = "DELETE FROM users WHERE User_Id = ?;";
        $stmt = $this->Db_conn->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

}