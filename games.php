<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');

if(isset($_GET['p'])){
	$pageOffset = $_GET['p'];
}else{
	$pageOffset = 0;
}

if($pageOffset < 0){
	header("Location: /lfg");
}

?>
<script>
</script>
<!DOCTYPE html>
<html lang="en">
    <head>
			<script src="/css/colorify/scripts/colorify.js"></script>

		<meta name="description" content="GameCentral games listing page, find all games in our database and some information about them.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc, games page, about games, what games to play">
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
		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='pt-2 pb-1 noselect'><a class='me-1 noselect'>🔭</a>Looking for a new game to play? We have many you can discover.</h4>
		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li class="page-item"><a id='previous' class="page-link dark-box" href="/games?p=<?php echo $pageOffset-10; ?>">Previous</a></li>
		    <li class="page-item"><a id='next' class="page-link dark-box" href="/games?p=<?php echo $pageOffset+10; ?>">Next</a></li>
		  </ul>
		</nav>
		<hr class='nav-break'></div>

		<label><p class="sm-text noselect mt-1">GAMES DATABASE</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<?php

$sql = "SELECT * FROM games ORDER BY id DESC LIMIT 10 OFFSET " . $pageOffset . "";

$result = $conn->query($sql);
$numRows = $result->num_rows;

if ($result->num_rows > 0) {

	?>

	<div class='row gx-2'>

	<?php
  while($row = $result->fetch_assoc()) {

		$gameId = $row['id'];
		$gameName = $row['name'];
		$shortName = $row['shortName'];
		$icon = $row['sm_icon'];
		$color = $row['bgColor'];
		$textColor = $row['textColor'];

		if(isset($color)){
			$color = 'background-color: ' . $color . ' !important;';
		}

		if(isset($textColor)){
			$textColor = 'color: ' . $textColor . ' !important;';
		}else{
			$textColor = 'color:white !important;';
		}


		echo "<div id='" . $gameId . "l' class='d-flex bg-darkest rounded mt-2 align-items-center' style='" . $color . "'>
		<div class='me-auto p-2'>
			<img title='" . $gameName . "' width=32 class='ms-1 me-1' id='" . $gameId . "g' src='" . $icon . "'></img>
			<a style='" . $textColor . "' href='/game?id=" . $gameId . "'>" . $gameName . "  </a>
			<a class='sm-text ms-1 noselect'>" . $shortName . "
		</div>

		<script>

		</script>

		<div class='p-2'>



		";
			  echo "<a href='/game?id=" . $gameId ."' id='" . $gameId . "' value='" . $gameId . "' class='btn btn-success'>Find more info..</a>";

		echo "</div></div>";








  }
} else {
	$noResults = true;
	echo "<script>hide('#next');</script>

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No games to be displayed on this page!</a>
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
