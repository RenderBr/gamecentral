<?php

$username1 = $_POST['u'];
$groupid = $_POST['gid'];
include_once('../cfg/cdns.php');
session_start();

		$sql = "INSERT INTO groupMembers (groupid, username)
	VALUES ('$groupid', '$username1')";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	
	$sql = "UPDATE lfgPosts SET currentUsers = currentUsers+1 WHERE id = '$groupid'";

	if($conn->query($sql) === TRUE){
	}


$conn->close();


?>