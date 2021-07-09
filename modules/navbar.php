<?php
	if(!$_SESSION['username']){
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

					</ul>


					  <span class='d-flex'>
					  	<a role='button' href='https://discord.gg/f8aQNJMeVB' class='btn btn-success discord blurple me-1 no-bs' style='color:white !important;background-color:#7289DA !important;border-color:#4E5D94 !important;'><i class='bi bi-discord me-1'></i>Join the Discord!</a>
						<a role='button' style='color:white !important;' href='/login' class='btn btn-primary no-bs'>Tester Login</a>
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

		if($_SESSION['notifs'] > 0){
			$notifications = " <span class='badge rounded-pill bg-danger ms-1'>" . $_SESSION['notifs'] . "</span>";
		}else{
			$notifications = NULL;
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
							<a class='nav-link' aria-current='page' href='/lfg'>LFG</a>
						</li>
						<li class='nav-item'>
							<a class='nav-link' aria-current='page' href='/createLFG'>Create a group!</a>
						</li>
					</ul>

					<span class='d-flex'>

						<div class='dropdown'>
							<a style='text-decoration:none;' class='noselect sm-text dropdown-toggle' role='button' id='dropdownMenuLink' data-bs-toggle='dropdown' aria-expanded='false'>
								<img alt='Profile Avatar' class='rounded-circle me-2' width=32 height=32 src='" . $avatar . "'>" . $_SESSION['username'] . "
							</a>

							  <ul class='dropdown-menu dark-box' aria-labelledby='dropdownMenuButton1'>
								<li><a class='dropdown-item gray' href='/user?u=" . $_SESSION['username'] . "'><i class='bi bi-person me-1'></i></i>My Profile</a></li>
								<li><a class='dropdown-item gray' href='/createLFG'><i class='bi bi-plus-circle me-1'></i>Create a group</a></li>
								<li><a class='dropdown-item gray' href='/notifications'><i class='bi bi-bell me-1'></i>Notifications" . $notifications . "</a></li>
								<li><a class='dropdown-item gray' href='/settings'><i class='bi bi-gear me-1'></i>Settings</a></li>
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
