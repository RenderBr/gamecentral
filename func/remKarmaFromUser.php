<?php
session_start();
$votingUser = $_SESSION['username'];
$user = $_POST['u'];

include_once("../cfg/cdns.php");
if(!$user){
	echo "Error!";
}


$sql = "SELECT * FROM users WHERE username = '$user' || id = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {
		$firstQuery = $conn->query("UPDATE users SET karma = karma-2 WHERE username = '$user'");
		$secondQuery = $conn->query("INSERT INTO karmaChanges (affectedUser, votingUser) VALUES ('$user', '$votingUser')");



		$newKarma =
	}
}

$sql = "SELECT * FROM users WHERE username = '$user' || id = '$user'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	// output data of each row
	while($row = $result->fetch_assoc()) {

	}

}

echo




?>
