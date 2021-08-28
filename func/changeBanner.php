<?php
//Start the session
session_start();
//Get username from session variable
$user = $_SESSION['username'];
//Retrieve banner
$banner = htmlspecialchars($_POST['b'], ENT_QUOTES, 'UTF-8');

//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's banner image
$sql = "UPDATE users SET bannerImage='$banner' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's banner has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's banner: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();
//Close the connection
?>
