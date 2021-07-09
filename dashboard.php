<?php
if($_SESSION['username']){

}else{
	header("Location: /");
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
		<div class='bg-dark1 container mt-2 mb-4 pb-4' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='pt-3'>Hey, welcome back! How's it going, <u><?php echo $_SESSION['username']; ?></u>?</h4><hr class='nav-break'></div>

		<?php include_once('modules/recentposts.php'); ?>
		<?php include_once('modules/news.php'); ?>


		</div>
    </body>
</html>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
