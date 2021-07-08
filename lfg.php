<?php
session_start();
if($_SESSION['username']){

}else{
	header("Location: /");
}
$gameLFG = $_GET['g'];
$userLFG = $_GET['u'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral looking for group page, here is the best place to find all sorts of people who are looking for games to play.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - looking for group!"; ?></title>
		<meta name="title" content="GameCentral - looking for group!">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body style='background: url(/images/generate.png)'>
	<?php include_once('modules/navbar.php'); ?>

		<br>
		<div class='bg-dark1 container' style="padding-bottom: 25px;max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);margin-top: 2.5%;width:80%;"><div class='text-center'>
		<h4 style='padding-top: 18.5px;'>Looking for a group? We got you.</h4><?php include_once('modules/gameSearch.php'); ?><hr class='nav-break'></div>

		<label><p class="sm-text noselect">LOOKING FOR GROUP BROWSER</p></label>


<div class='container-fluid bg-dark2 px-4 mt-2' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<?php

session_start();
include_once('.../cfg/cdns.php');
include_once('/var/www/html/gamecentral.online/public_html/modules/viewGroupButton.php');
$sql = "SELECT * FROM lfgPosts WHERE public = 0 AND expired = 0 ORDER BY date_created DESC LIMIT 25";
if($gameLFG){
	$sql = "SELECT * FROM lfgPosts WHERE public = 0 AND expired = 0 AND game = '$gameLFG' ORDER BY date_created DESC LIMIT 25";
}
if($userLFG){
	$sql = "SELECT * FROM lfgPosts WHERE public = 0 AND expired = 0 AND user = '$userLFG' ORDER BY date_created DESC LIMIT 25";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
	?>

	<div class='row gx-2'>

	<?php
  while($row = $result->fetch_assoc()) {

		$groupid = $row['id'];
		$game = $row['game'];
		$user = $row['user'];
		$groupSize = $row['group_size'];
		$currentGroup = $row['currentUsers'];
		$groupName = $row['groupName'];
		$expiryDate = $row['expiryDate'];

		if($currentGroup <= 0){
			$expiry = true;
		}else{
			unset($countdown);
		}

		if($expiryDate){
			$countdown = "<countdown-time title='Expiry time' class='me-2 noselect codebox gray' style='display:unset !important;' autostart datetime='" . $expiryDate . "'></countdown-time>";
		}

		if($groupName === "Untitled Group"){
			unset($groupName);
		}else{
			$groupName = "<a class='sm-text noselect'>(" . $groupName . ")</a>";
		}

		$sql1 = "SELECT * FROM games WHERE name = '$game'";
		$result1 = $conn->query($sql1);

		if ($result1->num_rows > 0) {

		  while($row1 = $result1->fetch_assoc()) {
			$iconSm = $row1['sm_icon'];
			$gameTooltip = $row1['name'];

			if($row1['shortName']){
				$gameName = $row1['shortName'];
			}else{
				$gameName = $gameTooltip;
			}

		  }
		}else{
			echo "Game could not be retrieved";
		}

		echo "<div id='" . $groupid . "l' class='d-flex bg-darkest rounded mt-2 align-items-center'>
		<div class='me-auto p-2'>
			<a class='sm-text noselect me-2'>#" . $groupid . "</a>
			<a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a>
			<img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img>
			<a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "
		</div>
		<div class='p-2'>" . $countdown . "<a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a>
		<a class='sm-text noselect me-3'> / " . $groupSize . "</a>



		";

		//echo "<div id='" . $groupid . "l' style='border-radius:5px;' class='container bg-darkest p-4 position-relative mt-2'><a class='sm-text noselect me-2'>#" . $groupid . "</a><a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a><img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img><a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "<div style='transform: translate(0%, -50%) !important;' class='position-absolute top-50 end-0 translate-middle'><a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a><a class='sm-text noselect me-3'> / " . $groupSize . "</a>";

		$sql2 = "SELECT * FROM groupMembers WHERE groupid = '$groupid' AND username = '" . $_SESSION['username'] . "'";
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {

		  while($row2 = $result2->fetch_assoc()) {
			  viewGroupButton($groupid, $_SESSION['username']);
			  echo "<button id='" . $groupid . "' value='" . $groupid . "' class='btn btn-danger' onclick='leaveGroup(this)'>Leave!</button>";
			  if($_SESSION['username'] == $user){
				echo "<button value='" . $groupid . "' onclick='deleteGroup(this)' title='Delete this group!' class='sm-text btn'><i class='bi bi-x'></i></button>";
			}else{
			echo "<a style='margin-right: 50px;'></a>";
		}

		echo "</div></div>";
		  }

		}else{
			viewGroupButton($groupid, $_SESSION['username']);
			if($currentGroup < $groupSize){
			echo "<button id='" . $groupid . "' value='" . $groupid . "' onclick='joinGroup(this)' class='btn btn-success'>Join group!</button>";
			}
			if($_SESSION['username'] == $user){
			echo "<button value='" . $groupid . "' onclick='deleteGroup(this)' title='Delete this group!' class='sm-text btn'><i class='bi bi-x'></i></button>";
		}else{
			echo "<a style='margin-right: 50px;'></a>";
		}

		echo "</div></div>";
		}




  }
} else {
	echo "

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No posts to be displayed!</a>
    </div>

	";
}

$conn->close();


?>

</div>
</div>
<style>
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */

  display: flex;
  align-items: center;
}

a{
	text-decoration:none !important;
}
.btn:focus {
	box-shadow:none !important;
}
</style>


<script>

function joinGroup (button) {
      $.ajax({
        url: "/func/joinGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
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
			u: "<?php echo $_SESSION['username']; ?>",
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

  function deleteGroup (button) {
      $.ajax({
        url: "/func/deleteGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			var groupid = $(button).val();
			$('#' + groupid + 'l').empty();
			$('#' + groupid + 'l').remove();


       }
     });
 }

</script>

<hr class='nav-break mt-2'>



		</div>
    </body>
</html>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
<?php
$conn->close();
?>
