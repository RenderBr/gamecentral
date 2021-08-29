<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/func/getMCServer.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/func/getRustServer.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/func/getArkServer.php');

require ($_SERVER['DOCUMENT_ROOT'] . '/modules/sourceQuery/SourceQuery/bootstrap.php');

	use xPaw\SourceQuery\SourceQuery;

	define( 'SQ_TIMEOUT',     1 );
	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
	// Edit this <-
	$Query = new SourceQuery( );

if(isset($_SESSION['username'])){
	$self = $_SESSION['username'];
}

if(isset($_GET['g'])){
	$gameLFG = $_GET['g'];
}else{
	$gameLFG = NULL;
}
if(isset($_GET['u'])){
	$userLFG = $_GET['u'];
}else{
	$userLFG = NULL;
}

if(isset($_GET['p'])){
	$pageOffset = $_GET['p'];
}else{
	$pageOffset = 0;
}

if($pageOffset < 0){
	header("Location: /lfg");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="description" content="GameCentral servers page, a place where you can find game servers of all types, of all qualities, instantly.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc, servers, game servers, minecraft servers, best servers, server list, minecraft server list, rust servers, game central servers page, gc servers">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - server list!"; ?></title>
		<meta name="title" content="GameCentral - server list!">
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
		<h4 class='pt-2 pb-1 noselect'><a class='me-1 noselect'></a>Want to <u>find a new server</u>? Boom!💥</h4><div>
		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li class="page-item"><a id='previous' class="page-link dark-box" href="/servers?p=<?php echo $pageOffset-10; ?>">Previous</a></li>
		    <li class="page-item"><a id='next' class="page-link dark-box" href="/servers?p=<?php echo $pageOffset+10; ?>">Next</a></li>
				<li class="page-item"><a id='next' class="page-link dark-box bg-success" href="/createServer">List a server!</a></li>
		  </ul>
		</nav>
		<hr class='nav-break'></div>
		</div>

		<label><p class="sm-text noselect mt-1">SERVER BROWSER</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/modules/viewGroupButton.php');
if(isset($gameLFG)){
	$sql = "SELECT * FROM servers WHERE public = 0 AND forGame = '$gameLFG' ORDER BY votes DESC LIMIT 10 OFFSET " . $pageOffset . "";
}else{
	$sql = "SELECT * FROM servers WHERE public = 0 ORDER BY votes DESC LIMIT 10 OFFSET " . $pageOffset . "";
}

$result = $conn->query($sql);
$numRows = $result->num_rows;

if ($result->num_rows > 0) {

	?>

	<div class='row gx-2'>

	<?php
	$rank = 0;
  while($row = $result->fetch_assoc()) {

		$serverId = $row['id'];
		$serverName = $row['serverName'];
		$poster = $row['poster'];
		$maxPlayerCnt = $row['maxPlayerCount'];
		$serverGame = $row['forGame'];
		$publicity = $row['public'];
		$currentPlayerCount = $row['currentPlayerCount'];
		$dateCreated = $row['date_created'];
		$serverAddress = $row['ip'];
		$serverPort = $row['port'];
		$banner = $row['bannerImage'];
		$rank++;
		$description = $row['serverDescription'];
		$votes = $row['votes'];

		$sql3 = "SELECT * FROM votes WHERE forServer = '$serverId' AND MONTH(date_created) = MONTH(CURRENT_DATE())";

		$result3 = $conn->query($sql3);
		$votes = $result3->num_rows;

		$notifs = $conn->query("UPDATE servers SET votes = '$votes' WHERE id = '$serverId'");
		$notifs = $conn->query("UPDATE servers SET rank = '$rank' WHERE id = '$serverId'");

		$sql1 = sprintf("SELECT * FROM games WHERE name = '%s'", mysqli_real_escape_string($conn, $serverGame));
		$result1 = $conn->query($sql1);

		if ($result1->num_rows > 0) {

		  while($row1 = $result1->fetch_assoc()) {
			$iconSm = $row1['sm_icon'];
			$gameTooltip = sprintf($row1['name']);

			if($row1['shortName']){
				$gameName = $row1['shortName'];
			}else{
				$gameName = $gameTooltip;
			}

		  }
		}else{
		}


		if($serverGame == "Minecraft"){
		$serverStatus = getMCStatus($serverAddress, $serverPort);

		if($serverStatus == true){
		$currentPlayerCount = getMCPlayerCnt($serverAddress, $serverPort);
		$maxPlayerCnt = getMCMaxPlayerCnt($serverAddress, $serverPort);
		$serverStatus = NULL;
	}else{
		$currentPlayerCount = "0";
		$maxPlayerCnt = "0";
		$serverStatus = "<a class='ms-1 text-danger'>(OFFLINE)</a>";
	}
				if(isset($serverPort)){
					$serverPort = ":" . $serverPort;
				}else{
					$serverPort = NULL;
				}
		}

		if($serverGame == "Rust"){
			$serverStatus = getRustStatus($serverAddress, $serverPort, $Query);

			if($serverStatus == true){
			$currentPlayerCount = getRustPlayerCnt($serverAddress, $serverPort, $Query);
			$maxPlayerCnt = getRustMaxPlayerCnt($serverAddress, $serverPort, $Query);
			$serverStatus = NULL;
		}else{
			$currentPlayerCount = "0";
			$maxPlayerCnt = "0";
			$serverStatus = "<a class='ms-1 text-danger'>(OFFLINE)</a>";
		}

				if(isset($serverPort)){
					$serverPort = ":" . $serverPort;
				}else{
					$serverPort = NULL;
				}
		}

		if($serverGame == "Garry's Mod"){
			$serverStatus = NULL;
			$currentPlayerCount = NULL;
			$maxPlayerCnt = NULL;

			$serverStatus = getArkStatus($serverAddress, $serverPort, $Query);

			if($serverStatus == true){
			$currentPlayerCount = getArkPlayerCnt($serverAddress, $serverPort, $Query);
			$maxPlayerCnt = getArkMaxPlayerCnt($serverAddress, $serverPort, $Query);
			$serverStatus = NULL;
		}else{
			$currentPlayerCount = "0";
			$maxPlayerCnt = "0";
			$serverStatus = "<a class='ms-1 text-danger'>(OFFLINE)</a>";
		}

				if(isset($serverPort)){
					$serverPort = ":" . $serverPort;
				}else{
					$serverPort = NULL;
				}
		}

		$gameTooltip = 'title="' . $gameTooltip . '"';

		echo "<div id='" . $rank . "l' class='d-flex bg-darkest rounded align-items-center'>
		<div class='me-auto p-2'>
			<a title='Rank " . $rank . " out of " . $rank . "' class='sm-text noselect me-2'>#" . $rank . "</a>
			<a href='/server?id=" . $serverId . "'><img title='" . $serverName . "' width=468px height=80px class='img rounded border border-dark' src='" . $banner . "' style='overflow:hidden;'></a><br>
			<a href='/server?id=" . $serverId . "'><h2 style='color:white;' class='ms-4'>" . $serverName . $serverStatus .  "</a><img src='" . $iconSm . "'" . $gameTooltip . "' class='icon-sm ms-2'> <a class='sm-text'>(" . $votes . " votes)</a> </h2>
			<a class='gray ms-4'>" . $description . "</a>
		</div>
		<div class='p-2'><button onclick='copyThis(this)' value='" . $serverAddress . $serverPort . "' id='copyIP' title='click to copy IP' class='gray me-2 btn btn-outline-secondary btn-sm'><i class='me-2 bi bi-clipboard-plus' style='color:white;'></i>" . $serverAddress . $serverPort . "</button><a href='/server?id=" . $serverId . "' class='btn btn-success me-2 ms-1 btn-sm'>View more info...</a><div class='d-flex justify-content-center border border-dark mt-2'><a class='sm-text noselect' id='" . $rank . "t'>Players online: " . $currentPlayerCount . " </a>
		<a class='sm-text noselect ms-1 me-3'> / " . $maxPlayerCnt . "</a></div>



		";

		//echo "<div id='" . $groupid . "l' style='border-radius:5px;' class='container bg-darkest p-4 position-relative mt-2'><a class='sm-text noselect me-2'>#" . $groupid . "</a><a style='color:white;' href='/user?u=" . $user . "'>" . $user . " <a class='gray'>&nbsp;is looking to play</a> </a><img title='" . $gameTooltip . "' width=32 class='ms-1' src='" . $iconSm . "'></img><a class='sm-text ms-1'>" . $gameName . ",</a> <a class='gray'>with a group of <a id='" . $groupid . "n'>" . $currentGroup . "</a> / " . $groupSize . " players. " . $groupName . "<div style='transform: translate(0%, -50%) !important;' class='position-absolute top-50 end-0 translate-middle'><a class='sm-text noselect' id='" . $groupid . "t'>" . $currentGroup . "</a><a class='sm-text noselect me-3'> / " . $groupSize . "</a>";

		echo "</div></div>		<hr class='nav-break'>
";




  }
} else {
	$noResults = true;
	echo "<script>hide('#next');</script>

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No servers are currently listed!</a>
    </div>

	";

}

$conn->close();


?>
</div>
</div>

<style>
#copyIP:focus{
	background-color:none !important;
}
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

<hr class='nav-break mt-2'>



		</div>
    </body>
</html>

<script>

function copyThis(button){
	copyToClipboard($(button).val());
}


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
</style>
