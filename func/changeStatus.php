<?php
session_start();
$user = $_SESSION['username'];
$status = htmlspecialchars($_POST['s'], ENT_QUOTES, 'UTF-8');
include_once('../cfg/cdns.php');

$sql = "UPDATE users SET status='$status' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
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
