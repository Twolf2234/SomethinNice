<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:index.php');
};
if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:index.php');
 }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[Something Nice] - About</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="images/Icon.png">

</head>
<body style="width: 100%;">
<nav class="menu">
  		<a href="home.php"><img src="images/Icon.png" width="55" height="55"></a>
  		<a href="matchmaking.php" class="menumargin">Chats</a>
  		<a class="menumargin active"href="labout.php">About</a>
	  	<a href="lcontact.php" class="menumargin">Contact</a>
	  	<a href="profile.php"  style="float: right;">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
                if($fetch['image'] == ''){
                    echo '<img src="images/default-avatar.png" width="55" height="55">';
                }else{
                    echo '<img src="uploaded_img/'.$fetch['image'].'" width="55" height="55">';
                }
            ?>
        </a>
	</nav>
	<?php
		if(isset($message)){
			foreach($message as $message){
				echo '<div class="message" id="message">'.$message.'</div>';
			}
		}
	?>
	   <h1 style="padding-top: 80px; font-size: 70px;color: darkslategray;">Hello there!</h1>
	   <h1 style=" font-size: 70px;color: darkslategray;">Welcome to my Platform!</h1>
	<div class="aboutbox" style=" font-size: 20px;">
		<h3>
			<p>
			</p>
			<p style="font-weight: bold; font-size: 40px;background-color: lightskyblue;">About [Something Nice]</p>
			<pre style="padding-top: 15px;">
You might be wondering; "What is [Something Nice] 
all about, and why it came to be?" Well let me tell you!
			
[Something Nice]
is a safe anonymous space
where you can share kindness
with one another

I decided to make this platform
to get people from around the 
world to share their problems,
learn from eachother, and spread
joy.
			</pre>
		</h3>

	</div>
			
	<div class="mebox">
		<h1 style="font-size:50px;">Who is the guy behind it all?</h1>
		<img style="height: 25%; width: 25%;" src="images/toby.jpg" alt="Toby">
		</pre>
		<p style="font-weight: bold;bold;font-size: 40px;">Lead Developer & Designer</p>
		<pre style="font-size: 16px; font-weight: bold; ">
Toby Sy
(253)123-3455
tmvsy17@uw.edu
		</pre>
		<p style="font-weight: bold;font-size: 40px;">About me</p>
		<pre style="font-weight: bold;font-size: 16px;">
Hi. My name is Toby, I am currently a student at the University of Washington.
Majoring in Information Technology, I aim to use my skills in webdevelopment
and project planning to bring this platform to life. This platform acts as my 
design project for my IT course.I hope that this platform can bring joy to those
who are in need of any kind words.
		
	</div>

	<div>
		<div class="wrapper"> 
			<span class="icon-close">
				<ion-icon name="close"></ion-icon>
			</span>

			<div class="form-box login">
				<h2>Login</h2>
				
				<form action="" method="post" enctype="multipart/form-data">
					<div class="input-box">
						<span class="icon"><ion-icon name="mail"></ion-icon></span>
						<input type="email" name="email"required>
						<label>Email</label>
					</div>
					<div class="input-box">
						<span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
						<input type="password" name="pass"required>
						<label>Password</label>
					</div>
					<div class="remember-forgot">
						<label><input type="checkbox">
						Remember this device?</label>
						<a href="#">Forgot Password?</a>
					</div>
					<input type="submit" class="btn" name="login" value="Login">
					<div class ="login-register">
						<p>Don't have an account? <a href="#" class="register-link">Register now</a></p>
					</div>
				</form>
			</div>

			
			<div class="form-box register"> 
				<h2>Registration</h2>
				<form action="" method="post" enctype="multipart/form-data">
					<div class="input-box">
						<span class="icon" id="username"><ion-icon name="person"></ion-icon></span>
						<input type="text" name="name" required>
						<label>Username</label>
					</div>
					<div class="input-box">
						<span class="icon" id="email"><ion-icon name="mail"></ion-icon></span>
						<input type="email" name="email"required>
						<label>Email</label>
					</div>
					<div class="input-box">
						<span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
						<input type="password" name="password" required>
						<label>Password</label>
					</div>
					<div class="input-box">
						<span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
						<input type="password" name="cpassword" required>
						<label>Confirm Password</label>
					</div>
					<div class="remember-forgot">
						<label><input type="checkbox">
						I agree to the terms and conditions</label>
					</div>
					<input type="submit" name="register" class="btn" value="register now">
					<div class ="login-register">
						<p>Already have an account? <a href="#" class="login-link">Login</a></p>
					</div>
				</form>
			</div>

		</div>
	</div>



	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

	<!-- Firebase Script -->
	<script type="module">

	  // Import the functions you need from the SDKs you need

	  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-app.js";

	  import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.11.0/firebase-database.js"; 
	</script>

	<script src="script.js"></script>
</body>
</html>
</html>