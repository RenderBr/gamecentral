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
		<meta name="description" content="GameCentral server creation page, you may create server listings here, help promote your server!">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc create, server create">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - create a server listing!"; ?></title>
		<meta name="title" content="GameCentral - create a server listing!">
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
		<h4 class='pt-2 pb-1 noselect'><i class="bi bi-pencil-square noselect me-1"></i>Create <u>your server</u>!</h4><hr class='nav-break'></div>
		<form action='/func/createServer.php' method='POST'>
		<label for='servername'><p class="sm-text">SERVER NAME</p></label>
		<div class="input-group input-group-md sm"><input id='servername' name="servername" type="text" class="dark-box form-control" placeholder="Insane Minecraft Server..." aria-label="Enter a name for your server..." aria-describedby="button-submit" /></div>
		<label for='game'><p class="sm-text">GAME</p></label>
		<div class="input-group input-group-md sm"><input autocomplete="off" id='game' name="game" type="text" class="dark-box form-control" placeholder="Start typing to select a game for your server..." aria-label="Select a game for your server..." aria-describedby="button-submit" /><div id='gameList'></div></div>
		<label for='serverbanner'><p class="sm-text">BANNER DIRECT IMAGE</p></label>
		<div class="input-group input-group-md sm"><input id='serverbanner' name="serverbanner" type="text" class="dark-box form-control" placeholder="https://link-to-image.png" aria-describedby="button-submit" /></div>
		<label for='description'><p class="sm-text">SERVER INFO</p></label>
		<div class="input-group input-group-md sm"><textarea id='description' name="description" type="textarea" class="dark-box form-control" placeholder="Tell the world about your server... why should people play, and what makes it unique?" aria-label="Tell the world about your server..." aria-describedby="button-submit" /></textarea></div>
		<div class='row'>
		<div class='col-lg-8'>
				<label for='ip'><p class="sm-text">IP ADDRESS</p></label>
				<div class="input-group input-group-md sm"><input autocomplete="off" id='ip' name="ip" type="text" class="dark-box form-control" placeholder="127.0.0.1" aria-label="Enter your server address!" aria-describedby="button-submit" /><div id='gameList'></div></div>

		</div>
		<div class='col'>
				<label for='port'><p class="sm-text">PORT</p></label>
				<div class="input-group input-group-md sm"><input autocomplete="off" id='port' name="port" type="text" class="dark-box form-control" placeholder="80" aria-label="Enter your server's port!" aria-describedby="button-submit" /><div id='gameList'></div></div>

		</div>
		</div>
				<label for='owner'><p class="sm-text">ARE YOU THE OWNER OF THIS SERVER?</p></label>
				<select class="form-select dark-box" id='owner' name='owner' aria-label="Visibility selector">
					<option value="0" selected>NO</option>
					<option value="1">YES</option>
				</select>
				<p class='sm-text noselect' style='font-size: 12px;'><a class='text-danger'>-1000 karma penalty</a> will be applied to your account if false info is given here!</p>
		<div>
		<br>
		<div class='text-center'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Create your server!</button>
		</div>
		</form>
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
							isCreateServer: "true"
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
