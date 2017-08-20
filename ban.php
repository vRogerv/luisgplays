<?php
$mydate=getdate(date("U"));
$servername = "...";
$username = "...";
$password = "...";
$dbname = "...";
$id = $_POST['name'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql0 = "SELECT Name FROM MasterList WHERE ID = $id";
$result = $conn->query($sql0);
$name = mysqli_fetch_assoc($result);

$sql = "UPDATE MasterList SET Ban = 2
        WHERE ID = $id";
  
 $sql01 = "INSERT INTO Log (Time, Message)
        VALUES ('$mydate[year]-$mydate[mon]-$mydate[mday] $mydate[hours]-$mydate[minutes]-$mydate[seconds]', 'LuisGPlays has banned $name[Name] from the list.')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    $conn->query($sql01);
} else {
    echo "Error: " . $sq2 . "<br>" . $conn->error;
}

$conn->close();
?>
<html>
  <body>
    <p>If not redirected automatically, <a href="dashboard.php">click here.</a></p>
    <?php header("Location: dashboard.php"); ?>
  </body>
</html>
