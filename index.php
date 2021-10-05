<meta name="description" content="GameCentral, aiming to be the preeminent independent looking-for-group platform built for players all around the world.">
<?php
session_start();


if(!isset($_SESSION['username'])){
	include_once('unRegisteredDashboard.php');
}else{
	include_once('dashboard.php');
}

?>
