<?php
function getCommunityButton($self, $communityid, $conn){

	$firstQuery = $conn->query("SELECT * from communityMembers WHERE username = '$self' AND communityId = $communityid");
	$isMember = $firstQuery->num_rows;



	if($isMember == 1){

	echo "<button id='" . $communityid . "' value='" . $communityid . "' onclick='leaveCommunity(this)' class='btn btn-danger mb-2'>Leave group!</button>";

	}else{
		echo "<button id='" . $communityid . "' value='" . $communityid . "' onclick='joinCommunity(this)' class='btn btn-success mb-2'>Join group!</button>";
	}
}


?>
