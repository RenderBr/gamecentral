<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral forget password page, you may reset your password if forgotten here.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc forgot password, forget, dont know password, help, login help">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - reset your password!"; ?></title>
		<meta name="title" content="GameCentral - reset your password!">
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

		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 27rem;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);"><div class='text-center'>
		<h4 style='padding-top: 18.5px;'>Forgot your password? <u>It's okay</u>...</h4></div>
		<form action='/func/sendForgetPasswordEmail.php' method='POST'>
		<label for='email'><p class="sm-text">YOUR EMAIL</p></label>
		<div class="input-group input-group-md sm"><input id='email' name="email" type="text" class="dark-box form-control" placeholder="Type your email..." aria-label="Enter your email..." aria-describedby="button-submit" /></div>
		<div class='text-center'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Continue</button>
		</div>
		</form>
		</div>

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
