<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');
session_start();
$name = $_SESSION['username'];
$isCom = $_GET['isCom'];
if(isset($_GET['msg'])){
  $message = htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8');
}
$propermessage = mysqli_real_escape_string($conn,$message);

if(isset($_GET['groupid'])){
  $group = $_GET['groupid'];
}
if($isCom == "true"){
  $sql = "INSERT INTO messages (communityid, message, author)
  VALUES ($group, '$propermessage', '$name')";
}else{
  $sql = "INSERT INTO messages (groupid, message, author)
  VALUES ($group, '$propermessage', '$name')";
}


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();


?>
