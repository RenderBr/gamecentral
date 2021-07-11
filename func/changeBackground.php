<?php
session_start();
$user = $_SESSION['username'];
$bg = $_POST['bg'];
include_once('../cfg/cdns.php');

$sql = "UPDATE users SET bg='$bg' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's background has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's background: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>

