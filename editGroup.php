<?php
session_start();
if(isset($_GET['id'])){
	$group = $_GET['id'];
}else{
	header("Location: /manager");
}
if($_SESSION['username']){
	$self = $_SESSION['username'];
}else{
	header("Location: /");
}

include_once('cfg/conn.php');
$sql = "SELECT * FROM lfgPosts WHERE user = '$self' AND expired = 0 AND id = '$group'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

while($row = $result->fetch_assoc()) {

	$groupid = $row['id'];
	$game = $row['game'];
	$user = $row['user'];
	$groupSize = $row['group_size'];
	$currentGroup = $row['currentUsers'];
	$groupName = $row['groupName'];
	$expiryDate = $row['expiryDate'];
	$invincible = $row['invincible'];
	$description = $row['groupDescription'];
	$discordInvite = $row['discordInv'];

	}
}else{
	header("Location: /manager");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');	?>
		<meta name="description" content="GameCentral edit group page, you may edit various LFG groups here.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc edit, group edit">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - editing a group!"; ?></title>
		<meta name="title" content="GameCentral - editing a group!">
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
		<h4 class='pt-2 pb-1 noselect'><i class="bi bi-pencil-square noselect me-1"></i>Edit <u>your group</u>!</h4><hr class='nav-break'></div>
		<form action='/func/updateLFG.php' method='POST'>
		<label for='groupname'><p class="sm-text">GROUP NAME</p></label>
		<div class="input-group input-group-md sm"><input id='groupname' value='<?php echo $groupName; ?>' name="groupname" type="text" class="dark-box form-control" placeholder="My Epic CS:GO Squad" aria-label="Enter a name for your group..." aria-describedby="button-submit" /></div>
		<label for='game'><p class="sm-text">GAME</p></label>
		<div class="input-group input-group-md sm"><input autocomplete="off" value='<?php echo $game; ?>' id='game' name="game" type="text" class="dark-box form-control" placeholder="Start typing to select a game..." aria-label="Enter your username..." aria-describedby="button-submit" /><div id='gameList'></div></div>
		<label for='description'><p class="sm-text">GROUP INFO</p></label>
		<div class="input-group input-group-md sm"><textarea  id='description' name="description" type="textarea" class="dark-box form-control" placeholder="Tell the world about your group... how can people join you in your game?" aria-label="Tell the world about your group..." aria-describedby="button-submit" /><?php echo $description; ?></textarea></div>
		<label for='discordInvite'><p class="sm-text discord">DISCORD INVITE</p></label>
		<div class="input-group input-group-md sm"><input id='discordInvite' value='<?php echo $discordInvite; ?>' name="discordInvite" type="text" class="dark-box form-control" placeholder="https://discord.gg/3tTmTWZHrS..." aria-label="Enter your full Discord invite link" aria-describedby="button-submit" /></div>
		<input value='<?php echo $groupid; ?>' name="groupId" style='display:none !important;' class="dark-box form-control" placeholder="https://discord.gg/3tTmTWZHrS..." aria-label="Enter your full Discord invite link" aria-describedby="button-submit" />
		<div class='row'>
		<div class='col'>
				<label for='visibility'><p class="sm-text">VISIBILITY</p></label>
				<select class="form-select dark-box" id='visibility' name='visibility' aria-label="Visibility selector">
					<option value="0" selected>Public</option>
					<option value="1">Private</option>
				</select>
		</div>
		<div class='col'>
				<label for='groupSize'><p class="sm-text">GROUP SIZE</p></label>
				<select class="form-select dark-box" id='groupSize' name='groupSize' aria-label="Group size selector">

				<option value="<?php echo $groupSize; ?>"><?php echo $groupSize; ?></option>
				<option id='deleteThis'>Select a game!</option>

				</select>
		</div>
		</div>
		<div>
		<br>
		<div class='text-center'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Update group!</button>
		</div>
		</form>
		<p class='sm-text' style='font-size: 12px;'><strong>Remember!</strong> If nobody joins your group within two hours, it will be deleted automatically.</p>
		</div>
        <!-- Bootstrap core JS-->
        <!-- Core theme JS-->
    </body>
</html>

<script>
 $(document).ready(function(){
      $("#game").on("keyup", function(){
        var game = $(this).val();
        if (game !=="") {
          $.ajax({
            url:"/func/gameSearch.php",
            type:"POST",
            cache:false,
            data:{
							game:game,
							isCreate: "true"
						},
            success:function(data){
              $("#gameList").html(data);
              $("#gameList").fadeIn();
            }
          });
        }else{
          $("#gameList").html("");
          $("#gameList").fadeOut();
        }
      });

      $(document).on("click","li", function(){
        $('#game').val($(this).text());
        $('#gameList').fadeOut("fast");
		var game = $('#game').val();
		if (game !=="") {
		$.ajax({
            url:"/func/getMaxGroupSize.php",
            type:"POST",
            cache:false,
            data:{game:game},
            success:function(data){
              $("#groupSize").append(data);
			  $("#deleteThis").remove();
			}
			});
			}else{

			}
          });
      });
</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}
</style>
<?php
$conn->close();
?>
