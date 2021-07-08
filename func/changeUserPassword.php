<?php

$user = $_GET['u'];
$newPassword = $_GET['n'];
$pass = $_GET['p'];
include_once('../cfg/cdns.php');

if($pass === $adminPassword){
$hashedpass = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "UPDATE users SET password='$hashedpass' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's password has been successfully changed";
}else{
	echo "There was an error changing this user's password: " . $conn->error;
}

}
$conn->close();

//Ex. Use: https://gamecentral.online/func/changeUserPassword.php?p=admin420&u=JohnDoe12&n=FuckJane21 (will change user JohnDoe12's password to FuckJane21, using the admin password. 
?>

