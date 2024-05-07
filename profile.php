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
	<title>[Something Nice] - Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="images/Icon.png">

</head>
<body style="width: 100%;">
	<nav class="menu">
  		<a href="home.php"><img src="images/Icon.png" width="55" height="55"></a>
  		<a href="matchmaking.php" class="menumargin">Match Up</a>
  		<a class="menumargin"href="labout.php">About</a>
	  	<a href="lcontact.php" class="menumargin">Contact</a>
	  	<a href="profile.php" class="active" style="float: right;">
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
	
    <div class="container">
        <div class="profile">
            <?php
                $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                   $fetch = mysqli_fetch_assoc($select);
                }
                if($fetch['image'] == ''){
                    echo '<img src="images/default-avatar.png">';
                 }else{
                    echo '<img src="uploaded_img/'.$fetch['image'].'">';
                 }
            
            ?>
            <h3><?php echo $fetch['name']?></h3>
            <h4>Interests: <?php echo $fetch['interest_1']?>, <?php echo $fetch['interest_2']?></h4>
            <h4>Age Range: <?php echo $fetch['age_range']?></h4>
            <a href="update_profile.php" class="btn"> update profile</a>
            <a href="profile.php?logout=<?php echo $user_id; ?>" class="delete_btn" >logout</a>
            <p>new <a href="index.php">login</a> or <a href="index.php">register</a></p>
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