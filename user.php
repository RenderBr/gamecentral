<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
		include_once($_SERVER['DOCUMENT_ROOT'] . "/modules/addKarma.php");
		$user = $_GET['u'];

		$sql = "SELECT * FROM users WHERE username = '$user' || id = '$user'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			  $usersname = $row['username'];
			  $usersav = $row['avatar'];
			  $usersbio = $row['bio'];
			  $usersrole = $row['role'];
			  $userskarma = $row['karma'];
			  $usersid = $row['id'];
			  $usersbg = $row['bg'];
			  $isGC = $row['gc'];
			  $usersDiscord = $row['discord'];
			  $discordVerified = $row['discordVerified'];

        if($getFriendCount = mysqli_query($conn, "SELECT * FROM friends WHERE friendCombo LIKE '$user' AND approved = 1")){

          				$friendCount = $getFriendCount->num_rows;

                  mysqli_free_result($friendCount);

        }else{

          $friendCount = 0;
        }

			  if($isGC == 1){
				$isGC = '1';
			  }else{
				unset($isGC);
			  }

		  }

		}else{
			header("Location: /");
		}

		?>
		<meta name="description" content="">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc profile">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - " . $usersname . "'s profile page!"; ?></title>
		<meta name="title" content="GameCentral - <?php echo $usersname . "'s profile page!"; ?>">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body style='background: url(<?php echo $usersbg; ?>)'>
	<?php include_once('modules/navbar.php'); ?>

		<br><div class='bg-dark1 container user rounded'>
		<div class='text-center'>
			<a title='User ID, not a placement.' style='text-decoration:none;' class='sm-text noselect mt-1'>#<?php echo $usersid; ?></a>
			<?php

			if($isGC){
				echo "<br><img title='Verified GC Associate' style='max-width: 15%;' class='noselect' src='/images/logo-03.png'></img>";
			}else{
				echo "<br>";
			}

			?>
			<h4><?php echo $usersname; ?></h4>
			<img class='rounded mb-1' height=50% width=50% src='<?php echo $usersav; ?>'>
			<hr class='nav-break'>
		</div>

		<label>
			<p class="sm-text">BIO</p>
		</label>

		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $usersbio; ?>
		</p>

		<?php
		include_once('modules/friend.php');
		echo "<label>
			<p class='sm-text' style='color:white; !important;'>
			";
			if($friendCount == 1){
				echo $friendCount . " FRIEND";
			}
			if($friendCount > 1){
				echo $friendCount . " FRIENDS";
			}
			echo "
				<a id='karma'>" . $userskarma .  "</a>
				<a id='karma2'>KARMA</a>";
				addKarmaButton($usersname);
				echo "
			</p>
		</label>";
		?>

		</div>
			<?php

			if($usersDiscord){

				echo "
				<div class='bg-dark1 container user rounded' style='margin-top:0.5rem !important;'>

			<hr class='nav-break'>
			<label>
				<p class='sm-text noselect'>SOCIAL MEDIA</p>
			</label>
			<hr class='nav-break'>
			<div class='box'>";

			if($discordVerified == 1){
				$discordVerified = '<i title="This user&#39;s discord is verified!" class="bi bi-patch-check ms-1" style="color:white;"></i>';
			}else{
				$discordVerified = "";
			}

				echo "
					<i style='color: #7289DA !important;font-size: 1.5rem;vertical-align:middle !important;' class='bi bi-discord me-1'></i>
					<span role='button' title='click to copy' id='discord' class='sm-text' style='margin-bottom:0px !important;'>" . $usersDiscord . $discordVerified . "</span>
				";

			}

			?>
			</div>

		</div>

		<div class='bg-dark1 container user rounded mt-1'>

			<hr class='nav-break'>
			<label>
				<p class="sm-text noselect">ROLE <?php if($usersrole == 12){ echo "????"; } ?></p>
			</label>
			<hr class='nav-break'>

			<?php

			if($usersrole == 0){
				echo "
				<label>
					<p style='color:white !important;' class='sm-text'>DEFAULT</p>
				</label>";
			}
			if($usersrole == 1){
				echo "
				<label>
					<p style='color:#5539cc !important;text-shadow: 1px 1px 1px #FF3900;' class='sm-text'>CONTENT CREATOR</p>
				</label>";
			}
			if($usersrole == 2){
				echo "
				<label>
					<p style='color:#f77e36 !important;font-size: 13px;' class='sm-text'>MODERATOR</p>
				</label>";
			}
			if($usersrole == 3){
				echo "
				<label>
					<p style='color:#e35500 !important;text-shadow:2px 2px 1px rgba(56,20,13,0.22);font-size: 14px;' class='sm-text'>ADMIN</p>
				</label>";
			}
			if($usersrole == 4){
				echo "
				<label>
					<p style='color: #ee0c0c !important;text-shadow:5px 2px 8px rgba(56,20,13,0.92);font-size: 15px;' class='sm-text'>OPERATOR</p>
				</label>";
			}
			if($usersrole == 12){
				echo "
				<label>
					<p style='color: #535353 !important;text-shadow:5px 2px 8px rgba(56,20,13,0.92);font-size: 0.5px;' class='sm-text noselect'>john</p>
				</label>";
			}
			?>

		</div>

			<?php

			$sql1 = "SELECT * FROM groupMembers WHERE username = '$usersname'";
			$result1 = $conn->query($sql1);

			if ($result1->num_rows > 0) {

				echo "<div class='bg-dark1 container user rounded mt-1'>

			<hr class='nav-break'>
			<label>
				<p class='sm-text noselect'>IN GROUPS</p>
			</label>
			<hr class='nav-break mb-2'><ul>";
			// output data of each row
			while($row = $result1->fetch_assoc()) {
					$groupdId = $row['groupid'];
					$dateJoined = $row['date_joined'];

					$sql2 = "SELECT * FROM lfgPosts WHERE id = '$groupdId' AND expired = 0 AND public = 0";
					$result2 = $conn->query($sql2);


					if ($result2->num_rows > 0) {
					// output data of each row
						while($row = $result2->fetch_assoc()) {

							$groupName = $row['groupName'];
							$game = $row['game'];
							$owner = $row['user'];

							echo "<a class='nd gray' href='/group?g=" . $groupdId . "'><li>" . $groupName . " <a class='gray noselect' style='font-size: 75%;'>(owner: " . $owner . ")</a></li></a>";

						}
					}


				}
				echo '</ul></div>';
			}
			?>

			<div class='bg-dark1 container user rounded mt-1 mb-3'>

			<hr class='nav-break'>
			<label>
				<p class="sm-text noselect">BADGES</p>
			</label>
			<hr class='nav-break'>

			<?php
				$sql5 = "SELECT * FROM badges WHERE user = '$usersname' AND userid = '$usersid'";
					$result5 = $conn->query($sql5);

					if ($result5->num_rows > 0) {
					// output data of each row
						while($row = $result5->fetch_assoc()) {
							$badge = $row['badge'];
							$dateAwarded = $row['date_created'];


							$sql6 = "SELECT * FROM badgeTypes WHERE badgeName = '$badge'";
							$result6 = $conn->query($sql6);

							if ($result6->num_rows > 0) {
							// output data of each row
								while($row = $result6->fetch_assoc()) {
									$badgeName = $row['badgeName'];
									$badgeIcon = $row['badgeIcon'];
									$badgeDescription = $row['badgeDescription'];

									if($badgeName === "Day One"){
										echo "<img width=32 src='" . $badgeIcon . "' title='" . $badgeName . " - " . $badgeDescription . "\n\nAwarded - " . $dateAwarded . "'>";
									}

								}

							}


						}
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
