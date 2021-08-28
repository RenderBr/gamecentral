<?php
//Get community name, desc, discord, and image from POST
$communityName = htmlspecialchars($_POST['communityname'], ENT_QUOTES, 'UTF-8');
$communityDesc = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$communityDiscord = htmlspecialchars($_POST['discordInvite'], ENT_QUOTES, 'UTF-8');
$communityImg = htmlspecialchars($_POST['img'], ENT_QUOTES, 'UTF-8');

//If there's no community discord, set $communityDiscord to NULL
if(!$communityDiscord){
	$communityDiscord = NULL;
}
//Start the user's session
session_start();
//Retrieve username from session variable
$self = $_SESSION['username'];

//If there is no username (Guest), redirect to login page
if(!$self){
	("Location: /login");
}

//Include MYSQLDB passthrough
include_once('../cfg/conn.php');

	//Create a community, using variables collected above
	$sql = "INSERT INTO communities (communityName, description, communityOwner, communityImage, discordInv, communityMembers)
VALUES ('$communityName', '$communityDesc', '$self', '$communityImg', '$communityDiscord', 1)";

	if ($conn->query($sql) === TRUE) {
			//Get the created community's ID
		 $createdCommunityId = $conn->insert_id;
		 //Put created community into user's feedpost
		$conn->query("INSERT INTO feedPosts (userProfile, poster, messageContents, messageType) VALUES
		('$self', '$self', '$createdCommunityId', 'communityCreation')");
	} else {
		header("Location: /createCommunity");
	}

		//Add's the user to created community's members list, with owner role.
		$sql = "INSERT INTO communityMembers (communityId, username, role)
VALUES ($createdCommunityId, '$self', '4')";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  header("Location: /community?id=" . $createdCommunityId);
	} else {
		header("Location: /createCommunity");
	}
$conn->close();
//Close the connection
?>
