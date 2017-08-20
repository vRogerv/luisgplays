<?php
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$mydate=getdate(date("U"));
$id=$_POST['id'];
$ip=$_SERVER['REMOTE_ADDR'];


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql10 = "SELECT SteamID FROM Players WHERE ID= '$id'";
$sqldata = $conn->query($sql10);
$row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC);
  
$sql0 = "SELECT * FROM Players WHERE ID= '$id'";
  
$sql = "DELETE FROM Players WHERE ID= '$id'";
  
$sql01 = "INSERT INTO Log (Time, Message)
        VALUES ('$mydate[year]-$mydate[mon]-$mydate[mday] $mydate[hours]-$mydate[minutes]-$mydate[seconds]', 'LuisGPlays has deleted $sql0 from the list.')";
$sql08 = "UPDATE MasterList SET Coins = (Coins + 50) WHERE SteamID = '$row[SteamID]'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    $conn->query($sql01);
    $conn->query($sql08);
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
<html>
  <body>
    <p>If not redirected automatically, <a href="dashboard.php">click here.</a></p>
    <?php header("Location: dashboard.php"); ?>
  </body>
</html>