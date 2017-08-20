<?php
session_start();
include ('steamauth/userInfo.php');
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$mydate=getdate(date("U"));
$name=$_POST['name'];
$ip=$_SERVER['REMOTE_ADDR'];
$id = $_SESSION['steam_steamid'];
$user = $steamprofile['personaname'];
$steamid=$steamprofile['steamid'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "DELETE FROM Players WHERE SteamID = $id";
$sql08 = "UPDATE MasterList SET Coins = (Coins + 50) WHERE SteamID = '$steamid'";

$sql01 = "INSERT INTO Log (Time, Message)
        VALUES ('$mydate[year]-$mydate[mon]-$mydate[mday] $mydate[hours]-$mydate[minutes]-$mydate[seconds]', '$user has deleted themselves from the list.')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    $conn->query($sql01);
    $conn->query($sql08);
  
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<html>
  <body>
    <p>If not redirected automatically, <a href="index.php">click here.</a></p>
    <?php header("Location: index.php"); ?>
  </body>
</html>