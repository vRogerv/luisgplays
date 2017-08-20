<?php
//Version 3.2
$steamauth['apikey'] = "A914EB463A717A618960E4877448261D"; // Your Steam WebAPI-Key found at //steamcommunity.com/dev/apikey
$steamauth['domainname'] = "https://www.luisgplays.com"; // The main URL of your website displayed in the login page
$steamauth['logoutpage'] = "https://www.luisgplays.com/index.php"; // Page to redirect to after a successfull logout (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!
$steamauth['loginpage'] = "https://www.luisgplays.com/index.php"; // Page to redirect to after a successfull login (from the directory the SteamAuth-folder is located in) - NO slash at the beginning!

// System stuff
if (empty($steamauth['apikey'])) {die("<div style='display: block; width: 100%; background-color: red; text-align: center;'>SteamAuth:<br>Please supply an API-Key!</div>");}
if (empty($steamauth['domainname'])) {$steamauth['domainname'] = $_SERVER['SERVER_NAME'];}
if (empty($steamauth['logoutpage'])) {$steamauth['logoutpage'] = $_SERVER['PHP_SELF'];}
if (empty($steamauth['loginpage'])) {$steamauth['loginpage'] = $_SERVER['PHP_SELF'];}
?>
