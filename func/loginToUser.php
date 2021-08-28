<?php
include_once('../cfg/conn.php');

$email = $_POST['email'];
$password = $_POST['password'];
$redirect = $_POST['r'];

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
