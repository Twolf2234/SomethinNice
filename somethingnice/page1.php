
<!DOCTYPE html>
<html>
<body>

<?php

// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname ="user_db";

// $conn = new mysqli($servername, $username, $password, $dbname);

$conn = mysqli_connect('localhost','root','','user_db') or die('connection failed');

$select = mysqli_query($conn, "SELECT * FROM `chat`") or die('query failed');
$fetch = mysqli_fetch_assoc($select);
            
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
$sql = "SELECT 'message' FROM chat";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "".$fetch['sender'].": ".$fetch['message']. "<br><br>";
        $fetch = mysqli_fetch_assoc($select);
    }
}
else{
    echo "no messages have been exchanged yet";
}
$conn->close();



?>

</body>
</html>
</html>