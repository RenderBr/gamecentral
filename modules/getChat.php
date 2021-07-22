	<?php
	$gid = $_GET['g'];
	$isCom = $_GET['isCom'];
	include_once('../cfg/conn.php');

	if($isCom == "true"){
		$sql = "SELECT * FROM messages WHERE communityId = '$gid' ORDER BY date_created ASC";
	}else{
		$sql = "SELECT * FROM messages WHERE groupid = '$gid' ORDER BY date_created ASC";
	}
	
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {

		while($row = $result->fetch_assoc()) {
			$msgAuthor = $row['author'];
			$msgDate = $row['date_created'];
			$msgContents = $row['message'];

				$sql1 = "SELECT * FROM users WHERE username = '$msgAuthor'";
				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {

					while($row = $result1->fetch_assoc()) {
						$avatar = $row['avatar'];
						echo '<div class="d-flex bd-highlight mt-1" style="border-bottom: 1px solid #2F3133;"><div class="me-auto p-2"><a href="/user?u=' . $msgAuthor . '" class="ms-2"><img class="icon-sm rounded-circle me-2" src="' . $avatar . '">' . $msgAuthor . ': </a><a class="gray">' . $msgContents . '</a></div><div class="p-1 gray noselect">' . $msgDate . '</div></div>	';
					}

				}



		}

	}

	?>
