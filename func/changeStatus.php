<?php
session_start();
$user = $_SESSION['username'];
$status = $_POST['s'];
include_once('../cfg/cdns.php');

$sql = "UPDATE users SET status='$status' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's status has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's status: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>
