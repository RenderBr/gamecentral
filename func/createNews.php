<?php
$title = htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8');
$img = htmlspecialchars($_POST['img'], ENT_QUOTES, 'UTF-8');
$body = htmlspecialchars($_POST['body'], ENT_QUOTES, 'UTF-8');
$tags = htmlspecialchars($_POST['tags'], ENT_QUOTES, 'UTF-8');
$tagline = htmlspecialchars($_POST['tagline'], ENT_QUOTES, 'UTF-8');


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
