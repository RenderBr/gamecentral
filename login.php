<?php
$failed = $_GET['f'];
$redirect = $_GET['r'];
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral login page, you may sign in to use our website here.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc login">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - login to your account!"; ?></title>
		<meta name="title" content="GameCentral - login to your account!">
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

		<div class='bg-dark1 container' style="padding-bottom: 25px;max-width: 27rem;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);margin-top: 2.5%;"><div class='text-center'>
		<h4 style='padding-top: 18.5px;'>Welcome back! Happy to see you.</h4></div>
		<form action='/func/loginToUser.php' method='POST'>
		<label for='email'><p class="sm-text">EMAIL</p></label>
		<div class="input-group input-group-md sm"><input id='email' name="email" type="text" class="dark-box form-control" placeholder="john.doe@gmail.com..." aria-label="Enter your email..." aria-describedby="button-submit" /></div>
		<label for='password'><p class="sm-text">PASSWORD</p></label>
		<div class="input-group input-group-md sm"><input id='password' name="password" type="password" class="dark-box form-control" placeholder="ILuvJaneDoe06022002..." aria-label="Enter your password..." aria-describedby="button-submit" /></div>
		
		<div class='text-center'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Continue</button>
		</div>
		<input name='r' style='display:none;' value='<?php echo $redirect; ?>'>
		</form>
		<p class='sm-text'>We aren't currently accepting registrations, <a href='https://discord.gg/GVn8teTR6V' style='color:#7289DA;text-decoration:underline;'>follow our progress on our Discord.</a></p>
		</div>
		
				
		<?php 
		
		if($failed == 1){
			echo '<div style="max-width: 27rem;margin-top:0.5rem;" class="noselect container alert alert-danger" role="alert">
						<i style="margin-right:0.2rem;" class="bi bi-exclamation-circle"></i> The password/email combination you entered is incorrrect!
				</div>';
		}
		
		
		?>
		
    </body>
</html>
<script>
$(".alert").click(function() {
  $(this)
    .fadeOut();
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