<?php
namespace app\Models;

class Habit{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($userId, $data){
        $sql = "INSERT INTO habits(Name, Description, Start_Date,
        Start_Time, End_Time, Importance, Frequency, User_Id) VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssssii", $data['Name'], $data['Description'], $data['Start_Date'],
        $data['Start_Time'], $data['End_Time'], $data['Importance'], $data['Frequency'], $userId);
        
        return $stmt->execute();
    }
    
    public function find($habitId){
        $sql = "SELECT * FROM habits WHERE Habit_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $habitId);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function all(){
        $sql = "SELECT * FROM habits ;";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }


    
    public function allByUser($userId){
        $sql = "SELECT * FROM habits WHERE User_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($habitId, $data){
        $sql = "UPDATE habits SET Name = ?, Description = ?, Start_Date = ?, Start_Time = ?,
        End_Time = ?, Importance = ?, Frequency = ?  WHERE Habit_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssssii", $data['Name'], $data['Description'], $data['Start_Date'],
        $data['Start_Time'], $data['End_Time'], $data['Importance'], $data['Frequency'], $habitId);
        
        return $stmt->execute();
    }
    
    public function delete($habitId){
        $sql = "DELETE FROM habits WHERE Habit_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $habitId);
        return $stmt->execute();
    }



}