<?php
//Check if user is logged in, if not, redirect to homepage.
if(!isset($_SESSION['username'])){
	$self = NULL;
}else{
	$self = $_SESSION['username'];
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral dashboard, here you may find other groups, and more.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc dashboard">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - dashboard!"; ?></title>
		<meta name="title" content="GameCentral - dashboard!">
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
		<div class='bg-dark1 container mb-4 pb-3 rounded' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='pt-2 noselect' style='margin:0 !important;'><a class='me-1 noselect'><?php if(isset($self)){ echo "👋</a> Hey, welcome back! How's it going, <u>" . $self . "</u>?"; }else{ echo "👋</a> Hey, welcome to Game Central!"; }; ?></h4><a class='gray noselect mb-2'><strong>Note:</strong> To anyone seeing this, you are using a very early-access version of Game Central, please use at your own risk and report any bugs you may find on the <a href='https://discord.gg/GVn8teTR6V' class='discord'>Discord!</a><a class='gray noselect'> Thank you.</a></a><hr class='nav-break'></div>

			<?php // News & Info Include
			 include_once('modules/news.php'); ?>
			 <hr class='nav-break mt-2'>
		<?php // MyFeed Include
		 include_once('modules/myfeed.php'); ?>
		<?php // Recent LFG Include
		include_once('modules/recentposts.php'); ?>



		</div>
    </body>
</html>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
