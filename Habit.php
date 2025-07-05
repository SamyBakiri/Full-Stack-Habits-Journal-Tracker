<?php
class habit{
    public $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    
    public function get_habits_by_userID($userId){
        $sql = "SELECT * FROM habits WHERE User_Id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i',$userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }
    public function get_habit_info_by_HabitI($habitId){
        $sql = "SELECT * FROM habits WHERE Habit_Id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$habitId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function set_habit($habit_info){
        $sql = "INSERT INTO habits(Name, Description, Start_Date, Start_Time, End_Time, Importance, Frequency,
        User_Id) VALUES('?', '?', '?', '?', '?', '?', '?', '?');";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssssssi", $habit_info['Name'], $habit_info['Description'], $habit_info['Start_date'], 
        $habit_info['Start_Time'], $habit_info['End_Time'], $habit_info['Importance'], $habit_info['Freauency'],
        $_SESSION['UserId']);

        if( $stmt->execute()){
            echo 'habit added successfuly';
        }else{
            echo 'error:' . $this->conn->error;
        }
    }
}

?>