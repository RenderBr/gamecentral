<?php
$username1 = $_POST['u'];
$communityid = $_POST['cid'];
include_once('../cfg/conn.php');
session_start();

	$sql = "DELETE FROM communities WHERE id = '$communityid'";

	if ($conn->query($sql) === TRUE) {
	  echo "Record deleted successfully";
	} else {
	  echo "Error deleting record: " . $conn->error;
	}

$conn->close();


?>
