<?php
include_once('../cfg/cdns.php');
session_start();
$self = $_SESSION['username'];

$invCode = $_GET['i'];

if($invCode){
	
	if($self){
	

	$sql = "SELECT * FROM groupInvCodes WHERE code = '$invCode' AND active = 1";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		  $invId = $row['id'];
		  $invGroupId = $row['forServer'];
		  $notifs = $conn->query("UPDATE groupInvCodes SET uses=uses+1 WHERE id=$invId");
		  header("Location: /group?g=" . $invGroupId);
	  }
	  
	}else{
		header("Location: /");
	}
	
	
	
	
}else{
	header("Location: /login?r=/func/inv?i=" . $invCode);
}
	
	
	
}else{
	header("Location: /");
}



?>