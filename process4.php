<?php
include ('steamauth/userInfo.php');
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$mydate=getdate(date("U"));
$name=$_POST['name'];
$ip=rand();


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Players (ID, Name, Date, SteamID)
        VALUES ('0', '$name', '0000-00-00 00-00-00', '$ip')";
  
$sql01 = "INSERT INTO Log (Time, Message)
        VALUES ('$mydate[year]-$mydate[mon]-$mydate[mday] $mydate[hours]-$mydate[minutes]-$mydate[seconds]', 'LuisGPlays has added $name to the top of the list.')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    $conn->query($sql01);
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