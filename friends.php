<?php
session_start();
if(isset($_SESSION['username'])){
	$self = $_SESSION['username'];
}else{
	header("Location: /");
}
include_once('cfg/conn.php');
$getFriendCount = $conn->query("SELECT * FROM friends WHERE friendCombo LIKE '%{$self}%'");

$friendCount = $getFriendCount->num_rows;


?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral friends page, manage your friends here!">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc friends, friend manager">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - my friends!"; ?></title>
		<meta name="title" content="GameCentral - my friends!">
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
		<div class='bg-dark1 container mb-4 pb-3 rounded' style="max-width: 100rem;height: max-content;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);width:80%;"><div class='text-center'>
		<h4 class='noselect pt-2 pb-1'><i class="bi bi-people-fill me-1"></i>All your friends, <u>in one place...</u></h4><hr class='nav-break'></div>

		<label><p class="sm-text noselect">MY FRIENDS (<a id='friendCount'><?php echo $friendCount; ?></a>)</p></label>


<div class='container-fluid bg-dark2 px-4' style='max-width:98%;height:max-content;padding: 15px 0 15px 0px;border-radius: 10px;'>
	<div class='row gx-2'>

	<?php
	$sql = "SELECT * FROM friends WHERE friendCombo LIKE '%{$self}%' ORDER BY accepted ASC";
	$result = $conn->query($sql);

if ($result->num_rows > 0) {

	while($row = $result->fetch_assoc()) {

			$friendcombo = $row['friendCombo'];
			$friendUser = str_replace($self,"",$friendcombo);
			$friendUser = str_replace(" - ","",$friendUser);
			$accepted = $row['accepted'];

			$sql = "SELECT * FROM users WHERE username = '$friendUser'";
			$result1 = $conn->query($sql);

			if ($result1->num_rows > 0) {

				while($row1 = $result1->fetch_assoc()) {
					$avatar = $row1['avatar'];
								echo "<div class='d-flex bg-darkest rounded mt-2 align-items-center'>
								<div class='me-auto p-2'>
									<a class='sm-text noselect me-2'></a>
									<img class='sm-icon rounded-circle ms-1 me-1' width=32 height=32 src='" . $avatar . "'><a style='color:white;' href='/user?u=" . $friendUser . "'>" . $friendUser . "</a>
								</div>
								<div class='p-2'>";
								echo "<a href='/message?u=" . $friendUser . "' title='Chat with user!' class='btn btn-secondary btn me-2'><i class='bi bi-chat-left'></i></a>";
								$friendCount++;
								if($accepted == 1){
								echo "<button id='acceptF' value='" . $friendUser . "' onclick='removeFriend(this)' title='Remove " . $friendUser . " from your friends list!' class='btn btn-danger btn'>Remove friend!</button><br>
								";
								}else{
									echo "<button id='acceptF' value='" . $friendUser . "' onclick='removeFriend(this)' title='Remove your friend request to " . $friendUser . "!' class='btn btn-secondary btn'>Remove your friend request!</button><br>";
								}

								echo "</div></div><script>$('friendCount').html('" . $friendCount . "')</script>";
				}
			}




		}
} else {
	echo "

	<div class='d-flex align-items-center justify-content-center' style='height: inherit;'>
        <a class='sm-text' style='text-decoration:none;'><i style='margin-right:7px;' class='bi bi-exclamation-circle'></i>You do not have any friends! Go and add some!</a>
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

function removeFriend(button){
	if(confirm("Are you sure you want to remove " + $(button).val() + " as a friend?")){
	        $.ajax({
                type: 'POST',
                url: '/func/friendManager.php',
				data: {
					friend: $(button).val(),
					self: "<?php echo $self; ?>",
					action: "remove"
				},
                success: function(data) {
					$(button).html("Successfully removed!");
					$(button).removeClass("btn-danger");
					$(buton).addClass("btn-success");
                }
            });
					}
}
</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
