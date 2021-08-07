<?php
session_start();
$user = $_SESSION['username'];
$twitch = htmlspecialchars($_POST['twitch'], ENT_QUOTES, 'UTF-8');

include_once('../cfg/cdns.php');

$sql = "UPDATE users SET twitch='$twitch' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's Twitch account has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's Twitch account: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>
