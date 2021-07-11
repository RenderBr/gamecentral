<?php
session_start();
$votingUser = $_SESSION['username'];
$user = $_POST['u'];

include_once("../cfg/conn.php");
if(!$user){
	echo "Error!";
}

$sql = "SELECT * FROM karmaChanges WHERE votingUser = '$votingUser' AND affectedUser = '$user' AND date_created >= NOW() - INTERVAL 5 MINUTE";
$result1 = $conn->query($sql);

if ($result1->num_rows <= 5) {
	$karmaCanBeUpdated = true;
}else{
	$karmaCanBeUpdated = false;
}

if($karmaCanBeUpdated == true){
	$sql = "SELECT * FROM users WHERE username = '$user' LIMIT 1";
	$result2 = $conn->query($sql);

	if ($result2->num_rows > 0) {
		// output data of each row
		while($row = $result2->fetch_assoc()) {
			$karmaValue = $row['karma'];
			$firstQuery = $conn->query("UPDATE users SET karma = karma+2 WHERE username = '$user'");
			$secondQuery = $conn->query("INSERT INTO karmaChanges (affectedUser, votingUser) VALUES ('$user', '$votingUser')");
			echo $karmaValue + 2;
			exit();
		}
	}
}else{

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
