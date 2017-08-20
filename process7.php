<?php
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];



if ($user == "luisgplays" && $pass == "silver1") 
{
  $_SESSION['login_user'] = "luisgplays";
  header("Location: dashboard.php");
}
else 
{
  echo "Wrong password.";
  header("Location: login.php");
}
?>
<html>
  <body>
    <p>If not redirected automatically, <a href="dashboard.php">click here.</a></p>
    <?php header("Location: dashboard.php"); ?>
  </body>
</html>