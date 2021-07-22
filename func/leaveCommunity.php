<?php

$username1 = $_POST['u'];
$communityid = $_POST['cid'];
include_once('../cfg/conn.php');
session_start();

	$sql = "DELETE FROM communityMembers WHERE username = '$username1' AND communityId = '$communityid'";

	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}

	$sql = "UPDATE communities SET communityMembers = communityMembers-1 WHERE id = '$communityid'";

if($conn->query($sql) === TRUE){
}


$conn->close();


?>
