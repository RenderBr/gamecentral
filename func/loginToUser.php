<?php
$servername = "localhost";
$username = "2admin";
$password = "Wv9bGBaolonxw98w";
$dbname = "gamecentral";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$email = $_POST['email'];
$password = $_POST['password'];
$redirect = $_GET['r'];

$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
	$hashed_password = $row['password'];
	$user = $row['username'];	
	
	if (password_verify($password, $hashed_password)) {
	session_start();
	$_SESSION['username'] = $user;
	$conn->query("UPDATE users SET lastLoggedIn=CURRENT_TIMESTAMP WHERE username = '$user'");
	if($redirect){
		header("Location: " . $redirect);
	}else{
	 header("Location: /");
	}
	
	} else {
		if($redirect){
			header("Location: /login?f=1&r=" . $redirect);
		}else{
			header("Location: /login?f=1");
		}
	}
  }
} else {
	echo "0 results . $email";
	if($redirect){
				header("Location: /login?f=1&r=" . $redirect);
			}else{
				header("Location: /login?f=1");
			}
}




$conn->close();
?>