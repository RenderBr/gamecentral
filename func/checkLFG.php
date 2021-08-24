<?php

//Include conn details to mysqldb
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');

		//Update all LFG posts that should be expiring to actually start expiring
		$sql = "UPDATE lfgPosts SET expiring = 1, expiryDate = ADDTIME(CURRENT_TIMESTAMP, '02:0:0') WHERE currentUsers < 2 AND expiryDate IS NULL AND invincible = 0";
		if ($conn->query($sql) === TRUE) {}

		// Update expiring posts to not expire, if invincible or has users
		$sql = "UPDATE lfgPosts SET expiring = 0, expiryDate = NULL WHERE currentUsers > 1 OR invincible = 1";
		if ($conn->query($sql) === TRUE) {}

		// Update expiring posts to expired if time is up
		$sql = "UPDATE lfgPosts SET expired = 1 WHERE expiryDate < CURRENT_TIMESTAMP AND expiring = 1";
		if ($conn->query($sql) === TRUE) {}
?>
