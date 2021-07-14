<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
		$serverId = $_GET['id'];

		$sql = "SELECT * FROM servers WHERE id = '$serverId'";
		$result = $conn->query($sql);

    $sql3 = "SELECT * FROM servers";

    $result3 = $conn->query($sql3);
    $serversTotal = $result3->num_rows;

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

        if(isset($rank)){
          $rank = $rank;
        }else{
          $rank = NULL;
        }

		  }

		}else{
			header("Location: /servers");
		}

    if($)

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
			<div class='container-fluid bg-warning bg-gradient rounded' style="background: url(<?php echo $banner; ?>) !important;" width=100%>
			<img class='rounded-circle mb-1 border border-dark border-5 mt-2' width=128rem height=128rem src='https://gamecentral.online/images/generate.png'>
    </div>
    <div class='container rounded pt-1'>
  <div class='d-flex align-items-center'>
     <div class="me-auto p-2 bd-highlight"><h4 style='margin-bottom:0px !important;'><?php echo $serverName; ?><a title='Server ranking <?php echo $rank; ?> out of <?php echo $serversTotal; ?>' style='text-decoration:none;' class='noselect mt-3 ms-1 gray'>#<?php echo $rank; ?></a></h4>
</div>
     <div class='p-2'>			<a class='me-2'></div>
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
		</label>
		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $serverAddress . $serverPort; ?>
		</p>

		<?php
		echo "<label>
			<p class='sm-text' style='color:white; !important;'>
			";



        echo "
			</p>
		</label>";
		?>
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
