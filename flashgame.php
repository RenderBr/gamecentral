<!DOCTYPE html>
<html lang="en">
    <head>
      <script type='text/javascript' src='/js/ruffle/ruffle.js'></script>
	<?php
		session_start();
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');

    if(isset($_GET['g'])){
      $gameId = $_GET['g'];
    }else{
      $gameId = NULL;
      header("Location: /flashgames");
    }

    $sql = "SELECT * FROM flashgame WHERE id = '$gameId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $gameURL = $row['gameURL'];
        $gameName = $row['gameName'];
        $gameVisitCount = $row['visits'] + 1;
        $gameDescription = $row['description'];
      }
    }

    $sql = "UPDATE flashgame SET visits=visits+1 WHERE id='$gameId'";
    if ($conn->query($sql) === TRUE) {}

		?>
		<meta name="description" content="Play <?php echo $gameName; ?> Flash Version @ Game Central. This still works even though Flash is no longer available. <?php echo $gameDescription; ?>">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc group, <?php echo $gameName; ?>, flash, play flash games, <?php echo $gameDescription; ?>">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - play " . $gameName . " without flash online now!"; ?></title>
		<meta name="title" content="GameCentral - play <?php echo $gameName; ?> without flash online now!">
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

			<h2 class='mb-0' style='margin-bottom:1rem;'><?php echo $gameName; ?><!--<img class='icon-md ms-1' title='<?php echo $gameName; ?>' src='<?php echo $gameSmIcon; ?>'> --></h2>
      <a class='sm-text noselect text-center'>Made possible by <a href='https://ruffle.rs/'>Ruffle.js</a>
      <a class='sm-text noselect text-center'> | Visits: <?php echo $gameVisitCount; ?></a></a>



      <hr class='mt-2 nav-break'>
      <div class='container-fluid mt-1 mt-3' id='game'>
    <script>
        window.RufflePlayer = window.RufflePlayer || {};
        window.addEventListener("load", (event) => {
            const ruffle = window.RufflePlayer.newest();
            const player = ruffle.createPlayer();
            const container = document.getElementById("game");
            container.appendChild(player);
            player.style.width = "700px";
            player.style.height = "550px";
            player.load("<?php echo $gameURL; ?>");
        });
    </script>
</div>
    <a class='sm-text noselect'><?php echo $gameDescription; ?></a>
<hr class='mt-2 nav-break' style='margin-bottom: 0.3rem !important;'>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8564713175090072"
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
</script>







		</div>


    </body>
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
