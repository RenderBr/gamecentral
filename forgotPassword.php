<?php
if(isset($_GET['token'])){
  $token = $_GET['token'];
}else{
  header("Location: /login");
}

include_once($_SERVER['DOCUMENT_ROOT'] . "/cfg/conn.php");
$sql = "SELECT * FROM forgetPasswordTokens WHERE token = '$token'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
      $user = $row['forUser'];

  }
}else{
  header("Location: /login");
}

?>

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
		<h4 style='padding-top: 18.5px;'>Forgot your password? <u>No problem</u>.</h4></div>
		<form action='/func/forgetPassword.php' method='POST'>
		<label for='email'><p class="sm-text">NEW PASSWORD</p></label>
		<div class="input-group input-group-md sm"><input id='password' name="pswd" type="password" class="dark-box form-control" placeholder="Type your new password..." aria-label="Enter your email..." aria-describedby="button-submit" /></div>
		<label for='password'><p class="sm-text">REPEAT NEW PASSWORD</p></label>
		<div class="input-group input-group-md sm"><input id='password2' type="password" class="dark-box form-control" placeholder="Repeat password..." aria-label="Enter your password..." aria-describedby="button-submit" /></div>
    <input id='user' name='user' style='display:none !important;' value='<?php echo $user; ?>'>
    <input id='token' name='token' style='display:none !important;' value='<?php echo $token; ?>'>
		<div class='text-center'>
		<button class="btn btn-primary" style='width:100%;' id="button-submit" type="submit">Continue</button>
		</div>
		<input name='r' style='display:none;' value='<?php echo $redirect; ?>'>
		</form>
		</div>


		<?php

		if($failed == 1){
			echo '<div style="max-width: 27rem;margin-top:0.5rem;" class="noselect container alert alert-danger" role="alert">
						<i style="margin-right:0.2rem;" class="bi bi-exclamation-circle"></i> The passwords you entered were not the same!
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

function Validate() {
   var password = $("#password");
   var confirmPassword = $("#password2");
   if (password != confirmPassword) {
       alert("Passwords do not match.");
       return false;
   }
   return true;
}
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
