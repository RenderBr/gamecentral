<?php
include_once('../cfg/conn.php');
$newPassword = htmlspecialchars($_POST['pswd'], ENT_QUOTES, 'UTF-8');
$user = $_POST['user'];
$token = $_POST['token'];

$hashedpass = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "SELECT * FROM forgetPasswordTokens WHERE token = '$token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
  }
}else{
  header("Location: /login");
}

$sql = "UPDATE users SET password='$hashedpass' WHERE username='$user'";

if ($conn->query($sql) === TRUE) {
  header("Location: /login");
} else {
  echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
