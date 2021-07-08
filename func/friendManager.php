<?php
$self = $_POST['self'];
$friend = $_POST['friend'];
$action = $_POST['action'];
include_once('../cfg/cdns.php');
$friendcombo = $self . " - " . $friend;
$friendcombo2 = $friend . " - " . $self;


if($action == "add" && $friend && $self){
	$sql = "INSERT INTO friends (friendCombo)
	VALUES ('$friendcombo')";

	if ($conn->query($sql) === TRUE) {
		$friendId = mysqli_insert_id($conn);
				$sql1 = "INSERT INTO notifications (type, user, associatedId)
	VALUES ('friendRequest', '$friend', $friendId)";

				if ($conn->query($sql1) === TRUE) {
				}

		}
	
}

if($action == "remove" && $friend && $self){
	$sql = "DELETE FROM friends WHERE friendCombo = '$friendcombo' OR friendCombo = '$friendcombo2'";

	if ($conn->query($sql) === TRUE) {
	}
	
}

if($action == "accept" && $friend && self){
	$sql = "UPDATE friends SET accepted=1 WHERE friendCombo = '$friendcombo' OR friendCombo = '$friendcombo2'";
	
	if (mysqli_query($conn, $sql)) {
		
	$sql = "SELECT * FROM friends WHERE friendCombo = '$friendcombo' OR friendCombo = '$friendcombo2' AND accepted=1";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {	

		while($row = $result->fetch_assoc()) {
			$notifId = $row['id'];
		}
	}
		
	} else {
	}
	
	$sql = "UPDATE notifications SET seen=1 WHERE associatedId = '$notifId'";
	
	if (mysqli_query($conn, $sql)) {
	} else {
	}
}


?>