<?php
//Start session
session_start();
//Get username from session variable
$user = $_SESSION['username'];
//Get status from POST
$status = htmlspecialchars($_POST['s'], ENT_QUOTES, 'UTF-8');

//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's status
$sql = "UPDATE users SET status='$status' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	//Add to feedpost with user's new status
	$conn->query("INSERT INTO feedPosts (userProfile, poster, messageContents, messageType) VALUES
	('$loggedUser', '$loggedUser', '$status', 'statusUpdate')");
	echo "User's status has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's status: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>
