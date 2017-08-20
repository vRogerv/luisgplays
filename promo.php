<?php
session_start();
include ('steamauth/userInfo.php');
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$mydate=getdate(date("U"));
$code = strtolower($_POST['code']);
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

$sqlget8 = "UPDATE Codes SET GCoins = 0 ORDER BY ID DESC LIMIT 1";
$sqldata8 = mysqli_query($conn, $sqlget8) or die('error getting data');


$sqlget9 = "SELECT * FROM Codes ORDER BY ID DESC LIMIT 1";
$sqldata9 = mysqli_query($conn, $sqlget9) or die('error getting data1');
$row = mysqli_fetch_array($sqldata9, MYSQLI_ASSOC);


$nncoins = $row['NCoins']; //Notification Nation Coins
$eoscoins = $row['ECoins']; //End Stream Coins  
$dcoins = $row['DCoins']; //Daily Coins
$gcoins = $row['GCoins']; //Giveaway Coins  

$nncode = $row['NotificationNation']; //Notification Nation Code
$eoscode = $row['EndOfStream']; //End Stream Code
$dcode = $row['Daily']; //Daily Code
$gcode = $row['Giveaway']; //Giveaway Code

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



$sql01 = "UPDATE MasterList SET Coins = (Coins + '$nncoins') WHERE SteamID = '$steamid'";
$sql02 = "UPDATE MasterList SET Coins = (Coins + '$eoscoins') WHERE SteamID = '$steamid'";
$sql03 = "UPDATE MasterList SET Coins = (Coins + '$dcoins') WHERE SteamID = '$steamid'";
$sql04 = "UPDATE MasterList SET Coins = (Coins + '$gcoins') WHERE SteamID = '$steamid'";

$sql1 = "UPDATE MasterList SET NNC = 1 WHERE SteamID = '$steamid'"; //Notification Nation
$sql11 = "SELECT NNC FROM MasterList WHERE SteamID = '$steamid'";
  
$sql2 = "UPDATE MasterList SET DC = 1 WHERE SteamID = '$steamid'"; //Daily 
$sql21 = "SELECT DC FROM MasterList WHERE SteamID = '$steamid'";
  
$sql3 = "UPDATE MasterList SET EOSC = 1 WHERE SteamID = '$steamid'"; //End of Stream
$sql31 = "SELECT EOSC FROM MasterList WHERE SteamID = '$steamid'";
  

$sql11try = ($conn->query($sql11));
  
$sql31try = ($conn->query($sql31));
  
$sql21try = ($conn->query($sql21));

$row1 = mysqli_fetch_array($sql11try, MYSQLI_ASSOC);
  
$row3 = mysqli_fetch_array($sql31try, MYSQLI_ASSOC);
  
$row2 = mysqli_fetch_array($sql21try, MYSQLI_ASSOC);

if($code == $nncode && $row1['NNC'] == 0)
{
  if ($conn->query($sql01) === TRUE) {
    echo "New record created successfully";
    ($conn->query($sql1));
} 
  else {
    echo "Error: " . $sql01 . "<br>" . $conn->error;
}
}
if($code == $eoscode && $row3['EOSC'] == 0)
{
  if ($conn->query($sql02) === TRUE) {
    echo "New record created successfully";
    ($conn->query($sql3));
} 
  else {
    echo "Error: " . $sql02 . "<br>" . $conn->error;
}
}
if($code == $dcode && $row2['DC'] == 0)
{
  if ($conn->query($sql03 ) === TRUE) {
    echo "New record created successfully";
    ($conn->query($sql2));
} 
  else {
    echo "Error: " . $sql03 . "<br>" . $conn->error;
}
}
if($code == $gcode)
{
  if ($conn->query($sql04) === TRUE) {
    echo "New record created successfully";
    ($conn->query($sqldata8));
    header("Location: index.php");
} 
  else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}
else
{
  echo "Incorrect or Expired Code";
  header("Location: index.php");
}
header("Location: index.php");
?>