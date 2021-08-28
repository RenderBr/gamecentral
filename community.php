<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		session_start();
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
		include_once($_SERVER['DOCUMENT_ROOT'] . '/modules/joinLeaveCommunityButton.php');
		$communityId = $_GET['id'];
    $id = $communityId;
		$self = $_SESSION['username'];
		if($self){

		}else{
			header("Location: /login");
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


		$sql = "SELECT * FROM communityMembers WHERE communityid = '$communityId' AND username = '$self'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			  $myRole = $row['role'];
        $notAMember = 0;
		  }
		}else{
			$notAMember = 1;
		}


		$sql = "SELECT * FROM communities WHERE id = '$communityId'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
        $communityid = $row['id'];
    		$owner = $row['communityOwner'];
    		$communityMaxPeople = $row['communityMaxSlots'];
    		$communityName = $row['communityName'];
    		$communityImage = $row['communityImage'];
        $dateCreated = $row['date_created'];
        $timeAgo = time_elapsed_string($dateCreated);
        $description = $row['description'];
        $discordInv = $row['discordInv'];

        $sql1 = "SELECT * FROM communityMembers WHERE communityId = $communityid";

        $result1 = $conn->query($sql1);
        $peopleInGroup = $result1->num_rows;
		  }
		}else{
			header("Location: /");
		}

		?>
		<meta name="description" content="<?php echo $communityName; ?> @ Game Central">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc community, <?php echo $communityName; ?>">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - " . $communityName; ?></title>
		<meta name="title" content="GameCentral - <?php echo $communityName; ?>">
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

		<br><div class='bg-dark1 container news rounded mb-4 pb-3'>
		<div class='text-center'>
			<h2 class='mb-0' style='margin-bottom:1rem;'><?php echo $communityName; ?><img class='icon-md ms-1 rounded-circle' title='<?php echo $communityName; ?>' src='<?php echo $communityImage; ?>'></h2>
				<p class="sm-text noselect">OWNER: <a class='sm-text noselect' style='color:white;text-decoration:none;' href='/user?u=<?php echo $owner; ?>'><?php echo $owner; ?></a></p>
				<p class="sm-text noselect">Created <?php echo $timeAgo; ?></p>
        <?php
        getCommunityButton($self, $communityid, $conn);

				?>

			<hr class='nav-break mt-2'>

		</div>

					<?php
				if($description){
					echo "<a class='sm-text mt-2'>GROUP INFO</a><br>";
					echo "<a class='light nd'>" . $description . "</a><br>";
				}
				if($discordInv){
					echo "<a href='" . $discordInv . "' class='sm-text'>COMMUNITY <a href='" . $discordInv . "' class='discord sm-text'>DISCORD<a href='" . $discordInv . "' class='sm-text'> INVITE</a>";
				}else{

				}
      $isCommunity = true;
			include_once('modules/chat.php');
			?>

			<br>
			<strong><a class='sm-text mt-2'>GROUP MEMBERS - <?php echo $peopleInGroup . "/" . $communityMaxPeople; ?></a></strong><br>

			<?php

				$sql2 = "SELECT * FROM communityMembers WHERE communityId = '$communityid'";
				$result2 = $conn->query($sql2);

				if ($result2->num_rows > 0) {

				while($row = $result2->fetch_assoc()) {
            $gMember = $row['username'];
            $date_joined = $row['date_joined'];
            $date_joined = time_elapsed_string($date_joined);
						if($gMember == $self){
							$yes = 1;
						}
						if($gMember == $owner){
							$role = "<a class='gray ms-1 noselect'>[OWNER]</a>";
						}else{
              $role = NULL;
						}

						$sql3 = "SELECT * FROM users WHERE username = '$gMember'";
						$result3 = $conn->query($sql3);

						if ($result3->num_rows > 0) {

							while($row = $result3->fetch_assoc()) {

								$avatar = $row['avatar'];
								$karma = $row['karma'];


								echo "<img class='icon-sm rounded-circle me-2 mt-1 mb-1' src='" . $avatar . "'><a title='" . $karma . " karma' class='nd' href='/user?u=" . $gMember . "'>" . $gMember . $role . "<a class='sm-text noselect'> joined " . $date_joined . "</a></a><br>";

							}
						}

					}
				}

				if($myRole > 0){
					echo "<button id='" . $communityid . "' value='" . $communityid . "' onclick='createInvite(this)' class='btn btn-success mt-1'><i class='bi bi-plus-square me-1'></i>Create Invite</button>";
				}

			?>




		</div>


    </body>
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
    			u: "<?php echo $self; ?>",
    			gid:$(button).val(),
    			inv:"<?php echo $invCodeGenerated; ?>",
          isCom:"true"
    		},
    		success:function(data){
    			$(button).html("https://gcnt.xyz/inv?i=<?php echo $invCodeGenerated; ?>");
    			$(button).prop("onclick", null).off("click");
    			$(button).addClass("copyInvite");
    			$('.copyInvite').click(function () { copyToClipboard($(button).html()); });
    		}
         });
     }

     function leaveCommunity (button) {
          $.ajax({
            url: "/func/leaveCommunity.php", //the page containing php script
            type: "POST", //request type
            data: {
    			u: "<?php echo $self; ?>",
    			cid:$(button).val()
    		},
    		success:function(data){
    			$(button).html("Join community!");
    			$(button).attr("onclick", "joinCommunity(this)");
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


      function joinCommunity (button) {
           $.ajax({
             url: "/func/joinCommunity.php", //the page containing php script
             type: "POST", //request type
             data: {
     			u: "<?php echo $self; ?>",
     			cid:$(button).val()
     		},
     		success:function(data){
     			$(button).html("Leave!");
     			$(button).attr("onclick", "leaveCommunity(this)");
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



    </script>
</html>



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
