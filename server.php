<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/func/getMCServer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/func/getRustServer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/func/getArkServer.php');
    include_once($_SERVER['DOCUMENT_ROOT'] . '/modules/voteServerButton.php');
    require ($_SERVER['DOCUMENT_ROOT'] . '/modules/sourceQuery/SourceQuery/bootstrap.php');
    use xPaw\SourceQuery\SourceQuery;

  	define( 'SQ_TIMEOUT',     1 );
  	define( 'SQ_ENGINE',      SourceQuery::SOURCE );
  	// Edit this <-
  	$Query = new SourceQuery( );

		$serverId = $_GET['id'];
    $sql3 = "SELECT * FROM servers";

    $result3 = $conn->query($sql3);
    $serversTotal = $result3->num_rows;

		$sql = "SELECT * FROM servers WHERE id = $serverId";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
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
    		$rank = $row['rank'];
    		$description = $row['serverDescription'];
    		$votes = $row['votes'];

        if($serverGame == "Minecraft"){
          $serverStatus = getMCStatus($serverAddress, $serverPort);

          if($serverStatus == true){
          $currentPlayerCount = getMCPlayerCnt($serverAddress, $serverPort);
          $maxPlayerCnt = getMCMaxPlayerCnt($serverAddress, $serverPort);
          $serverStatus = "<a class='ms-1 sm-text text-success noselect'>ONLINE!</a>";
        }else{
          $currentPlayerCount = "0";
          $maxPlayerCnt = "0";
          $serverStatus = "<a class='ms-1 sm-text text-danger noselect'>OFFLINE!</a>";
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
          $serverStatus = "<a class='ms-1 sm-text text-success noselect'>ONLINE!</a>";
        }else{
          $currentPlayerCount = "0";
          $maxPlayerCnt = "0";
          $serverStatus = "<a class='ms-1 sm-text text-danger noselect'>OFFLINE!</a>";
        }

        if(isset($serverPort)){
          $serverPort = ":" . $serverPort;
        }else{
          $serverPort = NULL;
        }

        }


      if($serverGame == "Garry's Mod"){
        $serverStatus = getRustStatus($serverAddress, $serverPort, $Query);

        if($serverStatus == true){
        $currentPlayerCount = getRustPlayerCnt($serverAddress, $serverPort, $Query);
        $maxPlayerCnt = getRustMaxPlayerCnt($serverAddress, $serverPort, $Query);
        $serverStatus = "<a class='ms-1 sm-text text-success noselect'>ONLINE!</a>";
      }else{
        $currentPlayerCount = "0";
        $maxPlayerCnt = "0";
        $serverStatus = "<a class='ms-1 sm-text text-danger noselect'>OFFLINE!</a>";
      }

      if(isset($serverPort)){
        $serverPort = ":" . $serverPort;
      }else{
        $serverPort = NULL;
      }

      }


        if(isset($rank)){
          $rank = $rank;
        }else{
          $rank = NULL;
        }

        $sql1 = sprintf("SELECT * FROM games WHERE name = '%s'", mysqli_real_escape_string($conn, $serverGame));
        $result6 = $conn->query($sql1);


        if ($result6->num_rows > 0) {
    		  // output data of each row
    		  while($row = $result6->fetch_assoc()) {
              $icon = $row['sm_icon'];
              $shortname = $row['shortName'];
          }
        }

		  }

		}else{
			header("Location: /servers");
		}

		?>
		<meta name="description" content="<?php echo $serverName . " - " . $description;?>">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc server, gc servers, <?php echo $serverName; ?>, <?php echo $serverGame; ?>, gc server page">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - " . $serverName . " for " . $serverGame . "!"; ?></title>
		<meta name="title" content="GameCentral - <?php echo $serverName . " for " . $serverGame ."!"; ?>">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body style='background: url(https://gamecentral.online/images/generate.png);'>
	<?php include_once('modules/navbar.php'); ?>

		<br><div class='bg-dark1 container user pb-1 rounded' style='padding:0px;'>
			<div class='container-fluid bg-warning bg-gradient rounded' style="background: url(<?php echo $banner; ?>) no-repeat !important;background-size: contain !important;" width=100%>
			<img title='This is a <?php echo $serverGame; ?> server!' class='rounded-circle mb-1 mt-2' width=128rem height=128rem src='<?php echo $icon; ?>'>
    </div>
    <div class='container rounded pt-1'>
  <div class='d-flex align-items-center'>
     <div class="me-auto p-2 bd-highlight"><h4 style='margin-bottom:0px !important;'><?php echo $serverName; ?><a title='Server ranking <?php echo $rank; ?> out of <?php echo $serversTotal; ?>' style='text-decoration:none;' class='noselect mt-3 ms-1 gray'>#<?php echo $rank . $serverStatus; voteButton($serverId, $conn); ?></a></h4>
</div>
     <div class='p-2'><a></div>
  </div>
  <hr class='nav-break'>


		<label>
			<p class="sm-text">DESCRIPTION</p>
		</label>
		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $description; ?>
		</p>

    <label>
			<p class="sm-text">SERVER ADDRESS</p>
		</label><br>
		<p title='click to copy IP' class='btn' id='copyThis' style='margin-bottom:0.75rem !important;color:white;padding:0 !important;'>
			<?php echo $serverAddress . $serverPort; ?><i class="ms-2 bi bi-clipboard-plus"></i>
		</p><br>

    <label>
			<p class="sm-text">PLAYERS ONLINE</p>
		</label>
		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $currentPlayerCount . " / " . $maxPlayerCnt; ?>
		</p>

    <a class='gray sm-text'>Are you the owner of this server? Would you like to modify information or remove it? <a class='sm-text' style='color:white !important;' href='mailto:julian@gamecentral.online'>Contact us via email...</a></a>
   </a>
  </div>

		</div>

			</div>

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


	$('#copyThis').click(function () { copyToClipboard("<?php echo $serverAddress . $serverPort; ?>"); });

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
