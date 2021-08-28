<?php
//Retrieve all POST variables necessary for creating a server
$serverName = htmlspecialchars($_POST['servername'], ENT_QUOTES, 'UTF-8');
$serverGame = $_POST['game'];
$serverIsOwner = htmlspecialchars($_POST['owner'], ENT_QUOTES, 'UTF-8');
$serverDescription = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$serverIp = htmlspecialchars($_POST['ip'], ENT_QUOTES, 'UTF-8');
$serverPort = htmlspecialchars($_POST['port'], ENT_QUOTES, 'UTF-8');
$bannerImage = htmlspecialchars($_POST['serverbanner'], ENT_QUOTES, 'UTF-8');
$bgImage = htmlspecialchars($_POST['serverBG'], ENT_QUOTES, 'UTF-8');

//Create a session
session_start();
//Retrieve session username
$self = $_SESSION['username'];
//

if(!$self){
	header("Location: /login");
}

include_once('../cfg/conn.php');

	$sql54 = sprintf("INSERT INTO servers (serverName, serverDescription, poster, isOwner, forGame, ip, port, bannerImage, bgImage)
VALUES ('$serverName', '$serverDescription', '$self', $serverIsOwner, '%s', '$serverIp', $serverPort, '$bannerImage', '$bgImage')", mysqli_real_escape_string($conn, $serverGame));

	if ($conn->query($sql54) === TRUE) {
		 $createdServerId = $conn->insert_id;
		 $conn->query("INSERT INTO feedPosts (userProfile, poster, messageContents, messageType) VALUES
		 ('$loggedUser', '$loggedUser', '$createdServerId', 'serverCreation')");
		 header("Location: /server?id=" . $createdServerId);
	} else {
		header("Location: /servers");
	}
?>
