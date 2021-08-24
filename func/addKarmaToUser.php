<?php
//Start session
session_start();
//Retrieve self
$votingUser = $_SESSION['username'];
//Get user to add karma to
$user = $_POST['u'];

//Include MYSQLDB passthrough
include_once("../cfg/conn.php");
//If theres no user to add karma to, output "Error".
if(!$user){
	echo "Error!";
}

// See if karma can be updated by user, check if they have voted 5 times in last 5 minutes on same user
$sql = "SELECT * FROM karmaChanges WHERE votingUser = '$votingUser' AND affectedUser = '$user' AND date_created >= NOW() - INTERVAL 5 MINUTE";
$result1 = $conn->query($sql);


//If less than 5 votes, can be updated, if not, cannot.
if ($result1->num_rows <= 5) {
	$karmaCanBeUpdated = true;
}else{
	$karmaCanBeUpdated = false;
}

//If karma can be updated,
if($karmaCanBeUpdated == true){
	//Select the user to be updated
	$sql = "SELECT * FROM users WHERE username = '$user' LIMIT 1";
	$result2 = $conn->query($sql);

	if ($result2->num_rows > 0) {
		while($row = $result2->fetch_assoc()) {
			// Get existing karma value
			$karmaValue = $row['karma'];
			// Update karma, and add two.
			$firstQuery = $conn->query("UPDATE users SET karma = karma+2 WHERE username = '$user'");
			//Insert karma change into db to track user requests, to make sure under 5 in 5 minutes. This is to avoid abuse and spam
			$secondQuery = $conn->query("INSERT INTO karmaChanges (affectedUser, votingUser) VALUES ('$user', '$votingUser')");
			echo $karmaValue + 2;
			exit();
		}
	}
}else{
	// if karma can not be updated, keep the same.
	$sql = "SELECT * FROM users WHERE username = '$user' || id = '$user'";
	$result3 = $conn->query($sql);

	if ($result3->num_rows > 0) {
		// output data of each row
		while($row2 = $result3->fetch_assoc()) {
			echo $row2['karma'];
		}
	}

}
?>
