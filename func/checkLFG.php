<?php

echo "<a style='display:none;'>Loaded AutoCheckLFG Module</a>";
			
	$servername = "localhost";
	$username = "2admin";
	$password = "Wv9bGBaolonxw98w";
	$dbname = "gamecentral";
	$adminPassword = "admin420";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 		
		
		$sql = "UPDATE lfgPosts SET expiring = 1, expiryDate = ADDTIME(CURRENT_TIMESTAMP, '02:0:0') WHERE currentUsers < 2 AND expiryDate IS NULL AND invincible = 0";

		if ($conn->query($sql) === TRUE) {
		} else {
		}
		
		$sql = "UPDATE lfgPosts SET expiring = 0, expiryDate = NULL WHERE currentUsers > 1 OR invincible = 1";

		if ($conn->query($sql) === TRUE) {
		} else {
		}
				
		$sql = "UPDATE lfgPosts SET expired = 1 WHERE expiryDate < CURRENT_TIMESTAMP AND expiring = 1";

		if ($conn->query($sql) === TRUE) {

		} else {
		}
		

?>