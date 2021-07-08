<?php
session_start();
$user = $_SESSION['username'];
$avatar = $_POST['a'];
include_once('../cfg/cdns.php');

$sql = "UPDATE users SET avatar='$avatar' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's avatar has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's avatar: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>

