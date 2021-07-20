<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
		include_once($_SERVER['DOCUMENT_ROOT'] . "/modules/karmaButtons.php");
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
        $userLastSeen = $row['lastLoggedIn'];
        $banner = $row['bannerImage'];

        if($getFriendCount = $conn->query("SELECT * FROM friends WHERE friendCombo LIKE '%{$usersname}%' AND accepted = 1")){

          				$friendCount = $getFriendCount->num_rows;


        }else{
          $friendCount = NULL;
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
    <body style='background: url(<?php echo $usersbg; ?>);background-repeat: none;background-size: cover;'>
	<?php include_once('modules/navbar.php'); ?>

		<br><div class='bg-dark1 container user pb-1 rounded' style='padding:0px;'>
			<div class='container-fluid bg-warning bg-gradient rounded' style="background: url(<?php echo $banner; ?>) !important;" width=100%>
			<img class='rounded-circle mb-1 border border-dark border-5 mt-2' width=128rem height=128rem src='<?php echo $usersav; ?>'><?php
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

                  echo "<a style='vertical-align:none !important;' class='ms-1'>";

									if($badgeName === "Day One"){
										echo "<img width=32 class='me-1' src='" . $badgeIcon . "' title='" . $badgeName . " - " . $badgeDescription . "\n\nAwarded - " . $dateAwarded . "'>";
									}

                  if($badgeName === "Bug Hunter"){
                    echo "<img width=32 class='me-1' src='" . $badgeIcon . "' title='" . $badgeName . " - " . $badgeDescription . "\n\nAwarded - " . $dateAwarded . "'>";
                  }

                  echo "</a>";
								}

							}


						}
					}

			?>
    </div>
    <div class='container rounded pt-1'>
  <div class='d-flex align-items-center'>
     <div class="me-auto p-2 bd-highlight"><h4 style='margin-bottom:0px !important;'><?php echo $usersname; ?></h4>
</div>
     <div class='p-2'>			<a class='me-2'><?php

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
     			?></a><?php include_once('modules/friend.php'); ?></div>
  </div>
  <hr class='nav-break'>


		<label>
			<p class="sm-text">BIO<?php
                  if(isset($isGC)){
                  echo "<img title='Verified GC Associate' style='max-width: 5%;' class='noselect ms-1' src='/images/logo-03.png'>";
           			}else{
           			} ?></p>
		</label>
		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $usersbio; ?>
		</p>

		<?php
		echo "<label>
			<p class='sm-text' style='color:white; !important;'>
			";
			if($friendCount == 1){
				echo $friendCount . " FRIEND";
			}
			if($friendCount > 1){
				echo $friendCount . " FRIENDS";
			}

        if($_SESSION['username'] == $usersname){

        }else{
          removeKarmaButton($usersname);
        }
        echo "
				<a id='karma'>" . $userskarma .  "</a>
				<a id='karma2'>KARMA</a>";
        if($_SESSION['username'] == $usersname){

        }else{
				      addKarmaButton($usersname);
        }?>
<a title='User ID, not a placement.' style='text-decoration:none;' class='noselect mt-3 ms-1 gray'>#<?php echo $usersid; ?></a>
        <?php
        echo "
			</p>
		</label>";
		?>
  </div>

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

      echo "<div class='bg-dark1 container user rounded mt-1 pb-3 mb-4'>

      <hr class='nav-break'>
      <label>
      <p class='sm-text noselect'>FEED</p>
      </label>
      <hr class='nav-break mb-2'>";


      if(isset($_SESSION['username'])){
      echo "<form name='form8' method='POST' id='form8' action='/func/postTextOnFeed.php'>
        <div class='input-group mb-2'>
          <textarea name='messageOnFeed' placeholder='Write something on " . $usersname . "&#39;s feed!' class='form-control dark-box'></textarea>
          <button form='form8' id='sideButton' class='btn btn-outline-success input-group-text' type='submit'><i class='bi bi-check-circle'></i></button>
          <input name='userFeed' value='" . $usersname . "' style='display:none !important;'>
        </div>
      </form>";
      }
      $sql42 = "SELECT * FROM feedPosts WHERE userProfile = '$usersname' ORDER BY date_created DESC LIMIT 10";
      $result42 = $conn->query($sql42);




			if ($result42->num_rows > 0) {
			// output data of each row
				while($row42 = $result42->fetch_assoc()) {
            $message = $row42['messageContents'];
            $posterF = $row42['poster'];
            $datecreatedF = $row42['date_created'];
            $messageType = $row42['messageType'];

            if(isset($posterF)){

              $sql56 = "SELECT * FROM users WHERE username = '$posterF'";
              $result56 = $conn->query($sql56);

              if ($result56->num_rows > 0) {
              // output data of each row
                while($row56 = $result56->fetch_assoc()) {
                    $avatarF = $row56['avatar'];
                }
              }


            }
            if($messageType == "text"){
              echo '<div class="d-flex bd-highlight mt-1 bg-dark3" style="border-bottom: 1px solid #2F3133;"><div class="me-auto p-2"><a href="/user?u=' . $posterF . '" class="ms-2"><img class="icon-sm rounded-circle me-2" src="' . $avatarF . '">' . $posterF . ' <a class="gray noselect"> > </a> </a><i><a>' . $message . '</a></i></div><div class="p-2 gray noselect">' . $datecreatedF . '</div></div>';
            }
            if($messageType == "statusUpdate"){
              echo '<div class="d-flex bd-highlight mt-1 bg-dark3" style="border-bottom: 1px solid #2F3133;"><div class="me-auto p-2"><a href="/user?u=' . $posterF . '" class="ms-2"><img class="icon-sm rounded-circle me-2" src="' . $avatarF . '">' . $posterF . ' <a class="noselect gray">is... </a> </a><i><a class="noselect">' . $message . '</a></i></div><div class="p-2 gray noselect">' . $datecreatedF . '</div></div>';
            }
          }
        echo '</div>';
      }

			?>



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
