<?php
  session_start();
  include ('steamauth/userInfo.php');

  $servername = "...";
  $username = "...";
  $password = "...";
  $dbname = "...";
  $user = $steamprofile['personaname'];
  $steamid = $steamprofile['steamid'];

  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  } 

  $sqlget9 = "SELECT * FROM MasterList WHERE SteamID = '$steamid' LIMIT 1";
  $sqldata9 = mysqli_query($conn, $sqlget9) or die('error getting data');


  $conn->close();
?>
<html lang="en">
  <head>
    <?php include ('header.php'); ?>
  </head>
  <style>
    .form-control {
      position: relative;
      font-size: 16px;
      height: auto;
      padding: 10px;
      @include box-sizing(border-box);

      &:focus {
        z-index: 2;
      }
    }
  </style>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="border-color: transparent">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">LuisGPlays</a>
          <?php
              if(isset($_SESSION['steamid'])) {
                    echo "<a href=\"https://www.luisgplays.com/free.php\" style='margin-left: 50px'><button type=\"button\" class=\"btn btn-success navbar-btn\" style=\"display:inline-block\">Free <i class=\"fa fa-money fa-1x\" aria-hidden=\"true\" style=\"color: white;\"></i></button></a>";     
                  
                while($row = mysqli_fetch_array($sqldata9, MYSQLI_ASSOC)){
                  echo "<button id=\"myButton\"type=\"button\" class=\"btn btn-primary navbar-btn\" style=\"display:inline-block; margin-left: 10px\">";
                  echo $row['Coins'];
                  echo "&nbsp";
                  echo "<i class=\"fa fa-money fa-1x\" aria-hidden=\"true\" style=\"color: white;\"></i></button>"; 
                  echo "<script>";
                  echo "document.getElementById(\"myButton\").onclick = function () {alert(\"";
                  echo "You have ";
                  echo $row['Coins'];
                  echo " Points\")}";
                      }
                  echo "</script>";
                }
                else {
                  echo "";
                }
              ?>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" style="float: right">
            <?php
              if(isset($_SESSION['steamid'])) 
              {
                echo "<li style=\"float: right\"><a href=\"logout.php\">Logout</a></li>";
              }  
            
              else 
              {
                echo "<li style=\"float: right\"><a href=\"login.php\">Login</a></li>";
              }   
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <?php
        echo "<h1 style=\"text-align: center\">";
        echo "$user";
        echo "'s";
        echo " Profile";
        echo "</h1><br><br><img src=\"";
        echo $steamprofile['avatarfull'];
        echo "\" class=\"img-circle img-responsive\" style=\"margin: 0 auto; display: block\" >";
        echo "<br>";
      ?>
      <hr>
      <?php
        echo "<form action=\"promo.php\" method=\"post\" name=\"code\" id=\"code\">";
          echo "<div class=\"form-group\">";
          echo "<input type=\"text\" class=\"form-control\" placeholder=\"Stream Code\" required name=\"code\" id=\"code\">";
          echo "</div>";
          echo "<button type=\"submit\" class=\"btn btn-default\">Submit</button>";
        echo "</form><br>";
        echo "<div class=\"alert alert-info\" role=\"alert\">";
        echo "<p><a href=\"https://steamcommunity.com/tradeoffer/new/?partner=172467468&token=3jj67qJB\" target=\"_blank\">Get more points by donating skins to luis on the official donation bot! Donate Here!</a></p>";
        echo "</div>";
      ?>
<!--
      <div class="alert alert-info" role="alert">
        <p>Set LuisGPlays Community As Your Primary Steam Group.</p>
        <button type="button" class="btn btn-info navbar-btn" style="display: inline">Free 20 <i class="fa fa-money fa-1x" aria-hidden="true" style="color: white;"></i></button>
      </div>
-->
      <hr>
    </div>
    <div class="container">
      <footer>
      <?php include ('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>