<?php
$message = htmlspecialchars($_POST['messageOnFeed'], ENT_QUOTES, 'UTF-8');
$user = $_POST['userFeed'];



session_start();

if(isset($_SESSION['username'])){
	$self = $_SESSION['username'];
}else{
	header("Location: /user?u=" . $user);

}

include_once ($_SERVER['DOCUMENT_ROOT'] . '/cfg/conn.php');

$sql = "INSERT INTO feedPosts (userProfile, poster, messageContents, messageType)
VALUES ('$user', '$self', '$message', 'text')";

if ($conn->query($sql) === TRUE) {
	header("Location: /user?u=" . $user);
} else {
	header("Location: /user?u=" . $user);
}

?>
