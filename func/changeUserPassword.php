<?php
//Get user from GET
$user = $_GET['u'];
//Get new password from GET
$newPassword = htmlspecialchars($_GET['n'], ENT_QUOTES, 'UTF-8');

//Get admin password from GET
$pass = $_GET['p'];

//Include MYSQLDB passthrough
include_once('../cfg/cdns.php');

//Check if $pass is the same as global admin password
if($pass === $adminPassword){
	//Hash password with bcrypt
$hashedpass = password_hash($newPassword, PASSWORD_DEFAULT);

//Update user's password with new hashed password
$sql = "UPDATE users SET password='$hashedpass' WHERE username = '$user'";

if($conn->query($sql) === TRUE){
	echo "User's password has been successfully changed";
}else{
	echo "There was an error changing this user's password: " . $conn->error;
}

}
$conn->close();
//Close the connection
//Ex. Use: https://gamecentral.online/func/changeUserPassword.php?p=admin420&u=JohnDoe12&n=FuckJane21 (will change user JohnDoe12's password to FuckJane21, using the global admin password)
?>
