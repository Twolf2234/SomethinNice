<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];


$users = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
$user = mysqli_fetch_assoc($users);



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
	<title>[Something Nice] - Chats</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="icon" href="images/Icon.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>




</head>
<body style="width: 100%;">
	<nav class="menu">
  		<a href="home.php"><img src="images/Icon.png" width="55" height="55"></a>
  		<a href="matchmaking.php" class="menumargin active">Chats</a>
  		<a class="menumargin "href="labout.php">About</a>
	  	<a href="lcontact.php" class="menumargin">Contact</a>
	  	<a href="profile.php" style="float: right;">
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
	<div class="container-fluid" style="padding-top:100px;">

        <div class="row">
            <div class="col-md-4">
                
                <h1>Hey <?php echo $user["name"]; ?>!</h1>
                <input type="text" id="from_user" value=<?php echo $user["id"]; ?> hidden />
                <h2>These are your previous chats:</h2>
                <ul>
                    <?php
                        $queries = mysqli_query($conn, "SELECT * FROM `queries` WHERE helper = '$user_id' OR problem = '$user_id'") or die('query failed');
                        while($query = mysqli_fetch_assoc($queries)){
                            echo '<li><a href="?query_id='.$query["id"].'" style="font-size:20px;">'.$query["title"].'</a></li>';
                        }
                    ?>
                </ul>
            </div>
            <div class="chatBox" id="chatbox"
            style="
            background-color:white;
            width: 500px;
            position: absolute;
            "
            >

                <div class="chat-dialogue">
                    <div class = "chat-content">
                        <div class = "chat-header">
                            <h4>
                                <?php
                                if(isset($_GET['query_id'])){
                                    $query_title = mysqli_query($conn, "SELECT * FROM `queries` WHERE id = '".$_GET['query_id']."'") or die('query failed');
                                    $title = mysqli_fetch_assoc($query_title);
                                    
                                    echo '<input type="text" value='.$_GET['query_id'].' id="query_title" hidden/>';
                                    echo '<h2>'.$title["title"].'</h2>';
                                }
                                else{
                                    $query_title = mysqli_query($conn, "SELECT * FROM queries") or die('query failed');
                                    $title = mysqli_fetch_assoc($query_title);
                                    if ($user_id == $title["problem"]){
                                        $_SESSION["query_id"] = $title["id"];
                                        $_SESSION["to_user"] = $title["helper"];
                                        echo '<input type="text" value='.$_SESSION["to_user"].' id="query_title" hidden/>';
                                        echo $title["title"];
                                    }
                                    else{
                                        $_SESSION["query_id"] = $title["id"];
                                        $_SESSION["to_user"] = $title["problem"];
                                        echo '<input type="text" value='.$_SESSION["to_user"].' id="query_title" hidden/>';
                                        echo $title["title"];
                                    }
                                    


                                }
                                ?>
                            </h4>
                        </div>
                        <div class="chat-body" id="msgBody" style="height:400px; overflow-y: scroll; overflow-x; hidden;">
                                <?php
                                    // $query = mysqli_query($conn, "SELECT * FROM `queries` WHERE helper = '$user_id' OR problem = '$user_id'") or die('query failed');
                                    // $query_id = mysqli_fetch_assoc($query);
                                    // $id = $query_id["id"];
                                    // echo $id;
                                    
                                    if(isset($_GET["query_id"])){
                                        $chats = mysqli_query($conn, "SELECT * FROM `p_chat` WHERE query_id = '".$_GET['query_id']."'") or die('query failed');
                                        
                                        while($chat = mysqli_fetch_assoc($chats)){
                                            if($chat["from_user"] == $user_id){
                                                echo "<div style='text-align:right;'>
                                                    <p style = 'background-color:lightblue; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                                        ".$chat["message"]."
                                                    </p>

                                                </div>";
                                            }
                                            else{
                                                echo "<div style='text-align:left;'>
                                                    <p style = 'background-color:yellow; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                                        ".$chat["message"]."
                                                    </p>

                                                </div>";
                                            }
                                        }
                                    }
                                    else{
                                        $chats = mysqli_query($conn, "SELECT * FROM `p_chat` WHERE query_id = '".$_SESSION['query_id']."'") or die('query failed');
                                        while($chat = mysqli_fetch_assoc($chats)){
                                            if($chat["from_user"] == $user_id){
                                                echo "<div style='text-align:right;'>
                                                    <p style = 'background-color:lightblue; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                                        ".$chat["message"]."
                                                    </p>

                                                </div>";
                                            }
                                            else{
                                                echo "<div style='text-align:left;'>
                                                    <p style = 'background-color:yellow; word-wrap:break-word; display:inline-block; padding:5px; border-radius:10px; max width:70%;'>
                                                        ".$chat["message"]."
                                                    </p>

                                                </div>";
                                            }
                                        }
                                    }
                                ?>

                        </div>
                        <div class="chat-footer">
                            <form method="post">
                                <textarea name="message" class="form-control" type="text" style="height:70px; width:80%;"></textarea>
                                <button name="send" class="btn btn-primary" type="submit" style="heigh:10%; width:50px;">send</button>
                            </form>

                            <?php
                             if(isset($_POST['send'])){
                                
                                $message = mysqli_real_escape_string($conn, $_POST['message']);
                                $insert = mysqli_query($conn, "INSERT INTO `p_chat` (from_user, to_user, message, query_id) VALUES('$user_id','$_SESSION[to_user]','$message','$title[id]')") or die('query failed');
                                // $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
                                // header("location:matchmaking.php");
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

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