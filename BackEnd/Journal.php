<?php
class journal{
    public $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    
    public function set_journal($journal_info) {
        $sql = "INSERT INTO journal_note(Date, Journal, User_Id) VALUES(?, ?,
        ?);";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi",$journal_info['Date'], 
        $journal_info['Journal'], $journal_info['User_Id']);
        if($stmt->execute()) {
            echo 'journal set successfuly';
        }else{
            echo 'error:' . $this->conn->error;
        }
    }

    public function get_journal_by_userId($userId){
        $sql = "SELECT * FROM journal_note WHERE User_Id = ?;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$userId);
        $stmt->execute();
        return $result = $stmt->get_result;
    }
}
?>