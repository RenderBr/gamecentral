<?php
session_start();
$user = $_SESSION['username'];
$banner = $_POST['b'];
include_once('../cfg/conn.php');

$sql = "UPDATE users SET bannerImage='$banner' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's banner has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's banner: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>
