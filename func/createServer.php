<?php
$serverName = htmlspecialchars($_POST['servername'], ENT_QUOTES, 'UTF-8');
$serverGame = htmlspecialchars($_POST['game'], ENT_QUOTES, 'UTF-8');
$serverIsOwner = htmlspecialchars($_POST['owner'], ENT_QUOTES, 'UTF-8');
$serverDescription = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$serverIp = htmlspecialchars($_POST['ip'], ENT_QUOTES, 'UTF-8');
$serverPort = htmlspecialchars($_POST['port'], ENT_QUOTES, 'UTF-8');
$bannerImage = htmlspecialchars($_POST['serverbanner'], ENT_QUOTES, 'UTF-8');


session_start();
$self = $_SESSION['username'];

if(!$self){
	header("Location: /login");
}

include_once('../cfg/cdns.php');

	$sql54 = "INSERT INTO servers (serverName, serverDescription, poster, isOwner, forGame, ip, port, bannerImage)
VALUES ('$serverName', '$serverDescription', '$self', $serverIsOwner, '$serverGame', '$serverIp', $serverPort, '$bannerImage')";

	if ($conn->query($sql54) === TRUE) {
		 $createdServerId = $conn->insert_id;
		 $conn->query("INSERT INTO feedPosts (userProfile, poster, messageContents, messageType) VALUES
		 ('$loggedUser', '$loggedUser', '$createdServerId', 'serverCreation')");
		 header("Location: /server?id=" . $createdServerId);
	} else {
		header("Location: /servers");
	}
?>
