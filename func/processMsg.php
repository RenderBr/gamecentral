<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');
session_start();
$name = $_SESSION['username'];
$isCom = $_GET['isCom'];
$isDM = $_GET['isDM'];
if(isset($_GET['msg'])){
  $message = htmlspecialchars($_GET['msg'], ENT_QUOTES, 'UTF-8');
}
$propermessage = mysqli_real_escape_string($conn,$message);

if(isset($_GET['groupid'])){
  $group = $_GET['groupid'];
}
$sql = "SELECT id FROM users WHERE username = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $userId = $row['id'];
  }
} else {
  echo "0 results";
}

$sql = "SELECT username FROM users WHERE id = '$group'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $foundName = $row['username'];
  }
} else {
  echo "0 results";
}


if($isCom == "true"){
  $sql = "INSERT INTO messages (communityid, message, author, authorId)
  VALUES ($group, '$propermessage', '$name', $userId)";
}
if($isDM == "true"){
  $conn->query("INSERT INTO messages (userId, message, author, authorId)
  VALUES ($group, '$propermessage', '$name', $userId)");
  $dmId = $conn->insert_id;
  $sql = "INSERT INTO notifications (type, user, associatedId)
  VALUES ('DM', '$foundName', '$dmId')";
}

if(!isset($isDM) && !isset($isCom)){
  $sql = "INSERT INTO messages (groupid, message, author, authorId)
  VALUES ($group, '$propermessage', '$name', $userId)";
}


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();


?>
