<?php
$mydate=getdate(date("U"));
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";

$NN = strtolower($_POST['NNC']);
$D = strtolower($_POST['DC']);
$EOS = strtolower($_POST['EOSC']);
$G = strtolower($_POST['GC']);

$NNA = $_POST['NNCA'];
$DA = $_POST['DCA'];
$EOSA = $_POST['EOSCA'];
$GA = $_POST['GCA'];


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

 $sql01 = "INSERT INTO Codes (NotificationNation, Daily, EndOfStream, Giveaway, NCoins, DCoins, ECoins, GCoins)
        VALUES ('$NN', '$D', '$EOS', '$G', '$NNA', '$DA', '$EOSA', '$GA')";

if ($conn->query($sql01) === TRUE) {
    echo "New record created successfully";
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