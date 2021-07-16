<?php
$title = $_POST['title'];
$img = $_POST['img'];
$body = $_POST['body'];
$tags = $_POST['tags'];
$tagline = $_POST['tagline'];

session_start();
$self = $_SESSION['username'];

if(!$self){
	("Location: /servers");
}

include_once('../cfg/cdns.php');

	$sql54 = "INSERT INTO blogs (title, img, tags, content, tagline, author)
VALUES ('$title', '$img', '$tags', '$body', '$tagline', '$self')";

	if ($conn->query($sql54) === TRUE) {
		 $publishedNews = $conn->insert_id;
		 header("Location: /news?n=" . $publishedNews);
	} else {
		header("Location: /");
	}
?>
