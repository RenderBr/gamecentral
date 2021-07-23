<?php
session_start();

if($_SESSION['username']){
}else{
	header("Location: /");
}
$self = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');	?>
		<meta name="description" content="GameCentral community creation page, you may create communities here.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc create, community creation">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - create a community!"; ?></title>
		<meta name="title" content="GameCentral - create a community!">
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
		<div class='bg-dark1 container mb-4 pb-3 rounded' style="max-width: 27rem;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);"><div class='text-center'>
		<h4 class='pt-2 pb-1 noselect'><i class="bi bi-pencil-square noselect me-1"></i>Create <u>your community</u>!</h4><hr class='nav-break'></div>
		<form action='/func/createCommunity.php' method='POST'>
		<label for='communityname'><p class="sm-text">COMMUNITY NAME</p></label>
		<div class="input-group input-group-md sm"><input id='communityname' name="communityname" type="text" class="dark-box form-control" placeholder="My Loving Community..." aria-label="Enter a name for your community..." aria-describedby="button-submit" /></div>
		<label for='description'><p class="sm-text">COMMUNITY DESCRIPTION</p></label>
		<div class="input-group input-group-md sm"><textarea id='description' name="description" type="textarea" class="dark-box form-control" placeholder="Tell the world about your community... why should people join this community?" aria-label="Tell the world about your community..." aria-describedby="button-submit" /></textarea></div>
		<label for='discordInvite'><p class="sm-text discord">DISCORD INVITE</p></label>
		<div class="input-group input-group-md sm"><input id='discordInvite' name="discordInvite" type="text" class="dark-box form-control" placeholder="https://discord.gg/3tTmTWZHrS..." aria-label="Enter your full Discord invite link" aria-describedby="button-submit" /></div>
		<label for='img'><p class="sm-text">COMMUNITY IMAGE</p></label>
		<div class="input-group input-group-md sm"><input id='img' name="img" type="text" class="dark-box form-control" placeholder="https://direct-link-to-image.png..." aria-label="Enter a direct image link" aria-describedby="button-submit" /></div>
		<div>
		<br>
		<div class='text-center'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Create group!</button>
		</div>
		</form>
		</div>

        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
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
