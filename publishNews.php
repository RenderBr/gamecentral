<?php
session_start();

if($_SESSION['username']){
}else{
	header("Location: /");
}
$self = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');	?>
		<meta name="description" content="GameCentral newsletter creation page, admins may create a newsletter here!!">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc news, server newsletter, admin only">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - publish a newsletter!"; ?></title>
		<meta name="title" content="GameCentral - publish a newsletter!">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body style='background: url(/images/generate.png)'>
	<?php include_once('modules/navbar.php'); ?>


		<br>
		<div class='bg-dark1 container mb-4 pb-3 rounded' style="max-width: 27rem;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);"><div class='text-center'>
		<h4 class='pt-2 pb-1 noselect'><i class="bi bi-newspaper noselect me-1"></i>Publish a <u>newsletter</u>!</h4><hr class='nav-break'></div>
		<form action='/func/createNews.php' method='POST'>
		<label for='title'><p class="sm-text">ARTICLE TITLE</p></label>
		<div class="input-group input-group-md sm"><input id='title' name="title" type="text" class="dark-box form-control" placeholder="Hello, world!" aria-label="Enter a name for the article..." aria-describedby="button-submit" /></div>
		<label for='img'><p class="sm-text">ARTICLE IMAGE</p></label>
		<div class="input-group input-group-md sm"><input autocomplete="off" id='img' name="img" type="text" class="dark-box form-control" placeholder="https://link-to-image.png" aria-label="Add an image to the article!" aria-describedby="button-submit" /></div>
		<label for='body'><p class="sm-text">ARTICLE CONTENTS</p></label>
		<div class="input-group input-group-md sm"><textarea id='body' name="body" class="dark-box form-control" placeholder="Blah blah blah... (html formatting)" aria-describedby="button-submit"></textarea></div>
		<label for='tags'><p class="sm-text">ARTICLE TAGS/KEYWORDS</p></label>
		<div class="input-group input-group-md sm"><input autocomplete="off" id='tags' name="tags" type="text" class="dark-box form-control" placeholder="things related to article, blog, tags, keywords.. seperate with commas." aria-label="Enter tags for your article!" aria-describedby="button-submit" /></div>
		<label for='tagline'><p class="sm-text">ARTICLE TAGLINE</p></label>
		<div class="input-group input-group-md sm"><input autocomplete="off" id='tagline' name="tagline" type="text" class="dark-box form-control" placeholder="A very brief description of the article." aria-label="Enter tags for your article!" aria-describedby="button-submit" /></div>


		<div>
		<div class='text-center'>
		<p class='sm-text noselect mb-1 mt-1'>If you are not an admin, upon publishing, it will be put into an approval wait-list. Once approved, your news post will show on Game Central.</p>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Publish newsletter!</button>
		</div>
		</form>
		</div>
        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
    </body>
</html>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
<?php
$conn->close();
?>
