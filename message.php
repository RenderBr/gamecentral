<!DOCTYPE html>
<html lang="en">
    <head>
	<?php
		session_start();
		include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php');
		$messagedUser = $_GET['u'];
		$uName = $_SESSION['username'];
		if($uName){

		}else{
			header("Location: /login");
		}

		$sql = "SELECT * FROM users WHERE username = '$messagedUser' OR id = '$messagedUser'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
          $dmId = $row['id'];
          $id = $dmId;
          $dmUser = $row['username'];
          $dmAvatar = $row['avatar'];
          $joinedWebsite = $row['dateCreated'];
          $joinedWebsite = time_elapsed_string($joinedWebsite);
          $dmBio = $row['bio'];
          $dmDiscord = $row['discord'];
		  }
		}else{
      header("Location: /friends");
    }
		?>
		<meta name="description" content="Direct message <?php echo $dmUser . " @ Game Central"; ?>">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc group, dm, message, direct message, pm">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - direct message " . $dmUser; ?></title>
		<meta name="title" content="Game Central - direct message <?php echo $dmUser; ?>">
        <!-- Favicon-->
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body class='bg-dark3'>
	<?php include_once('modules/navbar.php'); ?>

		<br><div class='bg-dark1 container news rounded mb-4 pb-3'>
		<div class='text-center'>
			<h2 class='mb-0' style='margin-bottom:1rem;'><a href='/user?u=<?php echo $dmUser; ?>'><?php echo $dmUser; ?><img class='icon-md ms-1 rounded-circle' title='<?php echo $dmUser; ?>' src='<?php echo $dmAvatar; ?>'></a></h2>

				<p class="sm-text noselect">User ID: <a class='sm-text noselect' style='color:white;text-decoration:none;' href='/user?u=<?php echo $dmUser; ?>'><?php echo $dmId; ?></a></p>
				<p class="sm-text noselect">Joined website <?php echo $joinedWebsite; ?></p>

			<hr class='nav-break mt-2'>

		</div>

					<?php
				if($dmBio){
					echo "<a class='sm-text mt-2'>USER BIO</a><br>";
					echo "<a class='light nd'>" . $dmBio . "</a><br>";
				}
				if($dmDiscord){
					echo "<a class='discord sm-text'>DISCORD: <a class='sm-text'>" . $dmDiscord . "</a>";
				}else{

				}
      $isDM = true;
			include_once('modules/chat.php');
			?><br>

		</div>


    </body>
</html>

<script>

	function getColor(value){
		//value from 0 to 1
		var hue=(value*100).toString(10);
		return ["hsl(",hue,",100%,50%)"].join("");
	}

	var kv = parseInt($('#karma').text())
	var value = kv / 1000;
	$('#karma').attr("style", "color: " + getColor(value) + " !important");
	$('#karma2').attr("style", "color: " + getColor(value) + " !important");

	function copyToClipboard(text) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val(text).select();
		document.execCommand("copy");
		$temp.remove();
}

function createInvite (button) {
      $.ajax({
        url: "/func/getInvite.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $uName; ?>",
			gid:$(button).val(),
			inv:"<?php echo $invCodeGenerated; ?>"
		},
		success:function(data){
			$(button).html("https://gcnt.xyz/inv?i=<?php echo $invCodeGenerated; ?>");
			$(button).prop("onclick", null).off("click");
			$(button).addClass("copyInvite");
			$('.copyInvite').click(function () { copyToClipboard($(button).html()); });
		}
     });
 }

 function joinGroup (button) {
      $.ajax({
        url: "/func/joinGroup.php", //the page containing php script
        type: "POST", //request type
        data: {
			u: "<?php echo $uName; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Leave!");
			$(button).attr("onclick", "leaveGroup(this)");
			$(button).removeClass("btn-success");
			$(button).addClass("btn-danger");
			var groupid = $(button).val();
			var n = document.getElementById('' + groupid + 'n');
			var t = document.getElementById('' + groupid + 't');
			var currentPlayers = parseInt(n.textContent);
			$(button).before('<a id="gpage' + groupid + '" class="btn btn-secondary me-2" href="/group?g=' + groupid + '">Open Group Page</a>');

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
			u: "<?php echo $uName; ?>",
			gid:$(button).val()
		},
		success:function(data){
			$(button).html("Join group!");
			$(button).attr("onclick", "joinGroup(this)");
			$(button).removeClass("btn-danger");
			$(button).addClass("btn-success");
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

</script>

<style>
.btn-primary:focus{
	outline:none !important;
	box-shadow: none !important;
}

.box {
   display: flex;
   align-items:center;
}
</style>
<?php
	$conn->close();
?>
