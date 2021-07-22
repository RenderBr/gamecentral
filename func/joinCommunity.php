<?php

$username1 = $_POST['u'];
$communityid = $_POST['cid'];
include_once('../cfg/conn.php');
session_start();

		$sql = "INSERT INTO communityMembers (communityId, username)
	VALUES ('$communityid', '$username1')";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "UPDATE communities SET communityMembers = communityMembers+1 WHERE id = '$communityid'";

	if($conn->query($sql) === TRUE){
	}

$conn->close();


?>
