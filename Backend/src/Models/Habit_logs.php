<?php
namespace app\Models;

class Habit_logs{
    private $db;

    public function __construct($db) {
        $this->$db = $db;
    }

    public function find($habitID, $date){
        $sql = "SELECT * FROM habit_logs WHERE Habit_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is",$habitID, $date);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function all($habitID){
        $sql = "SELECT * FROM habit_logs WHERE Habit_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $habitID);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($habitID, $date, $data){
        $sql = "UPDATE habit_logs SET Status = ?, Note = ?, Mood = ?,
        Time = ? WHERE Habit_Id = ?, AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", $data['Status'], $data['Note'], $data['Mood'], $data['Time']);
        
        return $stmt->execute();
    }

    public function create($habitID, $date, $data){
        $sql = "INSERT INTO habit_logs(Status, Note, Mood, Date, Time,
        Habit_id) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssi", $data['Status'], $data['Note'], $data['Mood'],
        $date, $data['Time'], $habitID);
        
        return $stmt->execute();
    }
}