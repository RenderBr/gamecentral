<?php
$groupName = $_POST['groupname'];
$groupGame = $_POST['game'];
$groupVisibility = $_POST['visibility'];
$groupDescription = $_POST['description'];
$groupDiscord = $_POST['discordInvite'];
$groupSize = $_POST['groupSize'];

if(!$groupDiscord){
	$groupDiscord = NULL;
}
session_start();
$self = $_SESSION['username'];

if(!$self){
	("Location: /");
}

include_once('../cfg/cdns.php');

$sql = "SELECT * from lfgPosts WHERE user = '$self'"; 

	$result = $conn->query($sql);

	if ($result->num_rows > 2) {
			$atPostLimit = 1;

		  	while ($row = $result->fetch_array()) {
				$accountType = $row['accountType'];
				$userRole = $row['role'];
				
				
				if($accountType > 0){
					$atPostLimit = 0;
				}
				
				if($userRole > 0){
					$atPostLimit = 0;
				}
			}

			
			if($atPostLimit == 1){
				header("Location: /createLFG?l=1");
			}
			
}else{
	$atPostLimit = 0;
}	

if($atPostLimit == 0){
	
	$sql = "INSERT INTO lfgPosts (groupName, game, public, groupDescription, discordInv, user, currentUsers, group_size)
VALUES ('$groupName', '$groupGame', $groupVisibility, '$groupDescription', '$groupDiscord', '$self', 1, $groupSize)";

	if ($conn->query($sql) === TRUE) {
		 $createdGroupId = $conn->insert_id;
	  echo "New record created successfully";
	} else {
		header("Location: /createLFG");
	}
	
		$sql = "INSERT INTO groupMembers (groupid, username, groupRole)
VALUES ($createdGroupId, '$self', '4')";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  header("Location: /group?g=" . $createdGroupId);
	} else {
		header("Location: /createLFG");
	}
}

?>