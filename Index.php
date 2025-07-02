<?php
session_start();
if(!isset($_SESSION['userId'])){
    header('location: login.php');
}
?>
this is the home page
<a href="Logout.php">logout here</a>