<?php
$host = 'localhost';
$username = 'root';
$password = '';
$DB_Name = 'Habits_and_Journal_Tracker';

$conn = new mysqli($host, $username, $password, $DB_Name);
if($conn->connect_error){
    die("Connection failed");
}
?>