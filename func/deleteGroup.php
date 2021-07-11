<?php

$username1 = $_POST['u'];
$groupid = $_POST['gid'];
include_once('../cfg/cdns.php');
session_start();

	$sql = "DELETE FROM lfgPosts WHERE id = '$groupid'";

	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}
	
$conn->close();


?>