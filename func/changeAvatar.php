<?php
// Start the user session
session_start();
// retrieve user to update
$user = $_SESSION['username'];
// get avatar URL from POST
$avatar = htmlspecialchars($_POST['a'], ENT_QUOTES, 'UTF-8');

//Include mysqldb passthrough
include_once('../cfg/conn.php');

//Update user's avatar to url retrieved
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
