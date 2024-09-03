<?php

include 'config.php';

if(isset($_POST['register'])){

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
	$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
	$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

	if(mysqli_num_rows($select) > 0){
		$message[] = 'user already exist'; 
	}
	else{
		if($pass != $cpass){
		   $message[] = 'Passwords do not match!';
		}
		$insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
		if($insert){
			move_uploaded_file($image_tmp_name, $image_folder);
			$message[] = 'registered successfully!';
			header('location:index.php');
		}else{
			$message[] = 'registeration failed!';
		}
	}
}
  
session_start();

if(isset($_POST['login'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['pass']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
	  $_SESSION['interest_1'] = $row['interest_1'];
	  $_SESSION['interest_2'] = $row['interest_2'];
      header('location: profile.php');
   }else{
      $message[] = 'incorrect email or password!';
   }

}
?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[Something Nice] - Welcome</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="images/Icon.png">

</head>
<body style="background-color: lightcyan;">
	<header>
		<nav class="menu">
	  		<a class="active" href="index.php"><img src="images/Icon.png" width="55" height="55"></a>
	  		<a href="about.php" class="menumargin">About</a>
	  		<a href="contact.php" class="menumargin">Contact</a>
	  		<a href="#" class="btnLogin-popup menumargin" style="float: right;">Login/Register</a>
		</nav>
	</header>
	<?php
		if(isset($message)){
			foreach($message as $message){
				echo '<div class="message" id="message">'.$message.'</div>';
			}
		}
	?>
	
	<div class="welcome">
		<h1>WELCOME</h1>
		<img class="banner" src="./images/speechbubble1.png" alt="Banner">
		<pre>


A place to send positive vibes to one another
and share problems to people with similar age
and interests as you
		</pre>
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