<!DOCTYPE html>
<html lang="en">
    <head>
		<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/cfg/cdns.php'); ?>
		<meta name="description" content="GameCentral, aiming to be the preeminent independent looking-for-group platform built for players all around the world.">
		<meta name="keywords" content="gaming, lfg, discord lfg, video game, looking for group, looking for squad">
		<meta name="robots" content="index, follow">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="language" content="English">
		<title><?php echo $websitename . " - " . $websitemotto; ?></title>
		<meta name="title" content="GameCentral - Never play solo again! Find other gamers, instantly.">
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
	<?php include_once('modules/navbar.php'); ?>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="text-center text-white">
                            <!-- Page heading-->
							<img alt='Game Central Logo' style='max-width: 100%;margin-bottom: 5%;' class='noselect' src='/images/text-logo.png'></img>
                            <h1 class="mb-5 bold noselect" style="text-shadow: 2px 2px 2px #151515 !important;margin-bottom: 2.5% !important;">Never play solo again!</h1>
							<p class="light noselect" style="font-size: 25px;text-shadow: 2px 2px 2px #151515 !important;margin-bottom: 3px !important;">...find other gamers, instantly! </p>
							<p class="light noselect" style="font-size: 17px;text-shadow: 2px 2px 2px #151515 !important;">the <a style='color:#59d059;'>best</a> place to look for a gaming group! </p>
                            <!-- Signup form-->
							<?php

							if(isset($_GET['r']) == 1){
								echo '<button type="button" class="btn btn-primary">Registered! <i class="bi bi-check-circle"></i></button>';
							}else{

                            echo '<form name="emailSignup" action="/func/registerEmail.php">
								<a class="sm-text">ENTER EMAIL TO BE NOTIFIED ON RELEASE</a>
                                <div class="input-group input-group-lg">
                                    <input title="Must include at least 4 characters before submission is possible!" id="email" name="email" minlength="4" type="text" class="dark-box form-control" placeholder="john.doe@gmail.com" aria-label="Enter your email..." aria-describedby="button-submit" onkeyup="stoppedTyping()"/>
                                    <button title="Must include at least 4 characters before submission is possible!" class="btn btn-primary" id="button-submit" type="submit" disabled>Notify me!</button>
                                </div>
                            </form>';
							}
							?>
                        </div>
                    </div>
                </div>
            </div>
        </header>
		<hr class='nav-break'>
        <!-- Icons Grid-->
        <section class="features-icons bg-dark1 text-center">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-person-plus-fill m-auto text-primary"></i></div>
                            <h3 style='z-index: 2;'>Find new friends!</h3>
                            <p style='z-index: 2;' class="lead mb-0">Don't have friends? This is the perfect website for you, find groups of players and make new friends with similar interests.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-5 mb-lg-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-server m-auto text-primary"></i></div>
                            <h3 style='z-index: 2;'>Find great servers!</h3>
                            <p style='z-index: 2;' class="lead mb-0">Get a free advertising platform for your game servers. Not interested? We also provide another outlet of discovering new game servers to play.</p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="features-icons-item mx-auto mb-0 mb-lg-3">
                            <div class="features-icons-icon d-flex"><i class="bi-chat-fill m-auto text-primary"></i></div>
                            <h3 style='z-index: 2;'>Socialize with others!</h3>
                            <p style='z-index: 2;' class="lead mb-0">Providing a breathtaking, easy-to-use, and fun social media platform. In the future we want to give users the ability to promote links, etc. with non-intrusive ads.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<hr class='nav-break'>
        <!-- Image Showcases-->
        <section class="showcase bg-dark2">
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-position: center;background-image: url('https://gamecentral.online/images/cod.webp');border-radius: 45px;transform: scale(0.8);"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2 style='position:relative;z-index: 2;'>Find people to play with, <u>no matter what the game</u>. </h2>
                        <p style='position:relative;z-index: 2;'class="lead mb-0">Squad up with trustworthy players in your region, based on a simple karma system used to make sure you get the best experience while playing with others.</p>
						<div style="position: absolute;margin-left:4%;margin-top:-10%;transform: scale(0.2);
