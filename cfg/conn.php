<?php
$servername = "localhost";
$username = "2admin";
$password = "Wv9bGBaolonxw98w";
$dbname = "gamecentral";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 
 ?>
