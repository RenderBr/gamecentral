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

$regToken = $_POST['regToken'];
$birthyear = $_POST['year'];
$birthday = $_POST['day'];
$birthmonth = $_POST['month'];
$password = $_POST['password'];
$username = $_POST['username'];
$email = $_POST['email'];

$dateOfBirth = $birthyear . "-" . $birthmonth . "-" . $birthday;

$hashedpass = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password, dateOfBirth)
VALUES ('$username', '$email', '$hashedpass', '$dateOfBirth')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql = "UPDATE regTokens set used=1 WHERE token = '$regToken'";


if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
header("Location: /login");
?>