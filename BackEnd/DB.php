<?php
$host = 'localhost';
$username = 'root';
$password = '';
$DB_Name = 'habit_Tracker';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn = new mysqli($host, $username, $password, $DB_Name);
if($conn->connect_error){
    die("Connection failed");
}
?>