" class="col-lg-4">
						<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#FA4D56" d="M20.9,-33.9C32.8,-24.9,52.2,-28.8,55.2,-24.5C58.1,-20.3,44.7,-7.9,34.6,-0.9C24.5,6.2,17.7,7.8,14.6,14C11.4,20.3,11.8,31,7,39.4C2.3,47.9,-7.7,54.1,-20.5,56.4C-33.2,58.7,-48.7,57.2,-55.3,48.5C-61.9,39.8,-59.7,24,-52.9,13C-46,2,-34.5,-4.2,-29.3,-12.4C-24.1,-20.6,-25.1,-30.7,-21.3,-43.4C-17.5,-56.1,-8.7,-71.3,-2.1,-68C4.5,-64.7,9,-42.9,20.9,-33.9Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg></div>

<div style="position: absolute;margin-left:6%;margin-top:-25%;transform: scale(0.2)rotate(35deg);" class="col-lg-4">
<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#B4EB34" d="M47,-61.4C47.4,-46.6,24.8,-23.3,17.2,-7.6C9.6,8.1,16.9,16.2,16.5,30C16.2,43.8,8.1,63.3,-5.8,69.1C-19.7,74.9,-39.4,67,-44.7,53.2C-50.1,39.4,-41.1,19.7,-36.8,4.3C-32.6,-11.1,-33,-22.3,-27.6,-37.1C-22.3,-51.9,-11.1,-70.4,6.1,-76.5C23.3,-82.5,46.6,-76.2,47,-61.4Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg></div>


						<div style="position: absolute;margin-left:-3%;margin-top:-11.5%;transform: scale(0.2)rotate(59deg);" class="col-lg-4">
<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#24A148" d="M47,-61.4C47.4,-46.6,24.8,-23.3,17.2,-7.6C9.6,8.1,16.9,16.2,16.5,30C16.2,43.8,8.1,63.3,-5.8,69.1C-19.7,74.9,-39.4,67,-44.7,53.2C-50.1,39.4,-41.1,19.7,-36.8,4.3C-32.6,-11.1,-33,-22.3,-27.6,-37.1C-22.3,-51.9,-11.1,-70.4,6.1,-76.5C23.3,-82.5,46.6,-76.2,47,-61.4Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg></div>


										<div style="position: absolute;margin-left:50%;margin-top:10%;transform: scale(0.2);" class="col-lg-4">
					<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#0F62FE" d="M37.2,-44.5C51,-41.2,66.9,-34,66.1,-24.4C65.3,-14.7,47.7,-2.4,37,6.3C26.3,15.1,22.5,20.4,17.5,32C12.5,43.6,6.2,61.5,-4.6,67.8C-15.5,74.2,-30.9,69,-40.3,58.8C-49.7,48.6,-52.9,33.5,-59.2,18.3C-65.5,3.1,-74.8,-12.1,-68.2,-19C-61.6,-25.9,-39.1,-24.4,-25.1,-27.7C-11.1,-31,-5.6,-39,3.1,-43.2C11.7,-47.5,23.4,-47.9,37.2,-44.5Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg></div>

										<div style="position: absolute;margin-left:55%;margin-top:13%;transform: scale(0.2);" class="col-lg-4">
<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#8A3FFC" d="M43.3,-15.6C49.9,6.3,44.8,30.4,27.1,45.2C9.4,59.9,-20.9,65.2,-41.2,51.7C-61.4,38.2,-71.5,5.8,-63,-18.7C-54.4,-43.3,-27.2,-60,-4.4,-58.6C18.3,-57.1,36.7,-37.5,43.3,-15.6Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg></div>


                    </div>
                </div>
								<div style="position: absolute;margin-top:13%;transform: scale(0.2);" class="col-lg-4">

				<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#F1C21B" d="M60.1,-37.1C72.2,-13.7,72.5,14.2,60.5,28.8C48.5,43.5,24.3,44.9,2.7,43.4C-18.8,41.8,-37.7,37.2,-41,27.5C-44.4,17.8,-32.3,3.1,-22.9,-18.8C-13.5,-40.7,-6.7,-69.7,8.6,-74.7C24,-79.7,48,-60.6,60.1,-37.1Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg>
