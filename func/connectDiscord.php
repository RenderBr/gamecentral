<?php
session_start();
$user = $_SESSION['username'];
$discord = htmlspecialchars($_POST['discord'], ENT_QUOTES, 'UTF-8');

include_once('../cfg/cdns.php');

$sql = "UPDATE users SET discord='$discord' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's Discord account has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's Discord account: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>
