<?php
$serverName = $_POST['servername'];
$serverGame = $_POST['game'];
$serverIsOwner = $_POST['owner'];

$serverDescription = $_POST['description'];
$serverIp = $_POST['ip'];
$serverPort = $_POST['port'];
$bannerImage = $_POST['serverbanner'];

session_start();
$self = $_SESSION['username'];

if(!$self){
	("Location: /servers");
}

include_once('../cfg/cdns.php');

	$sql54 = "INSERT INTO servers (serverName, serverDescription, poster, isOwner, forGame, ip, port, bannerImage)
VALUES ('$serverName', '$serverDescription', '$self', $serverIsOwner, '$serverGame', '$serverIp', $serverPort, '$bannerImage')";

	if ($conn->query($sql54) === TRUE) {
		 $createdServerId = $conn->insert_id;
		 header("Location: /server?id=" . $createdServerId);
	} else {
		header("Location: /servers");
	}
?>
