<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
    $fetch = mysqli_fetch_assoc($select);
}
$username = $fetch['name'];
if(!isset($user_id)){
    header('location:index.php');
};
// if(isset($_GET['logout'])){
//     unset($user_id);
//     session_destroy();
//     header('location:index.php');
//  }

// if(isset($_POST['send'])){
//     echo "".$fetch['name']. "<br><br>";
// 	$message = mysqli_real_escape_string($conn, $_POST['message']);
//     $insert = mysqli_query($conn, "INSERT INTO 'chat'(sender, message) VALUES('$username','$message')") or die('query failed');
//     $sql = "INSERT INTO chat (message)
//     VALUES ('$message')";
//     header("location:home.php");
// }


if(isset($_POST['message'])){
    $input = $_POST['message'];
    $insert = mysqli_query($conn, "INSERT INTO `chat`(sender, message) VALUES('$username','$input')") or die('query failed');
    header("location:home.php");

}



?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>[Something Nice] - Chat</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="images/Icon.png">


</head>

<style>
    input[type=textarea]{
        background-color: white;
        border:none;
        color:black;
        padding:8px;
        text-decoration:none;
        margin:4px 1px;
        margin-top:10px;
    }
    input[type=submit]{
        background-color: grey;
        border: none;
        color: white;
        padding; 8px 18px;
        text-decoration: none;
        height: 30px;
        width: 60px;
        margin:4px 1px;
        cursor: pointer;
        border-radius:10%;
        font-family: helvetica;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }

</style>


<body style="width: 100%;">
	<nav class="menu">
  		<a href="home.php" class="active"><img src="images/Icon.png" width="55" height="55"></a>
  		<a href="matchmaking.php" class="menumargin">Match Up</a>
  		<a class="menumargin"href="labout.php">About</a>
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
    
    <!-- <meta http-equiv="refresh" content="20"> -->
    <iframe id="iframe" src="page1.php" style="width:400px; height:200px; margin-top:100px; background-color: white;" scrolling ="yes"></iframe>
    <script>
        window.setInterval(function() {
            reloadIFrame()
        }, 1000);

        function reloadIFrame() {
            console.log('reloading..');
            document.getElementById('iframe').src = document.getElementById('iframe').src

        }
        setInterval('frames[0].scrollTo(0,9999999)')
    </script>

    <form method="post" action=""> Send user a message: 
        <input type="textarea" name="message" required>
        <input type="submit" name="send" value="Send"> <br /> <br />
        
    </form>
    








</body>
</html>
</html>