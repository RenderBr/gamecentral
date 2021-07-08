<?php

$username1 = $_POST['u'];
$groupid = $_POST['gid'];
include_once('../cfg/cdns.php');
session_start();

	$sql = "DELETE FROM groupMembers WHERE username = '$username1' AND groupid = '$groupid'";

	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}

		$sql = "UPDATE lfgPosts SET currentUsers = currentUsers-1 WHERE id = '$groupid'";

	if($conn->query($sql) === TRUE){
	}

	
$conn->close();


?>