<?php
session_start();
$self = $_SESSION['username'];
if($_SESSION['username']){

}else{
	header("Location: /");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral notifications, manage friend requests, group invites, and more.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc notifications, notif manager">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - notifications!"; ?></title>
		<meta name="title" content="GameCentral - notifications!">
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
		<div class='bg-dark1 container mb-4 pb-3 rounded' style="padding-bottom: 25px;max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='noselect pt-2 pb-1'><i class="bi bi-bell me-1"></i>Your notifications? Right here.</h4><hr class='nav-break'></div>

		<label><p class="sm-text noselect">NOTIFICATIONS</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
<?php

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

include_once('cfg/cdns.php');
	?>

	<div class='row gx-2'>

	<?php
	$sql = "SELECT * FROM notifications WHERE seen = 0 AND user = '$self' ORDER BY date_created DESC LIMIT 25";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {

		$id = $row['id'];
		$type = $row['type'];
		$seen = $row['seen'];
		$associatedId = $row['associatedId'];
		$date_created = $row['date_created'];

		if($type == "friendRequest"){

		$sql1 = "SELECT * FROM friends WHERE id = $associatedId";
		$result1 = $conn->query($sql1);

		if ($result1->num_rows > 0) {

		  while($row1 = $result1->fetch_assoc()) {

			$friendcombo = $row1['friendCombo'];
			$friendUser = str_replace($self,"",$friendcombo);
			$friendUser = str_replace(" - ","",$friendUser);

			echo "<div id='" . $id . "l' class='d-flex bg-darkest rounded mt-2 align-items-center'>
			<div class='me-auto p-2'>
				<a class='sm-text noselect me-2'>#" . $id . "</a>
				<a style='color:white;' href='/user?u=" . $friendUser . "'>" . $friendUser . " <a class='gray'>&nbsp;has requested to become friends with you.</a> </a>
			</div>
			<div class='p-2'>

			<button id='acceptF' value='" . $friendUser . "' onclick='acceptFriend(this)' title='Friend request pending!' class='btn btn-secondary'>Accept request!</button><br>
			";


			}
		}
		echo "</div></div>";






	}
  }
} else {
	echo "

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>No notifications to be displayed!</a>
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




		</div>
    </body>
</html>

<script>

function acceptFriend(button){
	        $.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: $(button).val(),
					self: "<?php echo $self; ?>",
					action: "accept"
				},
                success: function(data) {
					$(button).html("Accepted!");
					$(button).removeClass("btn-secondary");
					$(button).addClass("btn-success");
                }
            });
}
</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
