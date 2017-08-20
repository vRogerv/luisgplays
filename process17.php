<?php
session_start();
include ('steamauth/userInfo.php');
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$mydate=getdate(date("U"));
$steamid=$steamprofile['steamid'];
$user = $steamprofile['personaname'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$sql2 = "INSERT INTO MasterList (Name, SteamID, Ban)
        VALUES ('$user', '$steamid', '1');";
        
$sql3 = "UPDATE MasterList SET Coins = '5' WHERE SteamID = '$steamid'";

$sql02 = "INSERT INTO Log (Time, Message)
        VALUES ('$mydate[year]-$mydate[mon]-$mydate[mday] $mydate[hours]-$mydate[minutes]-$mydate[seconds]', '$user has been added to the MasterList.');
        ";






if ($conn->query($sql2) === TRUE) {
    echo "New record created successfully";
    $conn->query($sql02);
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}

if ($conn->query($sql3) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql3 . "<br>" . $conn->error;
}

$conn->close();
?>
<html>
  <body>
    <p>If not redirected automatically, <a href="index.php">click here.</a></p>
    <?php header("Location: index.php"); ?>
  </body>
</html>