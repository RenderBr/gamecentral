<?php
//Start the session
session_start();
//Get username from session variable
$user = $_SESSION['username'];
//Get twitch username from POST
$twitch = htmlspecialchars($_POST['twitch'], ENT_QUOTES, 'UTF-8');
//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's twitch
$sql = "UPDATE users SET twitch='$twitch' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's Twitch account has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's Twitch account: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();
//Close the connection
?>
