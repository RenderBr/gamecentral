<?php
$groupId = $_POST['groupId'];
$groupName = htmlspecialchars($_POST['groupname'], ENT_QUOTES, 'UTF-8');
$groupGame = htmlspecialchars($_POST['game'], ENT_QUOTES, 'UTF-8');
$groupVisibility = htmlspecialchars($_POST['visibility'], ENT_QUOTES, 'UTF-8');
$groupDescription = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$groupDiscord = htmlspecialchars($_POST['discordInvite'], ENT_QUOTES, 'UTF-8');
$groupSize = htmlspecialchars($_POST['groupSize'], ENT_QUOTES, 'UTF-8');

if(!$groupDiscord){
	$groupDiscord = NULL;
}
session_start();
$self = $_SESSION['username'];

if(!$self){
	("Location: /");
}

include_once('../cfg/cdns.php');

$sql = "SELECT * from lfgPosts WHERE user = '$self' AND expired = 0 AND id ='$groupId'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	}else{
		header("Location: /manager");
	}

	$sql = "UPDATE lfgPosts SET public='$groupVisibility',groupName='$groupName',game='$groupGame',group_size='$groupSize',discordInv='$groupDiscord',groupDescription='$groupDescription' WHERE id='$groupId'";

	if ($conn->query($sql) === TRUE) {
		header("Location: /group?g=" . $groupId);
	} else {
		header("Location: /editGroup?id=" . $groupId);
	}

?>
