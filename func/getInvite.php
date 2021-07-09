<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');
$gid = $_POST['gid'];
$user = $_POST['u'];
$code = $_POST['inv'];

$checkPerms = $conn->query("SELECT * from groupMembers WHERE username = '$user' AND groupid = $gid AND groupRole > 0");
$hasPerms = $checkPerms->num_rows;

if($hasPerms > 0){

		$sql = "INSERT INTO groupInvCodes (code, creatorOfCode, forServer) VALUES ('$code', '$user', $gid)";

		if ($conn->query($sql) === TRUE) {
		} else {
		}

}else{

}


?>
