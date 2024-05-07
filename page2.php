<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select) > 0){
    $fetch = mysqli_fetch_assoc($select);
}
$username = $fetch['name'];
// if(!isset($user_id)){
//     header('location:index.php');
// };
// if(isset($_GET['logout'])){
//     unset($user_id);
//     session_destroy();
//     header('location:index.php');
//  }


if(isset($_POST['send'])){
	$message = mysqli_real_escape_string($conn, $_POST['message']);
    $insert = mysqli_query($conn, "INSERT INTO 'chat'(sender, message) VALUES('$username','$message')") or die('query failed');
    $sql = "INSERT INTO chat (message)
    VALUES ('$message')";
    header("location:home.php");
}


?>