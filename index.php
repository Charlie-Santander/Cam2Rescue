<?php
	include_once("back_end.php");

	  if(!isset($_SESSION['username'])) {
		session_start();
	  }
		//$con = mysqli_connect("184.168.117.223", "braindraincrew", "BrainDrainCrew", "cam2rescue_db"); real server
		$con = db_connection();
    	
	   	if(isset($_POST['upload'])) { 
			upload_image();
		}

		if(isset($_POST['login'])) {
			login_user();
		}

		if(isset($_POST["register"]))
        {
           register();
        }
		
		if(isset($_GET['logout'])) {
			logout_user();
		}
	   		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	<link rel="stylesheet" type="text/css" href="w3.css">
	<link rel="stylesheet" type="text/css" href="CSS/cam2rescue.css">
	<title>An Online Platform for pet rescue and shelter</title>
</head>
	<body>
		<header class="w3-container w3-orange">
			<div class="w3-row w3-container">
				<div class="w3-half">
					<h1 class="w3-animate-right w3-text-white">Cam2Rescue</h1>
				</div>
			    <div class="w3-half">
					<?php 
						if(isset($_SESSION['username'])) { ?>
			    			<button class="w3-btn w3-left w3-margin-top w3-animate-right w3-text-white">My Dashboard</button>
							<button class="w3-btn w3-left w3-margin-top w3-animate-right w3-text-white">About Us</button>
							<a href="index.php?logout=true" class="w3-btn w3-left w3-margin-top w3-animate-right w3-text-white">Logout</a>
					<?php } 
					else { ?>
						<button onclick="document.getElementById('login').style.display='block'" class="w3-btn w3-left w3-margin-top w3-animate-right w3-text-white">Login</button>
						<button onclick="document.getElementById('register').style.display='block'" class="w3-btn w3-left w3-margin-top w3-animate-right w3-text-white">Register</button>
					<?php } ?>
				</div>
			</div>
		</header>
		<div class="w3-row w3-container w3-indigo">
			<div class="w3-half w3-container w3-card-4">
				<img src="images/backg.jpg" alt="model image" class="w3-animate-zoom">
			</div>
			<div class="w3-half w3-container">
				<h1 class="w3-animate-right">WE RESCUE AND PROVIDE SHELTER FOR ANIMALS<br/> AND ADOPT YOUR FUTURE PET HERE!</h1>
				<button class="w3-btn w3-red w3-margin-bottom w3-round-large">Post Rescue</button>
				<button class="w3-btn w3-red w3-margin-left w3-margin-bottom w3-margin-right w3-round-large">Adopt</button>
				<button class="w3-btn w3-red w3-margin-bottom w3-round-large">Post Adoption</button>
			</div>
		</div>
		<div class="w3-row">
			<div class="w3-third w3-col.s4 w3-container">
				<h2>Pet Posted for Rescue</h2>
				<div class="w3-card-4">
					<h3 class="w3-text-yellow w3-margin w3-animate-right">1 PESO makes you a HERO</h3>
					<p class="w3-margin">
						Any form of donation can save lives of these poor pets,
						your donations will be directly received by the choosen
						organization either in kind donation or cash donation.
					</p>
					<button class="w3-btn w3-black w3-margin w3-round-medium">Donate</button>
				</div>
			</div>
			<div class="w3-half w3-col.s8 w3-container w3-block">
				<img src="images/dog1.jpg" alt="image 1" class="w3-margin-top w3-col.s2 img-resize">
				<img src="images/dog2.jpg" alt="image 2" class="w3-margin-top w3-col.s2 img-resize">
				<img src="images/dog3.jpg" alt="image 3" class="w3-margin-top w3-col.s2 w3-opacity img-resize">
			</div>
		</div>
		<div class="w3-row w3-black ">
			<div class="w3-third w3-col.s4 w3-margin">
				<a href="">Cam2RESCUE</a>
				<p>Add some important details here</p>
			</div>
			<div class="w3-third w3-col.s4 w3-margin">
				<p>&copy This website is owned by Brain Drain Crew Team</p>
				<p>Add some important details here</p>
			</div>
			<div class="w3-quarter w3-col.s4 w3-margin">
				<h3>Contact US</h3>
				<p>Add some important details here</p>
			</div>
		</div>

		<!-- modal login-->
		<div id="login" class="w3-modal">
			<div class="w3-modal-content">
				<header class="w3-container w3-orange"> 
					<span onclick="document.getElementById('login').style.display='none'" 
					class="w3-button w3-display-topright">&times;</span>
					<h2 class="w3-text-white">User Login</h2>
				</header>
				<div class="w3-container">
					<form class="w3-container w3-card-4" method="post">
						<p>
							<label class="w3-text-blue"><b>Username</b></label>
							<input class="w3-input w3-border" name="username" type="text">
						</p>
						<p>      
							<label class="w3-text-blue"><b>Password</b></label>
							<input class="w3-input w3-border" name="password" type="password"></p>
						</p>
						<div class="w3-row w3-container"> 
							<div class="w3-third w3-col.s4 w3-margin"></div>
							<div class="w3-third w3-col.s4 w3-margin">
								<input type="submit" name="login" value="Login" class="w3-btn w3-blue">
							</div>
						</div>
					</form>
				</div>
				<footer class="w3-container w3-orange w3-margin">
					<p>Modal Footer</p>
				</footer>
			</div>
		</div>
		<!--modal for user registration-->
		<div id="register" class="w3-modal">
			<div class="w3-modal-content">
				<header class="w3-container w3-orange"> 
					<span onclick="document.getElementById('register').style.display='none'" 
					class="w3-button w3-display-topright">&times;</span>
					<h2 class="w3-text-white">User Registration</h2>
				</header>
				<div class="w3-container">
					<form class="w3-container w3-card-4" method="post">
						<p>
							<label class="w3-text-blue"><b>Lastname</b></label>
							<input class="w3-input w3-border" name="username" type="text">
						</p>
						<p>      
							<label class="w3-text-blue"><b>Firstname</b></label>
							<input class="w3-input w3-border" name="password" type="password"></p>
						</p>
						<p>
							<label class="w3-text-blue"><b>Lastname</b></label>
							<input class="w3-input w3-border" name="username" type="text">
						</p>
						<p>      
							<label class="w3-text-blue"><b>Firstname</b></label>
							<input class="w3-input w3-border" name="password" type="password"></p>
						</p>
						<p>
							<label class="w3-text-blue"><b>Lastname</b></label>
							<input class="w3-input w3-border" name="username" type="text">
						</p>
						<p>      
							<label class="w3-text-blue"><b>Firstname</b></label>
							<input class="w3-input w3-border" name="password" type="password"></p>
						</p>
						<p>
							<label class="w3-text-blue"><b>Lastname</b></label>
							<input class="w3-input w3-border" name="username" type="text">
						</p>
						<p>      
							<label class="w3-text-blue"><b>Firstname</b></label>
							<input class="w3-input w3-border" name="password" type="password"></p>
						</p>
						<div class="w3-row w3-container"> 
							<div class="w3-third w3-col.s4 w3-margin"></div>
							<div class="w3-third w3-col.s4 w3-margin">
								<input type="submit" name="login" value="Register" class="w3-btn w3-blue">	
							</div>
						</div>
					</form>
				</div>
				<footer class="w3-container w3-orange w3-margin">
					<p>Modal Footer</p>
				</footer>
			</div>
		</div>
	</body>
</html>