<?php
session_start();
if(isset($_SESSION['username'])){
	$self = $_SESSION['username'];
}else{
	header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');
					include_once($_SERVER['DOCUMENT_ROOT'] . '/modules/viewGroupButton.php');
		 ?>
		<script src='https://unpkg.com/@wanoo21/countdown-time@1.2.0/dist/countdown-time.js'></script>
		<meta name="description" content="GameCentral management page, manage your groups, communities, and servers!">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc friends, management, management portal">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - management portal!"; ?></title>
		<meta name="title" content="GameCentral - management portal!">
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
		<div class='bg-dark1 container mb-4 pb-3 rounded' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='noselect pt-2 pb-1'><i class="bi bi-archive-fill me-1"></i>Manage everything, <u>right here...</u></h4><hr class='nav-break'></div>

		<label><p class="sm-text noselect">GROUPS</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
	<div class='row gx-2'>

	<?php
	$sql = "SELECT * FROM lfgPosts WHERE user = '$self' AND expired = 0";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {

		$groupid = $row['id'];
		$game = $row['game'];
		$user = $row['user'];
		$groupSize = $row['group_size'];
		$currentGroup = $row['currentUsers'];
		$groupName = $row['groupName'];
		$expiryDate = $row['expiryDate'];
		$invincible = $row['invincible'];

		if($currentGroup <= 0){
			$expiry = true;
		}else{
			$countdown = NULL;
		}

		if($expiryDate){
			$countdown = "<countdown-time title='Expiry time' class='me-2 noselect codebox gray' style='display:unset !important;' autostart datetime='" . $expiryDate . "'></countdown-time>";
		}

		if($invincible == 1){
			$countdown = "<i class='bi bi-patch-check-fill gray me-2' title='This group is invincible! This means that it can not expire!'></i>";
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

		viewGroupButton($groupid, $_SESSION['username'], $conn);
		echo "<a id='" . $groupid . "' value='" . $groupid . "' class='btn btn-primary me-2' href='/editGroup?id=" . $groupid . "'>Edit this group!</a>";
		if($_SESSION['username'] == $user){
		echo "<button value='" . $groupid . "' onclick='deleteGroup(this)' title='Delete this group!' class='sm-text btn'><i class='bi bi-x'></i></button>";
	}else{
	echo "<a style='margin-right: 50px;'></a>";
	}

echo "</div></div>";


		}
} else {
	echo "

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>You do not have any groups! Go and make one!</a>
    </div>

	";
}



?>
</div>
</div>
<hr class='nav-break mt-2'>


<label><p class="sm-text noselect">COMMUNITIES</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<div class='row gx-2'>

	<?php
	$sql1 = "SELECT * FROM communities WHERE communityOwner = '$self'";
	$result1 = $conn->query($sql1);

if ($result1->num_rows > 0) {

	while($row = $result1->fetch_assoc()) {

		$communityid = $row['id'];
		$owner = $row['communityOwner'];
		$communityMaxPeople = $row['communityMaxSlots'];
		$communityName = $row['communityName'];
		$communityImage = $row['communityImage'];
		$communityMembers = $row['communityMembers'];
		$peopleInGroup = $communityMembers;

		echo "<div id='" . $communityid . "l' class='d-flex bg-darkest rounded mt-2 align-items-center'>
		<div class='me-auto p-2 align-middle'>
			<h4 class='ms-1' style='margin:0px !important;vertical-align: middle;
		align-content: center;'><img title='" . $communityName . "' width=64rem height=64rem class='ms-1 rounded-circle' src='" . $communityImage . "'></img><a class='ms-1'>
		" . $communityName . "<a class='sm-text ms-4 noselect' style='vertical-align: middle !important;'>OWNER: <a class='sm-text noselect' style='vertical-align: middle !important;' href='/user?u=" . $owner . "'>" . $owner . "</a></a></h4> </a>
		</div>
		<div class='p-2'><a class='sm-text noselect' id='" . $communityid . "t'>" . $peopleInGroup . "</a>
		<a class='sm-text noselect me-3'> / " . $communityMaxPeople . "</a>



		";

		echo '<a id="gpage' . $communityid . '" class="btn btn-secondary me-2" href="/community?id=' . $communityid . '">Open Community Page</a>';
		echo "<a id='" . $communityid . "' value='" . $communityid . "' class='btn btn-primary me-2' href='/editCommunity?id=" . $communityid . "'>Edit this community!</a>";
		if($_SESSION['username'] == $self){
		echo "<button value='" . $communityid . "' onclick='deleteCommunity(this)' title='Delete this group!' class='sm-text btn'><i class='bi bi-x'></i></button>";
	}else{
	echo "<a style='margin-right: 50px;'></a>";
	}

echo "</div></div>";


		}
} else {
	echo "

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>You do not have any communities! Go and make one!</a>
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




		</div>
    </body>
</html>

<script>

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

 function deleteCommunity (button) {
		 $.ajax({
			 url: "/func/deleteCommunity.php", //the page containing php script
			 type: "POST", //request type
			 data: {
		u: "<?php echo $_SESSION['username']; ?>",
		cid:$(button).val()
	},
	success:function(data){
		var groupid = $(button).val();
		$('#' + groupid + 'l').empty();
		$('#' + groupid + 'l').remove();


			}
		});
}
</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
