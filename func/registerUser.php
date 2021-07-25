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

$birthyear = $_POST['year'];
$birthday = $_POST['day'];
$birthmonth = $_POST['month'];
$password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');
$username = htmlspecialchars($_POST['username'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

$dateOfBirth = $birthyear . "-" . $birthmonth . "-" . $birthday;

$hashedpass = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, email, password, dateOfBirth)
VALUES ('$username', '$email', '$hashedpass', '$dateOfBirth')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: /login");
?>
