<?php
namespace app\Models;

class Journal{
    private $db;
    
    public function __construct( $db) {
        $this->db = $db;
    }

    public function create($userId, $date, $data){
        $sql = "INSERT INTO journal_note(Date, Journal, User_Id) VALUES(?, ?, ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssi",$date, $data['Journal'], $userId);
        
        return $stmt->execute();
    }

    public function update($userId, $date, $data){
        $sql = "UPDATE journal_note SET Journal = ? WHERE User_Id = ?, Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sis", $data['Journal'], $userId, $date);

        return $stmt->execute();
    }

    public function all(){
        $sql = "SELECT * FROM journal_note;";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }


    public function allByUser($userId){
        $sql = "SELECT * FROM journal_note WHERE User_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);

        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function find($userId, $date){
        $sql = "SELECT * FROM journal_note WHERE User_Id = ?, Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is", $userId, $date);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function delete($userId, $date){
        $sql = "DELETE FROM journal_note WHERE User_Id = ?, Date = ?;";
        $stmt = $this->db->prepare("is", $userId, $date);
        
        return $stmt->execute();
    }
    
}