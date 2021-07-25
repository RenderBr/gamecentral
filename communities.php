<?php
session_start();
if($_SESSION['username']){
$self = $_SESSION['username'];
}else{
	header("Location: /");
}

if(isset($_GET['p'])){
	$pageOffset = $_GET['p'];
}else{
	$pageOffset = 0;
}

if($pageOffset < 0){
	header("Location: /communities");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
			<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral communities page, here you may join a gaming community, of like minded people.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc, community, clan, find a clan, find a community, find gamers">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - communities!"; ?></title>
		<meta name="title" content="GameCentral - communities!">
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
		<h4 class='pt-2 pb-1 noselect'><a class='me-1 noselect'>🔭</a>Find a community. Find your people.</h4>
		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li class="page-item"><a id='previous' class="page-link dark-box" href="/communities?p=<?php echo $pageOffset-10; ?>">Previous</a></li>
		    <li class="page-item"><a id='next' class="page-link dark-box" href="/communities?p=<?php echo $pageOffset+10; ?>">Next</a></li>
		  </ul>
		</nav>
		<hr class='nav-break'></div>

		<label><p class="sm-text noselect mt-1">FIND A COMMUNITY FOR YOU</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<?php

$sql = "SELECT * FROM communities ORDER BY date_created DESC LIMIT 10 OFFSET " . $pageOffset . "";

$result = $conn->query($sql);
$numRows = $result->num_rows;

if ($result->num_rows > 0) {

	?>

	<div class='row gx-2'>

	<?php
  while($row = $result->fetch_assoc()) {

		$communityid = $row['id'];
		$owner = $row['communityOwner'];
		$communityMaxPeople = $row['communityMaxSlots'];
		$communityName = $row['communityName'];
		$communityImage = $row['communityImage'];

		$sql1 = "SELECT * FROM communityMembers WHERE communityId = $communityid";

		$result1 = $conn->query($sql1);
		$peopleInGroup = $result1->num_rows;

		echo "<div id='" . $communityid . "l' class='d-flex bg-darkest rounded mt-2 align-items-center'>
		<div class='me-auto p-2 align-middle'>
			<h4 class='ms-1' style='margin:0px !important;vertical-align: middle;
align-content: center;'><img title='" . $communityName . "' width=64rem height=64rem class='ms-1 rounded-circle' src='" . $communityImage . "'></img><a class='ms-1'>
" . $communityName . "<a class='sm-text ms-4 noselect' style='vertical-align: middle !important;'>OWNER: <a class='sm-text noselect' style='vertical-align: middle !important;' href='/user?u=" . $owner . "'>" . $owner . "</a></a></h4> </a>
		</div>
		<div class='p-2'><a class='sm-text noselect' id='" . $communityid . "t'>" . $peopleInGroup . "</a>
		<a class='sm-text noselect me-3'> / " . $communityMaxPeople . "</a>



		";

		//echo "<div id='" . $groupid . "l' style='border-radius:5px;' class='container bg-darkest p-4 position-relative mt-2'><a class='sm-text noselect me-2'>#" . $groupid . "</a><a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a><img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img><a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "<div style='transform: translate(0%, -50%) !important;' class='position-absolute top-50 end-0 translate-middle'><a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a><a class='sm-text noselect me-3'> / " . $groupSize . "</a>";

		$sql2 = "SELECT * FROM communityMembers WHERE communityId = $communityid AND username = '$self'";
		$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {

		  while($row2 = $result2->fetch_assoc()) {
				echo '<a id="gpage' . $communityid . '" class="btn btn-secondary me-2" href="/community?id=' . $communityid . '">View Community</a>';
			  echo "<button id='" . $communityid . "' value='" . $communityid . "' class='btn btn-danger' onclick='leaveCommunity(this)'>Leave!</button>";
			  if($_SESSION['username'] == $owner){
				echo "<button value='" . $communityid . "' onclick='deleteCommunity(this)' title='Delete your community!' class='sm-text btn'><i class='bi bi-x'></i></button>";
			}else{
			echo "<a style='margin-right: 50px;'></a>";
		}

		echo "</div></div>";
		  }

		}else{
			if($peopleInGroup < $communityMaxPeople){
			echo "<button id='" . $communityid . "' value='" . $communityid . "' onclick='joinCommunity(this)' class='btn btn-success'>Join group!</button>";
			}
			if($_SESSION['username'] == $owner){
			echo "<button value='" . $communityid . "' onclick='deleteCommunity(this)' title='Delete this group!' class='sm-text btn'><i class='bi bi-x'></i></button>";
		}else{
			echo "<a style='margin-right: 50px;'></a>";
		}

		echo "</div></div>";
		}




  }
} else {
	$noResults = true;
	echo "<script>hide('#next');</script>

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No communities to be displayed!</a>
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

function joinCommunity (button) {
      $.ajax({
        url: "/func/joinCommunity.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			cid:$(button).val()
		},
		success:function(data){
			$(button).html("Leave!");
			$(button).attr("onclick", "leaveCommunity(this)");
			$(button).removeClass("btn-success");
			$(button).addClass("btn-danger");
			var groupid = $(button).val();
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(t.textContent);
			$(button).before('<a id="gpage' + groupid + '" class="btn btn-secondary me-2" href="/community?id=' + groupid + '">View Community</a>');

			t.textContent = currentPlayers + 1 + "";

			}
     });
 }

 function leaveCommunity (button) {
      $.ajax({
        url: "/func/leaveCommunity.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			cid:$(button).val()
		},
		success:function(data){
			$(button).html("Join community!");
			$(button).attr("onclick", "joinCommunity(this)");
			$(button).removeClass("btn-danger");
			$(button).addClass("btn-success");
			var groupid = $(button).val();
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(t.textContent);
			$("#gpage" + groupid).remove();

			t.textContent = currentPlayers - 1 + "";

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
