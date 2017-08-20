<?php
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$mydate=getdate(date("U"));
$text=$_POST['text'];
$skin=$_POST['skin'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO Stream (Date, Text, Skin, Time)
        VALUES ('$mydate[mon]/$mydate[mday]/$mydate[year]', '$text', '$skin', '$mydate[year]-$mydate[mon]-$mydate[mday] $mydate[hours]-$mydate[minutes]-$mydate[seconds]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
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