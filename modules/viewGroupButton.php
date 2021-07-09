<?php

echo "<a style='display:none;'>Loaded ViewGroupButton Module</a>";

function viewGroupButton(int $id, $myUsername, $conn){

	include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');

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
