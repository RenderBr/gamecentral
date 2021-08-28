	<?php
	session_start();
	$name = $_SESSION['username'];
	$gid = $_GET['g'];

	if(isset($_GET['isCom'])){
		$isCom = $_GET['isCom'];
	}else{
		$isCom = NULL;
	}

	if(isset($_GET['isDM'])){
		$isDM = $_GET['isDM'];
	}else{
		$isDM = NULL;
	}

	include_once('../cfg/cdns.php');

	$sql = "SELECT id FROM users WHERE username = '$name'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	  // output data of each row
	  while($row = $result->fetch_assoc()) {
	    $userId = $row['id'];
	  }
	} else {
	  echo "0 results";
	}

	if($isCom == "true"){
		$sql = "SELECT * FROM messages WHERE communityId = '$gid' ORDER BY date_created ASC";
	}else{
		$sql = "SELECT * FROM messages WHERE groupid = '$gid' ORDER BY date_created ASC";
	}

	if($isDM == "true"){
		$sql = "SELECT * FROM messages WHERE userId IN ('$gid', '$userId') AND authorId IN ('$gid', '$userId') ORDER BY date_created ASC";
	}

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
			$msgAuthor = $row['author'];
			$msgDate = $row['date_created'];
			$timeAgo = time_elapsed_string($msgDate);
			$msgContents = $row['message'];

				$sql1 = "SELECT * FROM users WHERE username = '$msgAuthor'";
				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {

					while($row = $result1->fetch_assoc()) {
						$avatar = $row['avatar'];
						echo '<div class="d-flex bd-highlight mt-1" style="border-bottom: 1px solid #2F3133;"><div class="me-auto p-2"><a href="/user?u=' . $msgAuthor . '" class="ms-2"><img class="icon-sm rounded-circle me-2" src="' . $avatar . '">' . $msgAuthor . ': </a><a class="gray">' . $msgContents . '</a></div><div class="p-1 gray noselect">' . $timeAgo . '</div></div>	';
					}

				}



		}

	}

	?>
