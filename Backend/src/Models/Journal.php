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

    public function all($userId){
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
    
}