<?php
//Start the session
session_start();
//Get username from session variable
$user = $_SESSION['username'];
//Retrieve message ID from POST
$messageId = htmlspecialchars($_POST['mid'], ENT_QUOTES, 'UTF-8');

//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Update notification to be set to seen
$sql = "UPDATE notifications SET seen='1' WHERE type = 'DM' AND associatedId = '$messageId'";

if($conn->query($sql) === TRUE){

}
$conn->close();
//Close the connection
?>
