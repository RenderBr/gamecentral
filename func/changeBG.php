<?php
//Start the session
session_start();
//Get username from session variable
$user = $_SESSION['username'];
//Get background
$bg = htmlspecialchars($_POST['b'], ENT_QUOTES, 'UTF-8');
//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's BG
$sql = "UPDATE users SET bg='$bg' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's BG has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's BG: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();

?>
