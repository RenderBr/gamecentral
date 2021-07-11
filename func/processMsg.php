<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');
session_start();
$name = $_SESSION['username'];

if(isset($_GET['msg'])){
  $message = strip_tags($_GET['msg']);
}
$propermessage = mysqli_real_escape_string($conn,$message);

if(isset($_GET['groupid'])){
  $group = $_GET['groupid'];
}

$sql = "INSERT INTO messages (groupid, message, author)
VALUES ($group, '$propermessage', '$name')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();


?>
