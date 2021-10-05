<?php
//Retrieve variables from POST
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$img = htmlspecialchars($_POST['img'], ENT_QUOTES, 'UTF-8');
$body = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');
$tags = htmlspecialchars($_POST['tags'], ENT_QUOTES, 'UTF-8');
$tagline = htmlspecialchars($_POST['tagline'], ENT_QUOTES, 'UTF-8');
include_once('../cfg/cdns.php');

//Start user session
session_start();
//Retrieve username from session variable
$self = $_SESSION['username'];

if(isAdmin($conn, $self) == true){
	$isAdmin = true;
}else{
	$isAdmin = false;
}

//If username is empty, redirect to login
if(!$self){
	("Location: /login");
}

//Include MYSQLDB passthrough

	//Create news post

	if($isAdmin == true){
	$sql54 = "INSERT INTO blogs (title, img, tags, content, tagline, author)
VALUES ('$title', '$img', '$tags', '$body', '$tagline', '$self')";

	if ($conn->query($sql54) === TRUE) {
		//Retrieve news post id
		 $publishedNews = $conn->insert_id;
		 //Redirect to newly created news post
		 header("Location: /news?n=" . $publishedNews);
	} else {
		header("Location: /");
	}
}else{
	$sql54 = "INSERT INTO blogs (title, img, tags, content, tagline, author, approved)
VALUES ('$title', '$img', '$tags', '$body', '$tagline', '$self', 0)";

	if ($conn->query($sql54) === TRUE) {
		//Retrieve news post id
		 $publishedNews = $conn->insert_id;
		 //Redirect to newly created news post
		 header("Location: /news?n=" . $publishedNews);
	} else {
		header("Location: /");
	}
}
?>
