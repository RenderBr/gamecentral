<?php
	if(!isset($_SESSION['username'])){
	  echo "<nav class='navbar navbar-expand-md navbar-dark bg-dark sticky-top'>
				<div class='container-xxl'>
					<a class='navbar-brand noselect' href='/'>
						<img alt='Game Central Navbar logo' width=128 src='/images/logo-02-slim.webp'></img>
					</a>

					<button class='navbar-toggler collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
						<span class='navbar-toggler-icon'></span>
					</button>

					<div class='collapse navbar-collapse' id='navbarSupportedContent'>

					<ul class='navbar-nav me-auto mb-2 mb-lg-0'>
					<li class='nav-item'>
						<a class='nav-link active' aria-current='page' href='/'>Home</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' aria-current='page' href='/servers'>Game Servers</a>
					</li>
					<li class='nav-item'>
						<a class='nav-link' aria-current='page' href='/games'>Games</a>
					</li>
					</ul>


					  <span class='d-flex'>
					  	<a role='button' href='https://discord.gg/f8aQNJMeVB' class='btn btn-success discord blurple me-2 no-bs btn-sm' style='color:white !important;background-color:#7289DA !important;border-color:#4E5D94 !important;'><i class='bi bi-discord me-1'></i>Join the Discord!</a>
							<a role='button' style='color:white !important;' href='/register' class='btn btn-primary no-bs me-2 btn-sm'>Register</a>
						<a role='button' style='color:white !important;' href='/login' class='btn btn-secondary no-bs btn-sm'>Login</a>
					  </span>
					</div>


				</div>
			</nav>
			<hr class='nav-break'>";

	}else{

		$sql = "SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
		  // output data of each row
		  while($row = $result->fetch_assoc()) {
				$avatar = $row['avatar'];
		  }
		}

		$sql = "SELECT * FROM dailykarmarewards WHERE user = '" . $_SESSION['username'] . "' AND date_created > now() - interval 1 day;";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$karmaRewardAvailable = NULL;
			}
		}else{
			$karmaRewardAvailable = "<li class='nav-item'>
										<a class='nav-link' aria-current='page' href='/redeemKarma' style='color:#bf51b8 !important;'>Claim Daily Reward!</a>
									</li>";
		}

		if($_SESSION['notifs'] > 0){
			$notifications = " <span class='badge rounded-pill bg-danger ms-1'>" . $_SESSION['notifs'] . "</span>";
		}else{
			$notifications = NULL;
		}

		if(isAdmin($conn, $_SESSION['username']) == true){
			$isAdmin = true;
		}else{
			$isAdmin = false;
		}

		echo "<nav class='navbar navbar-expand-md navbar-dark bg-dark sticky-top'>
				<div class='container-xxl'>
					<a class='navbar-brand noselect' href='/'>
						<img alt='Game Central Navbar logo' width=128 src='/images/logo-02-slim.webp'></img>
					</a>

					<button class='navbar-toggler collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
						<span class='navbar-toggler-icon'></span>
					</button>

					<div class='collapse navbar-collapse' id='navbarSupportedContent'>

					<ul class='navbar-nav me-auto mb-2 mb-lg-0'>
						<li class='nav-item'>
							<a class='nav-link active' aria-current='page' href='/'>Home</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/createLFG'>Create a group!</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/findAFriend'>Users</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/communities'>Communities</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/servers'>Game Servers</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/lfg'>LFG</a>
						</li>" . $karmaRewardAvailable . "
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/games'>Games</a>
						</li>
					</ul>

					<span class='d-flex'>

						<div class='dropdown'>
							<a style='text-decoration:none;' class='noselect sm-text dropdown-toggle' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
								<img alt='Profile Avatar' class='rounded-circle me-2' width=32 height=32 src='" . $avatar . "'>" . $_SESSION['username'] . $notifications . "
							</a>

							  <ul class='dropdown-menu dark-box' aria-labelledby='dropdownMenuButton1'>
								<li><a class='dropdown-item gray' href='/user?u=" . $_SESSION['username'] . "'><i class='bi bi-person me-1'></i></i>My Profile</a></li>
								<li><a class='dropdown-item gray' href='/friends'><i class='bi bi-people me-1'></i></i>My Friends</a></li>
								<li><a class='dropdown-item gray' href='/createLFG'><i class='bi bi-plus-circle me-1'></i>Create a group</a></li>
								<li><a class='dropdown-item gray' href='/createCommunity'><i class='bi bi-plus-circle-dotted me-1'></i>Create a community</a></li>
								<li><a class='dropdown-item gray' href='/notifications'><i class='bi bi-bell me-1'></i>Notifications" . $notifications . "</a></li>
								<li><a class='dropdown-item gray' href='/manager'><i class='bi bi-archive me-1'></i>Management Portal</a></li>
								<li><a class='dropdown-item gray' href='/settings'><i class='bi bi-gear me-1'></i>Settings</a></li>";

								if($isAdmin == true){
										echo "
										<li><a class='dropdown-item gray' href='/publishNews'><i class='bi bi-newspaper me-1'></i>Publish News [ADMIN]</a></li>";

								}
								echo "
								<li><a class='dropdown-item gray' href='/supportUs'><i class='bi bi-piggy-bank me-1'></i>Support us!</a></li>
								<li><a class='dropdown-item' style='color:#f06868 !important;' href='/logout'><i class='bi bi-box-arrow-left me-1'></i>Logout</a></li>
							  </ul>
						</div>

					  </span>
					</div>



            </div>
        </nav>
		<hr class='nav-break'>";
	}
?>
