<?php
$message = $_POST['messageOnFeed'];
$user = $_POST['userFeed'];

session_start();
$self = $_SESSION['username'];

if(!$self){
	header("Location: /user?u=" . $user);
}

include_once('../cfg/conn.php');

	$sql54 = "INSERT INTO feedPosts (userProfile, poster, messageContents, messageType)
VALUES ('$user', '$self', '$message', 'text')";

	if ($conn->query($sql54) === TRUE) {
		 $createdServerId = $conn->insert_id;
		 header("Location: /user?u=" . $user);
	} else {
		header("Location: /user?u=" . $user);
	}
?>
