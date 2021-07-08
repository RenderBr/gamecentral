<?php
$servername = "localhost";
$username = "2admin";
$password = "Wv9bGBaolonxw98w";
$dbname = "gamecentral";
session_start();
$name = $_SESSION['username'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$message = strip_tags($_GET['msg']);
$propermessage = mysqli_real_escape_string($conn,$message);
$group = $_GET['groupid'];

$sql = "INSERT INTO messages (groupid, message, author)
VALUES ($group, '$propermessage', '$name')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();


?>