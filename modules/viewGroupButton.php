<?php

echo "<a style='display:none;'>Loaded ViewGroupButton Module</a>";

function viewGroupButton(int $id, $myUsername){
			
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
		
	$sql = "SELECT * FROM groupMembers WHERE groupid = $id AND username = '$myUsername'";
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
		echo '<a id="gpage' . $id . '" class="btn btn-secondary me-2" href="/group?g=' . $id . '">Open Group Page</a>';
	  }
	} else {
	}
}

?>