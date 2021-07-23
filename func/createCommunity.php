<?php
$communityName = htmlspecialchars($_POST['communityname'], ENT_QUOTES, 'UTF-8');
$communityDesc = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$communityDiscord = htmlspecialchars($_POST['discordInvite'], ENT_QUOTES, 'UTF-8');
$communityImg = htmlspecialchars($_POST['img'], ENT_QUOTES, 'UTF-8');

if(!$communityDiscord){
	$communityDiscord = NULL;
}
session_start();
$self = $_SESSION['username'];

if(!$self){
	("Location: /");
}

include_once('../cfg/conn.php');

	$sql = "INSERT INTO communities (communityName, description, communityOwner, communityImage, discordInv, communityMembers)
VALUES ('$communityName', '$communityDesc', '$self', '$communityImg', '$communityDiscord', 1)";

	if ($conn->query($sql) === TRUE) {
		 $createdCommunityId = $conn->insert_id;
	  echo "New record created successfully";
		$conn->query("INSERT INTO feedPosts (userProfile, poster, messageContents, messageType) VALUES
		('$loggedUser', '$loggedUser', '$createdCommunityId', 'communityCreation')");
	} else {
		header("Location: /createCommunity");
	}

		$sql = "INSERT INTO communityMembers (communityId, username, role)
VALUES ($createdCommunityId, '$self', '4')";

	if ($conn->query($sql) === TRUE) {
	  echo "New record created successfully";
	  header("Location: /community?id=" . $createdCommunityId);
	} else {
		header("Location: /createCommunity");
	}

?>
