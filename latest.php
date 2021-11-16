<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');

if(isset($_GET['g'])){
	$gameLFG = $_GET['g'];
}else{
	$gameLFG = NULL;
}
if(isset($_GET['u'])){
	$userLFG = $_GET['u'];
}else{
	$userLFG = NULL;
}

if(isset($_GET['p'])){
	$pageOffset = $_GET['p'];
}else{
	$pageOffset = 0;
}

if($pageOffset < 0){
	header("Location: /lfg");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta name="description" content="GameCentral news page, here you can find blogs, news and updates about everything gaming.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc, news, blogs, updates, latest, in, gaming">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - best place on the internet for gaming news!"; ?></title>
		<meta name="title" content="GameCentral - best place on the internet for gaming news!">
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
		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='pt-2 pb-1 noselect'><a class='me-1 noselect'>🎮</a>The latest in gaming news</h4>
		<nav aria-label="Page navigation">
		  <ul class="pagination">
		    <li class="page-item"><a id='previous' class="page-link dark-box" href="/lfg?p=<?php echo $pageOffset-10; ?>">Previous</a></li>
		    <li class="page-item"><a id='next' class="page-link dark-box" href="/lfg?p=<?php echo $pageOffset+10; ?>">Next</a></li>
				<li class="page-item"><a id='next' class="page-link dark-box bg-success" href="/publishNews">Post your own news!</a></li>
		  </ul>
		</nav>
		<hr class='nav-break'></div>

		<label><p class="sm-text noselect mt-1">LATEST NEWS</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/modules/viewGroupButton.php');
$sql = "SELECT * FROM blogs WHERE approved = 1 ORDER BY date_created DESC LIMIT 20 OFFSET " . $pageOffset . "";

$result = $conn->query($sql);
$numRows = $result->num_rows;

if ($result->num_rows > 0) {

	?>

	<div class='px-2'><div class='row g-1'>

	<?php
  while($row = $result->fetch_assoc()) {
		$newsId = $row['id'];
		$author = $row['author'];
		$date = $row['date_created'];
		$timeAgo = time_elapsed_string($date);
		$tagLine = $row['tagline'];
		$image = $row['img'];
		$title = $row['title'];

		echo '<div class="col-sm-3 ">
				<div class="p-3 bg-darkest rounded"><a style="color:white;" href="/news?n=' . $newsId . '"><img class="img-fluid img-thumbnail" style="padding:inherit !important;border: none !important;" src="' . $image . '"><h3 style="font-size: large !important;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;">' . $title . ' </a><p class="sm-text" style="margin-bottom:0.5rem !important;">by <a style="text-decoration:none;color:white;" href="/user?u=' . $author . '">' . $author . '</a></p></h3><p style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;margin-bottom:0rem !important;" class="gray noselect">' . $tagLine . '</p><a title="' . $date . '" class="sm-text noselect" style="color:#525457 !important;">posted ' . $timeAgo . '</a></div>
			</div>';
  }
} else {
	$noResults = true;
	echo "<script>hide('#next');</script>

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No posts to be displayed!</a>
    </div>

	";

}

$conn->close();


?>
</div>
</div>

<style>
.vertical-center {
  min-height: 100%;  /* Fallback for browsers do NOT support vh unit */

  display: flex;
  align-items: center;
}

a{
	text-decoration:none !important;
}
.btn:focus {
	box-shadow:none !important;
}
</style>


<script>

function joinGroup (button) {
      $.ajax({
        url: "/func/joinGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Leave!");
			$(button).attr("onclick", "leaveGroup(this)");
			$(button).removeClass("btn-success");
			$(button).addClass("btn-danger");
			$(button).addClass("btn-sm");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$(button).before('<a id="gpage' + groupid + '" class="btn btn-secondary me-2 btn-sm" href="/group?g=' + groupid + '">Open Group Page</a>');

			n.textContent = currentPlayers + 1 + "";
			t.textContent = currentPlayers + 1 + "";

			}
     });
 }

 function leaveGroup (button) {
      $.ajax({
        url: "/func/leaveGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Join group!");
			$(button).attr("onclick", "joinGroup(this)");
			$(button).removeClass("btn-danger");
			$(button).addClass("btn-success");
			$(button).addClass("btn-sm");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$("#gpage" + groupid).remove();

			n.textContent = currentPlayers - 1 + "";
			t.textContent = currentPlayers - 1 + "";

       }
     });
 }

  function deleteGroup (button) {
      $.ajax({
        url: "/func/deleteGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $_SESSION['username']; ?>",
			gid:$(button).val()
		},
		success:function(data){
			var groupid = $(button).val();
			$('#' + groupid + 'l').empty();
			$('#' + groupid + 'l').remove();


       }
     });
 }

</script>

		</div>
    </body>
</html>

<script src='https://unpkg.com/@wanoo21/countdown-time@1.2.0/dist/countdown-time.js'></script>


<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
