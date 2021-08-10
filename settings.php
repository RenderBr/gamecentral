<?php
session_start();
if($_SESSION['username']){
	$myusername = $_SESSION['username'];
}else{
	header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');

		$sql = "SELECT * FROM users WHERE username = '$myusername'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
			  $email = $row['email'];
			  $bio = $row['bio'];
			  $myid = $row['id'];
			  $myavatar = $row['avatar'];
			  $mybg = $row['bg'];
			  $mydiscord = $row['discord'];
				$myStatus = $row['status'];
				$myBanner = $row['bannerImage'];
				$myTwitch = $row['twitch'];
		  }

		}

		?>
		<meta name="description" content="GameCentral user settings, here you may configure your profile and settings.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc settings">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - user settings!"; ?></title>
		<meta name="title" content="GameCentral - user settings!">
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
		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 50rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);">
		<div class='text-center'>
			<h4 class='noselect pt-2 pb-1'><i class="bi bi-gear gray me-2"></i>Settings</h4>
			<hr class='nav-break' style='margin-bottom:0.5rem !important;'>
		</div>

			<!--- USERNAME (permanent) -->
			<label style='margin-right:0.5rem;' class='noselect sm-text' for='username'>USERNAME </label>
			<div class="input-group">
				<input class='noselect dark-box form-control' title='Your username is permanent!' value='<?php echo $myusername; ?>' type='text' disabled>
					<span style='margin-bottom:0px;' class="input-group-text noselect dark-box">
						<a class='sm-text' style='text-decoration:none;margin-bottom:0px;'>#<?php echo $myid; ?></a>
					</span>
				</input>
			</div>
			<br>

			<!--- BIO -->
			<label style='margin-right:0.5rem;' class='noselect sm-text' for='bio'>BIO </label>
			<form name='form1' method='POST' id='form1' action='/func/changeBG.php'>
					<div class="input-group mb-3">
						<textarea name='b' id='bio' class='dark-box form-control' aria-describedby="sideButton"><?php echo $bio; ?></textarea>
						<button form='form1' id="sideButton" class='btn btn-outline-success input-group-text' type='submit'><i class="bi bi-check-circle"></i></button>
					</div>
			</form>

			<!--- USER STATUS -->
			<form name='form4' class='mb-3' method='POST' id='form4' action='/func/changeStatus.php'>
			<label style='margin-right:0.5rem;' class='noselect sm-text' for='status'>STATUS</label>
			<br>
			<div class="input-group">
			<span style='margin-bottom:0px;' class="input-group-text noselect dark-box">
				<a class='sm-text' style='text-decoration:none;margin-bottom:0px;'><?php echo $myusername; ?> is...</a>
			</span>
			<input name='s' type='text' id='status' class='dark-box form-control' value='<?php echo $myStatus; ?>'></input>
			<button form='form4' id="sideButton2" class='btn btn-outline-success input-group-text' type='submit'><i class="bi bi-check-circle"></i></button>
		</div>
			<p class='sm-text noselect'>This will be featured on the <a href='/findAFriend'><strong>Find a Friend</strong></a> page, and posted to your feed on <a href='/user?u=<?php echo $myid; ?>'><strong>your profile page</strong></a>.</p>
			</form>

			<!--- AVATAR -->
			<label style='margin-right:0.5rem;' class='noselect sm-text' for='avatar'>AVATAR</label>
			<form id='formAv' action="/func/uploadImage.php" method="post" enctype="multipart/form-data">
				<div class="input-group">
				  <label for="formFile">
				  <input name='fileToUpload' id='fileToUpload' class="form-control dark-box" type="file" id="formFile"></label>
					<button form='formAv' type="submit" class='btn btn-outline-success input-group-text rounded rounded-right' name="submit"><i class="bi bi-check-circle"></i></button>
				</div>
			</form>

			<form id='form2' class='mb-3' method='post' action='/func/changeAvatar.php'>
			<br>
			<div class="input-group">
				<input name='a' type='text' id='avatar' class='dark-box form-control' value='<?php echo $myavatar; ?>'></input>
				<input form='form2' type="submit" style="display: none"></input>
				<button form='form2' id="sideButton" class='btn btn-outline-success input-group-text rounded rounded-right' type='submit' style='border-top-right-radius: 0.25rem !important;
border-bottom-right-radius: 0.25rem !important;'><i class="bi bi-check-circle"></i></button>
				<p class='sm-text noselect'><strong>Notice:</strong> Image link must be direct (make sure the link ends in .PNG or .JPG, etc), and it must use the HTTPS security protocol . Currently, there's no way to upload directly to Game Central. Image uploading to GC will be implemented in the future.</p>
			</div>

			</form>

			<!--- BANNER -->
			<form id='form6' class='mb-3' method='post' action='/func/changeBanner.php'>
			<label style='margin-right:0.5rem;' class='noselect sm-text' for='banner'>BANNER</label>
			<br>
			<div class="input-group">
				<input name='b' type='text' id='banner' class='dark-box form-control' value='<?php echo $myBanner; ?>'></input>
				<button form='form6' id="sideButton" class='btn btn-outline-success input-group-text' type='submit'><i class="bi bi-check-circle"></i></button>
			</div>
			<input form='form6' type="submit" style="display: none"></input>
			<p class='sm-text noselect'>If you are having difficulty with this, please read the avatar notice text.</p>
			</form>

			<!--- BG IMAGE -->
			<form name='form3' class='mb-3' method='POST' id='form3' action='/func/changeBackground.php'>
			<label style='margin-right:0.5rem;' class='noselect sm-text' for='bg'>BACKGROUND</label>
			<br>
			<div class="input-group">
				<input name='bg' type='text' id='bg' class='dark-box form-control' value='<?php echo $mybg; ?>'></input>
				<button form='form3' id="sideButton" class='btn btn-outline-success input-group-text' type='submit'><i class="bi bi-check-circle"></i></button>
			</div>
			<input form='form3' type="submit" style="display: none"></input>
			<p class='sm-text noselect'>If you are having difficulty with this, please read the avatar notice text.</p>
			</form>


			<!--- DISCORD -->
			<form name='form7' class='mb-3' method='POST' id='form7' action='/func/connectDiscord.php'>
			<label style='margin-right:0.5rem;color:#7289DA !important;' class='noselect sm-text' for='discord'>DISCORD</label>
			<br>
			<div class="input-group">
				<input name='discord' type='text' id='discord' class='dark-box form-control' value='<?php echo $mydiscord; ?>'></input>
				<button form='form7' id="sideButton7" class='btn btn-outline-success input-group-text' type='submit'><i class="bi bi-check-circle"></i></button>
			</div>
			<p class='sm-text noselect'><strong>Example:</strong> DiscordUsername#1234</p>

			</form>

			<!--- TWITCH -->
			<form name='form57' class='mb-3' method='POST' id='form57' action='/func/connectTwitch.php'>
			<label style='margin-right:0.5rem;color:#9147ff !important;' class='noselect sm-text' for='twitch'>TWITCH</label>
			<br>
			<div class="input-group">
				<input name='twitch' type='text' id='twitch' class='dark-box form-control' value='<?php echo $myTwitch; ?>'></input>
				<button form='form57' id="sideButton57" class='btn btn-outline-success input-group-text' type='submit'><i class="bi bi-check-circle"></i></button>
			</div>
			<p class='sm-text noselect'><strong>Example:</strong> twitchusername</p>

			</form>

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
