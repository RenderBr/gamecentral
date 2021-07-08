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


$email = $_GET['email'];
$ip = $_SERVER['REMOTE_ADDR'];

$sql = "INSERT INTO registeredEmails (ip, email)
VALUES ('$ip', '$email')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: /?r=1");
?>