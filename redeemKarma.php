<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once('cfg/cdns.php');
    session_start();
    if(isset($_SESSION['username'])){
      $self = $_SESSION['username'];
    }else{
      $self = NULL;
    }

    if(!isset($self) || $self == NULL){
      header("Location: /login");
    }

    $redeemedRewards = $conn->query("SELECT * from dailykarmarewards WHERE user = '$self' AND date_created > now() - interval 1 day;");
    if($redeemedRewards->num_rows > 0){
      $canRedeemReward = false;
    }else{
      $canRedeemReward = true;
    }

     ?>
		<meta name="description" content="GameCentral forget password page, you may reset your password if forgotten here.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad, gc forgot password, forget, dont know password, help, login help">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - check your email!"; ?></title>
		<meta name="title" content="GameCentral - check your email!">
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

		<div class='bg-dark1 container pb-3 mb-4 rounded' style="max-width: 33rem;box-shadow: bax;-webkit-box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);box-shadow: -3px 5px 18px 2px rgba(0,0,0,0.72);"><div class='text-center'>
		<?php


    if($canRedeemReward == false){
      echo "<h4 style='padding-top: 18.5px;' class='noselect'>You've already claimed your daily karma reward!</h4>";
    }else{
      echo "<h4 style='padding-top: 18.5px;' class='noselect'>You've successfully redeemed <a style='color:#bf51b8 !important;'><u>20 karma</u></a>!</h4>";

      $sql = "UPDATE users SET karma=karma+20 WHERE username='$self'";

      if ($conn->query($sql) === TRUE) {
              $conn->query("INSERT INTO dailykarmarewards (user) VALUES
              ('$self')");      } else {
        echo "Error updating record: " . $conn->error;
      }


    }


    ?> </div>
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
