<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "<h1>Welcome, $username!</h1>";
} 
?>