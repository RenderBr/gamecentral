<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		session_start();
		include_once('cfg/cdns.php');
		include_once('modules/joinLeaveGroupButton.php');
		$group = $_GET['g'];
		$uName = $_SESSION['username'];
		if($uName){

		}else{
			header("Location: /");
		}


		function generateRandomString($length = 5) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
	}

		$invCodeGenerated = generateRandomString();


		$sql = "SELECT * FROM groupMembers WHERE groupid = '$group' AND username = '$uName'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {

			  $myRole = $row['groupRole'];

		  }
		}else{
			$notAMember = 1;
		}


		$sql = "SELECT * FROM lfgPosts WHERE id = '$group'";
		$result = $conn->query($sql);

		$groupMembers = [];

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
				$id = $row['id'];
				$game = $row['game'];
				$groupSize = $row['group_size'];
				$public = $row['public'];
				$currentUsers = $row['currentUsers'];
				$dateCreated = $row['date_created'];
				$groupName = $row['groupName'];
				$owner = $row['user'];
				$discordInv = $row['discordInv'];
				$description = $row['groupDescription'];


				if($public == 0){
					$public = "<strong>PUBLIC</strong>";
				}else{
					$public = "<strong>PRIVATE</strong>";
				}

				$sql1 = "SELECT * FROM games WHERE name = '$game'";
				$result1 = $conn->query($sql1);

				if ($result1->num_rows > 0) {

				while($row = $result1->fetch_assoc()) {
						$gameName = $row['name'];
						$gameSmIcon = $row['sm_icon'];
						$gameLgIcon = $row['lg_icon'];
						$banner = $row['banner'];
						$shortName = $row['shortName'];
					}

				}



		  }
		}else{
			header("Location: /");
		}

		?>
		<meta name="description" content="<?php echo $owner . "'s " . $game . " Gaming Group @ Game Central"; ?>">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc group">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - " . $owner . "'s " . $game . " Gaming Group"; ?></title>
		<meta name="title" content="GameCentral - <?php echo $owner . "'s " . $game . " Gaming Group" ?>">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class='bg-dark3'>
	<?php include_once('modules/navbar.php'); ?>

		<br><div class='bg-dark1 container news rounded mb-3'>
		<div class='text-center'>
			<h2 class='mt-2 mb-0' style='margin-bottom:1rem;'><?php echo $groupName; ?><img class='icon-md ms-1' title='<?php echo $gameName; ?>' src='<?php echo $gameSmIcon; ?>'></h2>
				<?php
				if($notAMember == 1){
					echo "<button id='" . $group . "' value='" . $group . "' onclick='joinGroup(this)' class='btn btn-success'>Join group!</button>";
				}else{
					echo "<button id='" . $group . "' value='" . $group . "' onclick='leaveGroup(this)' class='btn btn-danger'>Leave group!</button>";
				}
				?>
				<p class="sm-text noselect">OWNER: <a class='sm-text noselect' style='color:white;text-decoration:none;' href='/user?u=<?php echo $owner; ?>'><?php echo $owner; ?></a></p>
				<p class="sm-text noselect">PUBLICITY: <?php echo $public; ?></p>
				<p class="sm-text noselect">DATE CREATED: <?php echo $dateCreated; ?></p>


			<hr class='nav-break mt-2'>

		</div>

					<?php
				if($description){
					echo "<a class='sm-text mt-2'>GROUP INFO</a><br>";
					echo "<a class='light nd'>" . $description . "</a><br>";
				}
				if($discordInv){
					echo "<a href='" . $discordInv . "' class='discord sm-text'>DISCORD<a href='" . $discordInv . "' class='sm-text'> INVITE</a>";
				}else{

				}

			include_once('modules/chat.php');
			?>

			<br>
			<strong><a class='sm-text mt-2'>GROUP MEMBERS - <?php echo $currentUsers . "/" . $groupSize; ?></a></strong><br>

			<?php

				$sql2 = "SELECT * FROM groupMembers WHERE groupid = '$group'";
				$result2 = $conn->query($sql2);

				if ($result2->num_rows > 0) {

				while($row = $result2->fetch_assoc()) {
						if($gMember == $uName){
							$yes = 1;
						}
						$gMember = $row['username'];
						if($gMember == $owner){
							$role = "<a class='gray ms-1 noselect'>[OWNER]</a>";
						}else{
							unset($role);
						}

						$sql3 = "SELECT * FROM users WHERE username = '$gMember'";
						$result3 = $conn->query($sql3);

						if ($result3->num_rows > 0) {

							while($row = $result3->fetch_assoc()) {

								$avatar = $row['avatar'];
								$karma = $row['karma'];


								echo "<img class='icon-sm rounded-circle me-2 mt-1 mb-1' src='" . $avatar . "'><a title='" . $karma . " karma' class='nd' href='/user?u=" . $gMember . "'>" . $gMember . $role . "</a><br>";

							}
						}

					}
				}

				if($myRole > 0){
					echo "<button id='" . $group . "' value='" . $group . "' onclick='createInvite(this)' class='btn btn-success mt-1'><i class='bi bi-plus-square me-1'></i>Create Invite</button>";
				}

				if($yes = 0){
					header("Location: /");
				}
			?>




		</div>


    </body>
</html>

<script>

	function getColor(value){
		//value from 0 to 1
		var hue=(value*100).toString(10);
		return ["hsl(",hue,",100%,50%)"].join("");
	}

	var kv = parseInt($('#karma').text())
	var value = kv / 1000;
	$('#karma').attr("style", "color: " + getColor(value) + " !important");
	$('#karma2').attr("style", "color: " + getColor(value) + " !important");

	$('#discord').click(function () { copyToClipboard("<?php echo $usersDiscord; ?>"); });

	function copyToClipboard(text) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(text).select();
		document.execCommand("copy");
		$temp.remove();
}

function createInvite (button) {
      $.ajax({
        url: "/func/getInvite.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $uName; ?>",
			gid:$(button).val(),
			inv:"<?php echo $invCodeGenerated; ?>"
		},
		success:function(data){
			$(button).html("https://gcnt.xyz/inv?i=<?php echo $invCodeGenerated; ?>");
			$(button).prop("onclick", null).off("click");
			$(button).addClass("copyInvite");
			$('.copyInvite').click(function () { copyToClipboard($(button).html()); });
		}
     });
 }

 function joinGroup (button) {
      $.ajax({
        url: "/func/joinGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $uName; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Leave!");
			$(button).attr("onclick", "leaveGroup(this)");
			$(button).removeClass("btn-success");
			$(button).addClass("btn-danger");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$(button).before('<a id="gpage' + groupid + '" class="btn btn-secondary me-2" href="/group?g=' + groupid + '">Open Group Page</a>');

			n.textContent = currentPlayers + 1 + "";
			t.textContent = currentPlayers + 1 + "";

			}
     });
 }

 function leaveGroup (button) {
      $.ajax({
        url: "/func/leaveGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $uName; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Join group!");
			$(button).attr("onclick", "joinGroup(this)");
			$(button).removeClass("btn-danger");
			$(button).addClass("btn-success");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$("#gpage" + groupid).remove();

			n.textContent = currentPlayers - 1 + "";
			t.textContent = currentPlayers - 1 + "";

       }
     });
 }

</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}

.box {
   display: flex;
   align-items:center;
}
</style>
<?php
	$conn->close();
?>
