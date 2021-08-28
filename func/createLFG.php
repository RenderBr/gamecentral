<?php
//Get group name, game, publicity, desc, discord, and member size variables
$groupName = htmlspecialchars($_POST['groupname'], ENT_QUOTES, 'UTF-8');
$groupGame = htmlspecialchars($_POST['game'], ENT_QUOTES, 'UTF-8');
$groupVisibility = htmlspecialchars($_POST['visibility'], ENT_QUOTES, 'UTF-8');
$groupDescription = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$groupDiscord = htmlspecialchars($_POST['discordInvite'], ENT_QUOTES, 'UTF-8');
$groupSize = htmlspecialchars($_POST['groupSize'], ENT_QUOTES, 'UTF-8');

//If there's no group discord, set $groupDiscord to NULL
if(!$groupDiscord){
	$groupDiscord = NULL;
}
//Start the user session
session_start();
//Retrieve user's name from SESSION variable
$self = $_SESSION['username'];

//If no username is found (is Guest/not logged in), redirect to login page
if(!$self){
	("Location: /login");
}
//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

//Select ALL existing, unexpired LFG posts from user
$sql = "SELECT * from lfgPosts WHERE user = '$self' AND expired = 0";

	$result = $conn->query($sql);

//If more than two current groups exist,
	if ($result->num_rows > 2) {
			//The user will be at their post limit
			$atPostLimit = 1;
	}else{
		//Otherwise, the user is not at their post limit
		$atPostLimit = 0;
	}

	//If the user is at their post limit, though, they will be redirected back to the createLFG page with an error message.
	if($atPostLimit == 1){
		header("Location: /createLFG?l=1");
	}

//If user is not at post limit,
if($atPostLimit == 0){

	//Create the group with the variables retrieved from POST
	$sql = "INSERT INTO lfgPosts (groupName, game, public, groupDescription, discordInv, user, currentUsers, group_size)
VALUES ('$groupName', '$groupGame', $groupVisibility, '$groupDescription', '$groupDiscord', '$self', 1, $groupSize)";

	if ($conn->query($sql) === TRUE) {
			// Retrieve the created group ID
		 $createdGroupId = $conn->insert_id;
		 //Create a new feedpost about the newly created group
		$conn->query("INSERT INTO feedPosts (userProfile, poster, messageContents, messageType) VALUES
		('$self', '$self', '$createdGroupId', 'groupCreation')");
	} else {
		header("Location: /createLFG");
	}
		//Insert into newly created group members with owner role
		$sql = "INSERT INTO groupMembers (groupid, username, groupRole)
VALUES ($createdGroupId, '$self', '4')";

	if ($conn->query($sql) === TRUE) {
		//Redirect user to new group
	  header("Location: /group?g=" . $createdGroupId);
	} else {
		header("Location: /createLFG");
	}
}
$conn->close();
//Close the connection
?>
