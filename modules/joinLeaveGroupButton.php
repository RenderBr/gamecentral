<?php
function getGroupButton($self, $groupId){
	include_once('/var/www/html/gamecentral.online/public_html/cfg/cdns.php');

	$firstQuery = $conn->query("SELECT * from groupMembers WHERE user = '$self' AND groupdid = $groupId");
	$isMember = $firstQuery->num_rows;

	if($isMember == 1){
		
	echo "<button id='" . $groupId . "' value='" . $groupId . "' onclick='leaveGroup(this)' class='btn btn-danger'>Leave group!</button>";

		
	}else{
		echo "<button id='" . $groupId . "' value='" . $groupId . "' onclick='joinGroup(this)' class='btn btn-success'>Join group!</button>";
	}
}

?>
