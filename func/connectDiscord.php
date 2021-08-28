<?php
//Start session
session_start();
//Get username from session variable
$user = $_SESSION['username'];
//Get discord tag from POST
$discord = htmlspecialchars($_POST['discord'], ENT_QUOTES, 'UTF-8');

//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's discord
$sql = "UPDATE users SET discord='$discord' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's Discord account has been successfully changed!";
	header("Location: /settings");
}else{
	echo "There was an error changing this user's Discord account: " . $conn->error;
	header("Location: /settings?e=1");
}
$conn->close();
//Close the connection
?>
