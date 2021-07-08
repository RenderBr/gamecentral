<?php

$user = $_POST['u'];

include_once("../cfg/cdns.php");
if(!$user){
	echo "Error!";
}

$firstQuery = $conn->query("UPDATE users SET karma = karma+2");


?>