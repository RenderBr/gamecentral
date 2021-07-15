<script>

 function getColor(value){
	 //value from 0 to 1
	 var hue=(value*100).toString(10);
	 return ["hsl(",hue,",100%,50%)"].join("");
 }
</script>

<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');

if($_SESSION['username']){
	$self = $_SESSION['username'];
}else{
	header("Location: /");
}

function isFriends($friend, $otherFriend, $conn){
	$friendcombo = $friend . " - " . $otherFriend;
	$friendcombo2 = $otherFriend . " - " . $friend;
	if($friend == $otherFriend){
	}else{
			$sql = "SELECT * FROM friends WHERE friendCombo = '$friendcombo'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while($row = $result->fetch_assoc()) {
					$accepted = $row['accepted'];
					if($accepted == 1){
						echo "<button id='rem' value='" . $otherFriend . "' onclick='removeFriend(this)' title='Remove friend!' class='btn btn-danger'><i class='bi bi-person-x'></i></button><br>";
					}else{
						echo "<button value='" . $otherFriend . "' title='Friend request pending!' class='btn btn-secondary'>Request pending...</button><br>";
					}


				}
			}else{

			$sql = "SELECT * FROM friends WHERE friendCombo = '$friendcombo2'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {

				while($row = $result->fetch_assoc()) {
					$accepted = $row['accepted'];
					if($accepted == 1){
						echo "<button value='" . $otherFriend . "' id='rem' onclick='removeFriend(this)' title='Remove friend!' class='btn btn-danger'><i class='bi bi-person-x'></i></button><br>";
					}else{
						echo "<button value='" . $otherFriend . "' id='acceptF' onclick='acceptFriend(this)' title='Friend request pending!' class='btn btn-secondary'>Accept request!</button><br>";
					}


				}
			}else{
				echo "<button value='" . $otherFriend . "' id='addF' onclick='addFriend(this)' title='Add friend!' class='btn btn-success'><i class='bi bi-person-plus'></i></button><br>";
			}

			}





	}
}

if(isset($_GET['p'])){
	$pageOffset = $_GET['p'];
}else{
	$pageOffset = 0;
}

if($pageOffset < 0){
	header("Location: /findAFriend");
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="description" content="GameCentral find a friend page, here is the best place to find all sorts of people who are looking for games to play.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc, find people, find friends, find a friend">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - find a friend!"; ?></title>
		<meta name="title" content="GameCentral - find a friend!">
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
		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='noselect pt-2 pb-1'><i class="bi bi-person-lines-fill me-1 noselect"></i>Feeling lonely? <u>Find a friend</u>!</h4></div><?php include_once($_SERVER['DOCUMENT_ROOT'] . '/modules/friendSearch.php'); ?></div>
    <nav aria-label="Page navigation">
      <ul class="pagination">
        <li class="page-item"><a id='previous' class="page-link dark-box" href="/findAFriend?p=<?php echo $pageOffset-10; ?>">Previous</a></li>
        <li class="page-item"><a id='next' class="page-link dark-box" href="/findAFriend?p=<?php echo $pageOffset+10; ?>">Next</a></li>
      </ul>
    </nav>
    <hr class='nav-break'>
		<label><p class="sm-text noselect">FIND FRIENDS</p></label>


<div class='container-fluid bg-dark2 px-4 mt-2' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
	<div class='row gx-2'>
<?php

$sql = "SELECT * FROM users ORDER BY RAND() LIMIT 10 OFFSET $pageOffset";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {

		$username = $row['username'];
		$userid = $row['id'];
		$avatar = $row['avatar'];
		$userStatus = $row['status'];
		$karma = $row['karma'];

		if($userStatus != NULL){
			$userStatus = "is " . $userStatus;
		}


		echo "<div class='d-flex bg-darkest rounded mt-2 align-items-center'>
		<div class='me-auto p-2'>
			<a class='sm-text noselect me-2'>#" . $userid . "</a>
			<img width=32 height=32 class='ms-1 me-1 rounded-circle' src='" . $avatar . "'></img>
			<a style='color:white;' href='/user?u=" . $username . "'>" . $username . " <a class='gray'>" . $userStatus . "</a> </a>
		</div>
		<div class='p-2'><a class='sm-text noselect'>
		<a class='sm-text noselect me-3'><a class='sm-text me-2' id='karma" . $userid . "'>" . $karma . " KARMA</a>";

		echo "<script>
		 var kv = " . $karma . ";
		 var value = kv / 1000;
		 $('#karma" . $userid . "').attr('style', 'color: ' + getColor(value) + ' !important');</script>";

		isFriends($self, $username, $conn);


		 echo "</a></div></div>



		";

		//echo "<div id='" . $groupid . "l' style='border-radius:5px;' class='container bg-darkest p-4 position-relative mt-2'><a class='sm-text noselect me-2'>#" . $groupid . "</a><a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a><img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img><a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "<div style='transform: translate(0%, -50%) !important;' class='position-absolute top-50 end-0 translate-middle'><a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a><a class='sm-text noselect me-3'> / " . $groupSize . "</a>";
	}
} else {

	echo "<script>hide('#next')</script>

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No users on this page!</a>
    </div>

	";
}

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

function removeFriend(button){
	if(confirm("Are you sure you want to remove " +  $(button).val() + " as a friend?")){
	$.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: $(button).val(),
					self: "<?php echo $self; ?>",
					action: "remove"
				},
                success: function(data) {
					             $(button).html("Removed!");
                }
            });
					}
}

function addFriend(button){
	        $.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: $(button).val(),
					self: "<?php echo $self; ?>",
					action: "add"
				},
                success: function(data) {
					$(button).html("Requested!");
					$(button).removeClass("btn-danger");
					$(button).addClass("btn-secondary");
                }
            });
}

function acceptFriend(button){
	        $.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: $(button).val(),
					self: "<?php echo $self; ?>",
					action: "accept"
				},
                success: function(data) {
					$(button).html("Accepted!");
					$(button).removeClass("btn-secondary");
					$(button).addClass("btn-success");
                }
            });
}

</script>
		</div>
    </body>
</html>

<script src='https://unpkg.com/@wanoo21/countdown-time@1.2.0/dist/countdown-time.js'></script>


<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
