<?php

$pass = $_GET['p'];
include_once('../cfg/cdns.php');

if($pass === $adminPassword){

$sql = "SELECT * from regTokens WHERE used = 0";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
		echo "https://gamecentral.online/register?inv=" . $row['token'] . "<br>";
  }
}else{
	echo "FUCK YOU";
}

}
$conn->close();

//Ex. Use: https://gamecentral.online/func/listRegTokens.php?p=admin420 (will list all currently generated register tokens, and generate copy-pastable links to give users) 
?>