<?php
//Start the session
session_start();
//Retrieve username from session variable
$user = $_SESSION['username'];
//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update user's notifs to seen all
$sql = "UPDATE notifications SET seen='1' WHERE user = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's notifications have been successfully cleared!";
}else{
	echo "User's notifications could not be cleared: " . $conn->error;
}
$conn->close();
//Close the connection
?>
