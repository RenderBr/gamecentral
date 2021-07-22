<?php
session_start();
$user = $_SESSION['username'];
$avatar = htmlspecialchars($_POST['a'], ENT_QUOTES, 'UTF-8');

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
