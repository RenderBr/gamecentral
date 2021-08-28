<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');
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
			$invComId = $row['forCom'];
			$invGroupId = $row['forServer'];
		  $invId = $row['id'];
		  $notifs = $conn->query("UPDATE groupInvCodes SET uses=uses+1 WHERE id=$invId");

			if(isset($invComId)){
				header("Location: /community?id=" . $invComId);
			}
			if(isset($invGroupId)){
				header("Location: /group?g=" . $invGroupId);
			}

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
