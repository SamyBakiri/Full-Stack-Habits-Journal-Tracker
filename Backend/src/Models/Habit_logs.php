<?php
namespace App\Models;

class Habit_logs{
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function find($habitID, $date){
        $sql = "SELECT * FROM habit_logs WHERE Habit_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is",$habitID, $date["Date"]);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function all(){
        $sql = "SELECT * FROM habit_logs ;";
        return $this->db->query($sql)->fetch_all(MYSQLI_ASSOC);
    }

    public function allById($habitID){
        $sql = "SELECT * FROM habit_logs WHERE Habit_Id = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $habitID);
        
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function update($habitID, $data){
        $sql = "UPDATE habit_logs SET Status = ?, Note = ?, Mood = ?,
        Time = ? WHERE Habit_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssssss", $data['Status'], $data['Note'], $data['Mood'], $data['Time'],
        $habitID, $data["Date"]);
        
        return $stmt->execute();
    }

    public function create($habitID, $data){
        $sql = "INSERT INTO habit_logs(Status, Note, Mood, Date, Time,
        Habit_id) VALUES(?, ?, ?, ?, ?, ?);";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sssssi", $data['Status'], $data['Note'], $data['Mood'],
        $data["Date"], $data['Time'], $habitID);
        
        return $stmt->execute();
    }

    public function delete($habitID, $data){
        $sql = "DELETE FROM habit_logs WHERE Habit_Id = ? AND Date = ?;";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("is",  $habitID, $data["Date"]);
        return $stmt->execute();
    }
}