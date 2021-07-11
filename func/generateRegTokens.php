<?php

$pass = $_GET['p'];
$amount = $_GET['q'];
include_once('../cfg/cdns.php');

if($pass === $adminPassword){
	$i = 0;
	for ($i = 0; $i < $amount; $i++){
    $token = random_int(0, 10000);
	  $token = password_hash($token, PASSWORD_DEFAULT);
		$sql = "INSERT INTO regTokens (token)
		VALUES ('$token')";

		if ($conn->query($sql) === TRUE) {
		  echo "New record created successfully";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}
		
		
		
		
	}
	

	$conn->close();
}



//Ex. Use: https://gamecentral.online/func/generateRegTokens.php?p=admin420&q=10 (will generate 10 reg Tokens in DB)
?>
