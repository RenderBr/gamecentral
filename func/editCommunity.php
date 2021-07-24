<?php
$communityid = $_POST['communityid'];
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

$sql = "SELECT * from communities WHERE communityOwner = '$self' AND id = '$communityid'";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

	}else{
		header("Location: /manager");
	}

	$sql = "UPDATE communities SET communityName='$communityName',description='$communityDesc',communityImage='$communityImg',discordInv='$communityDiscord' WHERE id='$communityid'";

	if ($conn->query($sql) === TRUE) {
		header("Location: /community?id=" . $communityid);
	} else {
		header("Location: /editCommunity?id=" . $communityid);
	}

?>
