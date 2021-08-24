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

		$gameId = $_GET['id'];

		$sql = "SELECT * FROM games WHERE id = $gameId";
		$result = $conn->query($sql);

    $googleAd = '<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8564713175090072"
         crossorigin="anonymous"></script>
    <!-- DisplayAd -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-8564713175090072"
         data-ad-slot="7188111027"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>';

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
          $gameName = $row['name'];
          $shortName = $row['shortName'];
          $description = $row['description'];
          $banner = $row['banner'];
          $icon = $row['sm_icon'];
          $maxGroupSize = $row['maxGroupSize'];

		  }

		}else{
			header("Location: /games");
		}

		?>
		<meta name="description" content="<?php echo $gameName . " - " . $description;?>">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc server, gc servers, <?php echo $gameName; ?>, <?php echo $description . ", " . $shortName; ?>, gc server page">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - What is " . $gameName . "?"; ?></title>
		<meta name="title" content="GameCentral - What is <?php echo $gameName . "?"; ?>">
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
			<div class='container-fluid bg-warning bg-gradient rounded' style="background: url(<?php echo $banner; ?>) no-repeat !important;background-size: cover !important;
background-position: center !important;height:12rem !important;" width=100% >
    </div>
    <div class='container rounded pt-1'>
  <div class='d-flex align-items-center'>
     <div class="me-auto p-2 bd-highlight"><h4 style='margin-bottom:0px !important;'><img <?php echo $shortName; ?> server!' class='rounded-circle mb-1 mt-2 me-2' width=32rem height=32rem src='<?php echo $icon; ?>'><?php echo $gameName; ?></h4>
</div>
     <div class='p-2'><a></div>
  </div>
  <hr class='nav-break'>


		<label>
			<p class="sm-text">DESCRIPTION
</p>
		</label>
		<p style='margin-bottom:0.75rem !important;'>
			<?php echo $description; ?>
		</p>

    <label>
      <p class="sm-text">MAX GROUP SIZE
</p>
    </label>
    <p style='margin-bottom:0.75rem !important;'>
      <?php echo $maxGroupSize; ?>
    </p>


  </div>

		</div>

			</div>

		</div>

    <div class='bg-dark1 container user rounded mt-1 pb-3 mb-4'>

    <hr class='nav-break'>
    <label>
    <p class='sm-text noselect'>AD (SUPPORTS GAME CENTRAL)</p>
    </label>
    <hr class='nav-break mb-2'>
    <?php echo $googleAd; ?>
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