</div>
								<div style="position: absolute;margin-top:16%;margin-left:7%;transform: scale(0.2);" class="col-lg-4">
<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#A7F0BA" d="M43.3,-15.6C49.9,6.3,44.8,30.4,27.1,45.2C9.4,59.9,-20.9,65.2,-41.2,51.7C-61.4,38.2,-71.5,5.8,-63,-18.7C-54.4,-43.3,-27.2,-60,-4.4,-58.6C18.3,-57.1,36.7,-37.5,43.3,-15.6Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg>
</div>


                <div class="row g-0">
				 <div style="position: absolute;transform: scale(0.06);"><svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
  <path fill="#FF0066" d="M51.2,-46C57.7,-32.7,48.3,-11.9,40.9,4.8C33.4,21.4,27.9,34,18.1,39.4C8.3,44.9,-5.9,43.2,-19.2,37.6C-32.5,32.1,-44.9,22.6,-51,8.1C-57.1,-6.3,-56.9,-25.7,-47.3,-39.7C-37.7,-53.7,-18.9,-62.3,1.7,-63.7C22.3,-65.1,44.7,-59.3,51.2,-46Z" transform="translate(100 100)" style="z-index: -1;"/>
</svg></div>
                    <div class="col-lg-6 text-white showcase-img" style="background-position: center;background-image: url('https://gamecentral.online/images/minecraft.webp');border-radius: 45px;transform: scale(0.8);"></div>
                    <div class="col-lg-6 my-auto showcase-text">

                        <h2 style='position:relative;z-index: 2;'>Discover... or <u>promote</u>!</h2>
                        <p style='position:relative;z-index: 2;' class="lead mb-0">Find fantastic ranked game servers of any kind, along with providing users a way to promote their own servers. </p>
                    </div>
                </div>

                <div class="row g-0">
                    <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-position: center;background-image: url('https://gamecentral.online/images/pexels2.jpg');border-radius: 45px;transform: scale(0.8);"></div>
                    <div class="col-lg-6 order-lg-1 my-auto showcase-text">
                        <h2 style='position:relative;z-index: 2;'>Socialize <u>with others</u>!</h2>
                        <p style='position:relative;z-index: 2;' class="lead mb-0">Even if your not in the mood for gaming, Game Central is the perfect platform for you. Find new friends and have fun! Connect your other social media profiles and meet on there!</p>
                    </div>
                </div>
            </div>
        </section>
				<hr class='nav-break'>
        <!-- Call to Action-->
        <section class="call-to-action text-white text-center bg-dark2" style='padding-bottom: 3rem;padding-top: 3rem; !important' id="signup">
            <div class="container position-relative">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <h2 class="mb-4">Interested? Join our Discord to stay up-to-date!</u></h2>
                        <!-- Signup form-->
                        <a href='https://discord.gg/f8aQNJMeVB' class="btn btn-primary" id="button-submit" style='background-color:#7289DA;border-color:#4E5D94;'><i class="bi bi-discord"></i> Join the Discord!</a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-darkest">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item"><a href="mailto:jade@gamecentral.online">Send us an email!</a></li>
                        </ul>

                        <p class="text-muted small mb-4 mb-lg-0">&copy; Game Central 2021. All Rights Reserved.</p>
                    </div>
                    <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item me-4">
                                <a href="https://www.facebook.com/gamecentralUS"><i class="bi-facebook fs-3"></i></a>
                            </li>
                            <li class="list-inline-item me-4">
                                <a href="https://twitter.com/GameCentralUS"><i class="bi-twitter fs-3"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/gamecentralus/"><i class="bi-instagram fs-3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->

        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
		<script>
		function stoppedTyping(){
			if($("#email").val().length > 4) {
				$("#button-submit").prop("disabled", false);
			} else {
				$("#button-submit").prop("disabled", true);
			}
    }
		</script>
    </body>
</html>
<?php
$conn->close();
?>
