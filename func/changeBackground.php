<?php
//Start the session
session_start();
//Retrieve username from session variable
$user = $_SESSION['username'];
//Retrieve BG url from POST request
$bg = htmlspecialchars($_POST['bg'], ENT_QUOTES, 'UTF-8');

//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's BG
$sql = "UPDATE users SET bg='$bg' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's background has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's background: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();
//Close the connection
?>
