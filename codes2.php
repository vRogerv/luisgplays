<?php
$mydate=getdate(date("U"));
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql01 = "UPDATE MasterList SET NNC = 0";
$sql02 = "UPDATE MasterList SET DC = 0";
$sql03 = "UPDATE MasterList SET EOSC = 0";

if ($conn->query($sql01) === TRUE) {
    echo "New record created successfully";
    $conn->query($sql02);
    $conn->query($sql03);
} else {
    echo "Error: " . $sql01 . "<br>" . $conn->error;
}

$conn->close();
?>
<html>
  <body>
    <p>If not redirected automatically, <a href="dashboard.php">click here.</a></p>
    <?php header("Location: dashboard.php"); ?>
  </body>
</html>