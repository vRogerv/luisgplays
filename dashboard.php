<?php
session_start();
if((isset($_SESSION['login_user'])))
{
    include("luis.php");
}
else 
{
  header("Location: login.php");
}
 
?>