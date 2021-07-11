<?php
session_start();


if(!isset($_SESSION['username'])){
	include_once('landing.php');
}else{
	include_once('dashboard.php');
}

?>
