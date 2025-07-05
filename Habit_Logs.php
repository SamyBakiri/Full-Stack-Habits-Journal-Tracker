<?php
class habit_logs{
    public $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function set_habit_log($habitLogInfo){
        $sql = "INSERT INTO habit_logs( Status, Note, Mood, Date, Time,
        Habit_Id) VALUES('?', '?', '?', '?', '?', '?');";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssi', $habitLogInfo['Status'], $habitLogInfo['Note'], $habitLogInfo['Mood'],
        $habitLogInfo['Date'], $habitLogInfo['Time'], $habitLogInfo['Habit_Id']);
        if ($stmt->execute()) {
            echo 'habit_log added successfuly';
        }else{
            echo 'error: '. $this->conn->error;
        }
    }

    public function get_habit_logs_by_habitID($habitId) {
        $sql = "SELECT * FROM habit_logs WHERE Habit_Id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$habitId);
        $stmt->execute();
        return $result = $stmt->get_result();
    }
}
?>