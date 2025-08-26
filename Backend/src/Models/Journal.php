<?php
namespace App\Models;

class Journal{
    private $db;
    
    public function __construct( $db) {
        $this->db = $db;
    }

    public function create($userId, $data){
        $sql = "INSERT INTO journal_note(Date, Journal, User_Id) VALUES(?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi",$data["Date"], $data['Journal'], $userId);
        
        return $stmt->execute();
    }

    public function update($userId, $data){
        $sql = "UPDATE journal_note SET Journal = ? WHERE User_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sis", $data['Journal'], $userId, $data["Date"]);

        return $stmt->execute();
    }

    public function all(){
        $sql = "SELECT * FROM journal_note;";
        $result = $this->db->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function allByUser($userId){
        $sql = "SELECT * FROM journal_note WHERE User_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);

        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function find($userId, $data){
        $sql = "SELECT * FROM journal_note WHERE User_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $userId, $data["Date"]);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function delete($userId, $data){
        $sql = "DELETE FROM journal_note WHERE User_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $userId, $data["Date"]);
        return $stmt->execute();
    }
    
}