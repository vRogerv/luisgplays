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

  $sqlget = "SELECT * FROM Players ORDER BY Date";
  $sqldata = mysqli_query($conn, $sqlget) or die('error getting data');

  $sqlget2 = "SELECT * FROM Desciption ORDER BY Date DESC LIMIT 1";
  $sqldata2 = mysqli_query($conn, $sqlget2) or die('error getting data');

  $sqlget3 = "SELECT * FROM Stream ORDER BY Time DESC LIMIT 3";
  $sqldata3 = mysqli_query($conn, $sqlget3) or die('error getting data');

  $sqlget4 = "SELECT COUNT(*) FROM Players";
  $sqldata4= mysqli_query($conn, $sqlget4) or die('error getting data');

  $sqlget6 = "SELECT * FROM MasterList WHERE SteamID = '$steamid' LIMIT 1";
  $sqldata6= mysqli_query($conn, $sqlget6) or die('error getting data'); 

  $sqlget7 = "SELECT Name FROM Players WHERE Name = '$user' LIMIT 1";
  $sqldata7= mysqli_query($conn, $sqlget7) or die('error getting data'); 

  $sqlget8 = "SELECT * FROM Log ORDER BY Time DESC LIMIT 10";
  $sqldata8 = mysqli_query($conn, $sqlget8) or die('error getting data');

  $sqlget9 = "SELECT * FROM MasterList WHERE SteamID = '$steamid' LIMIT 1";
  $sqldata9 = mysqli_query($conn, $sqlget9) or die('error getting data');

  $sqlget10 = "SELECT * FROM MasterList ORDER BY Coins DESC LIMIT 10";
  $sqldata10 = mysqli_query($conn, $sqlget10) or die('error getting data');

  $sqlget11 = "SELECT * FROM MasterList WHERE SteamID = '$steamid' LIMIT 1";
  $sqldata11 = mysqli_query($conn, $sqlget11) or die('error getting data');


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
                    echo "<a href=\"https://www.luisgplays.com/free.php\" style='margin-left: 10px'><button type=\"button\" class=\"btn btn-success navbar-btn\" style=\"display:inline-block\">Free <i class=\"fa fa-money fa-1x\" aria-hidden=\"true\" style=\"color: white;\"></i></button></a>";     
                  
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
    <header class="business-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div style="float: right; display: inline; background-color: #f8f8f8; padding: 5px;">
              <a href="https://steamcommunity.com/id/LuisGplays" target="_blank"><i class="fa fa-steam fa-3x" aria-hidden="true" style="color: #000000; padding: 5px"></i></a>
              <a href="https://twitter.com/luisgplays?lang=en" target="_blank"><i class="fa fa-twitter fa-3x" aria-hidden="true" style="color: #1da1f2; padding: 5px"></i></a>
              <a href="https://www.twitch.tv/luisgplays5" target="_blank"><i class="fa fa-twitch fa-3x" aria-hidden="true" style="color: #6441A5; padding: 5px"></i></a>
            </div>
          </div>
        </div> 
        <?php include ('scroll.php'); ?>
      </div>
    </header>
    <div class="container">
      <hr>
      <div class="row">
        <div class="col-sm-8">
          <?php
            echo "<h2>What I Do</h2>";
            while($row = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC)) {
              echo "<p>";
              echo $row['Text'];
              echo "</p>";
            }
          ?>
          <p>
            <a class="btn btn-default btn-lg" href="//www.youtube.com/channel/UCt28ZK-ix9pKdYwpGKaFsyQ/featured" target="_blank">View Channel &raquo;</a>
          </p>
        </div>
      </div>
      <hr>
      <?php
        echo "<div class=\"row\">";
        while($row7 = mysqli_fetch_array($sqldata11, MYSQLI_ASSOC)) {
        while($row = mysqli_fetch_array($sqldata3, MYSQLI_ASSOC)) {
          $entries = $row['Entries'];
          $answer = ($entries/20)*100;
          echo "<div class=\"col-sm-4\">";
          echo "<img class=\"img-circle img-responsive img-center\" src=\"";
          echo $row['Skin'];
          echo "\" width=\"300px\" height=\"300px\">";
          echo "<h4 class=\"animated\">";
          echo $row['Text'];
          echo "</h4>";
          echo "<p class=\"animated\">";
          echo "Enter to win a CS: GO skin! Entires cost 25 <i class=\"fa fa-money fa-1x\" aria-hidden=\"true\" style=\"color: white;\"></i>";
          echo "</p>";
          
          echo "<div class=\"progress\">";
          echo "<div class=\"progress-bar progress-bar-striped active\" role=\"progressbar\" aria-valuenow=\"45\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: ";
          echo $answer;
          echo "%\">";
          echo $row['Entries'];
          echo " Enteries";
          echo "<span class=\"sr-only\">45% Complete</span>";
          echo "</div>";
          echo "</div>";
          
//              if($row['Entires'] == 20) {
//               echo "<div class=\"alert alert-danger\" role=\"alert\">";
//               echo "<p>Giveaway entries closed! Try another.</p>";
//               echo "</div>";
//                  
//               }
//              if($row['Entires'] < 20) {
//              
//                  if($row7['Coins'] == 25) {
//                   echo "<form id='name' action='process.php' method='post' accept-charset='UTF-8'>";
//                   echo "<fieldset>";
//                   echo "<button class=\"btn btn-lg btn-primary btn-block animated zoomIn\" type=\"submit\" value=\"Submit\">";
//                   echo "Join the giveaway for <i class=\"fa fa-money\" aria-hidden=\"true\"></i> 25</button>";
//                   echo "</fieldset>";
//                   echo "</form>"; 
//
//                 }
//                 if($row7['Coins'] > 25){
//                   echo "<form id='name' action='process.php' method='post' accept-charset='UTF-8'>";
//                   echo "<fieldset>";
//                   echo "<button class=\"btn btn-lg btn-primary btn-block animated zoomIn\" type=\"submit\" value=\"Submit\">";
//                   echo "Join the giveaway for <i class=\"fa fa-money\" aria-hidden=\"true\"></i> 25</button>";
//                   echo "</fieldset>";
//                   echo "</form>";    
//
//                   } 
//
//                 if($row7['Coins'] < 25) {
//                   echo "<div class=\"alert alert-danger\" role=\"alert\">";
//                   echo "<p>You need at least <i class=\"fa fa-money\" aria-hidden=\"true\"></i> 25 to enter.</p>";
//                   echo "</div>";
//
//                   }
//               }
             
            
          echo "</div>";
        }}
        echo "</div>";
      ?>
      <hr>
      <br>
      <div class="alert alert-info" role="alert">
      <p><a href="https://imgur.com/a/MNJxN" target="_blank">Tutorial on how to join the list and earn points.</a></p>
      </div>
      <br>
      <hr>
      <div>
        <h2>Top 10 Users</h2>
        <?php
          echo "<table>";
                echo "<tr><th style=\"padding: 20px\">Name</th><th style=\"padding: 20px\">Points</th></tr>";

                while($row5 = mysqli_fetch_array($sqldata10, MYSQLI_ASSOC)) {
                  echo "<tr><td style=\"padding: 20px\">";
                  echo $row5['Name'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo "<i class=\"fa fa-money\" aria-hidden=\"true\"></i>&ensp;";
                  echo $row5['Coins'];       
                  echo "</td><td style=\"padding: 20px\">";
                  echo "</td></tr>";
                }
                echo "</table>";
        ?>
      </div>
      <hr>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <h2>Join the list.</h2>
          <p>Add your name to the list to play games with me when I am streaming.</p>
          <?php
            echo "<h3>Estimated wait time: ";
            while($row = mysqli_fetch_array($sqldata4, MYSQLI_ASSOC)) {
              $a = $row['COUNT(*)'];
              $b = 9;
              echo "<b>";
              echo $a * $b;
              echo "</b>";
              echo " minutes";
            }
            echo "</h3>";
          ?>
          <?php
            echo "<table class=\".table .table-striped .table-bordered .table-responsive\" style=\"display: inline\">";
            echo "<tr><th style=\"padding: 20px\">Name</th><th style=\"padding: 20px\">Time</th></tr>";
            while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
              echo "<tr>";
              if ($row['Name'] == 'Beorn_619')
              {
                echo "<td style=\"padding: 20px;\">";
                echo"<p style=\"color: green; font-weight: bold; display: inline;\">[Webmaster] </p>";
                echo"<p style=\"color: cyan; font-weight: bold; display: inline;\">[Mod] </p>";
                echo $row['Name'];
                echo "</td>";
              }
              elseif ($row['SteamID'] == '76561198174980565' || $row['SteamID'] == '76561198225591476' || $row['SteamID'] == '76561198322504257')
              {
                echo "<td style=\"padding: 20px;\">";
                echo"<p style=\"color: cyan; font-weight: bold; display: inline;\">[Mod] </p>";
                echo $row['Name'];
                echo "</td>";
              }
              else 
              {
                echo "<td style=\"padding: 20px;\">";
                echo $row['Name'];
                echo "</td>";
              }
              echo "<td style=\"padding: 20px\">";
              echo $row['Date'];
              echo "</td>";
            }
            echo "</table>";
          ?>
          <br><br><br>
          <?php
            session_start();
            include ('steamauth/userInfo.php');
            $row = mysqli_fetch_array($sqldata6, MYSQLI_ASSOC);
            $row2 = mysqli_fetch_array($sqldata7, MYSQLI_ASSOC);
            $userna = $steamprofile['personaname'];
            $fee = '100';

            require 'steamauth/steamauth.php';

            if(isset($_SESSION['steamid'])) 
            {
              if($row['Ban'] == '2')
              {
                echo "<div class=\"alert alert-danger\" role=\"alert\">";
                echo "<p>You have been banned from signing up to the list. If you think this is a problem, please contract Luis.</p>";
                echo "</div>";
              }
              if($row2['Name'] == $userna) {
                  echo "<form id='name' action='process10.php' method='post' accept-charset='UTF-8'>";
                  echo "<fieldset>";
                  echo "<button class=\"btn btn-lg btn-danger btn-block animated zoomIn\" type=\"submit\" value=\"Submit\">";
                  echo $steamprofile['personaname'];
                  echo ", Remove Your Name</button>";
                  echo "</fieldset>";
                  echo "</form>";
                  echo "<div class=\"alert alert-info\" role=\"alert\">";
                  echo "<p><a href=\"https://steamcommunity.com/tradeoffer/new/?partner=172467468&token=3jj67qJB\" target=\"_blank\">Get more points by donating skins to luis on the official donation bot! Donate Here!</a></p>";
                  echo "</div>";
                  echo "<div class=\"alert alert-success\" role=\"alert\">";
                  echo "<p style='display: inline'>Users who donate over $1 in skins get a special <p style='color: purple; font-weight: bold; display: inline'>[Donator]</p> Tag</p>";
                  echo "</div>";
                  }
              if($row2['Name'] != $userna){
              if($row['Coins'] == 50) {
                echo "<form id='name' action='process.php' method='post' accept-charset='UTF-8'>";
                echo "<fieldset>";
                echo "<button class=\"btn btn-lg btn-primary btn-block animated zoomIn\" type=\"submit\" value=\"Submit\">";
                echo $steamprofile['personaname'];
                echo ", Add Your Name For <i class=\"fa fa-money\" aria-hidden=\"true\"></i> 50</button>";
                echo "</fieldset>";
                echo "</form>"; 
                echo "<div class=\"alert alert-info\" role=\"alert\">";
                echo "<p><a href=\"https://steamcommunity.com/tradeoffer/new/?partner=172467468&token=3jj67qJB\" target=\"_blank\">Get more points by donating skins to luis on the official donation bot! Donate Here!</a></p>";
                echo "</div>";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "<p style='display: inline'>Users who donate over $1 in skins get a special <p style='color: purple; font-weight: bold; display: inline'>[Donator]</p> Tag</p>";
                echo "</div>";
              }
              if($row['Coins'] > 50){
                echo "<form id='name' action='process.php' method='post' accept-charset='UTF-8'>";
                echo "<fieldset>";
                echo "<button class=\"btn btn-lg btn-primary btn-block animated zoomIn\" type=\"submit\" value=\"Submit\">";
                echo $steamprofile['personaname'];
                echo ", Add Your Name For <i class=\"fa fa-money\" aria-hidden=\"true\"></i> 50</button>";
                echo "</fieldset>";
                echo "</form>";    
                echo "<div class=\"alert alert-info\" role=\"alert\">";
                echo "<p><a href=\"https://steamcommunity.com/tradeoffer/new/?partner=172467468&token=3jj67qJB\" target=\"_blank\">Get more points by donating skins to luis on the official donation bot! Donate Here!</a></p>";
                echo "</div>";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "<p style='display: inline'>Users who donate over $1 in skins get a special <p style='color: purple; font-weight: bold; display: inline'>[Donator]</p> Tag</p>";
                echo "</div>";
                
                } 

              if($row['Coins'] < 50) {
                echo "<div class=\"alert alert-danger\" role=\"alert\">";
                echo "<p>You need at least <i class=\"fa fa-money\" aria-hidden=\"true\"></i> 50 to sign up for the list!</p>";
                echo "</div>";
                echo "<div class=\"alert alert-info\" role=\"alert\">";
                echo "<p><a href=\"https://steamcommunity.com/tradeoffer/new/?partner=172467468&token=3jj67qJB\" target=\"_blank\">Get more points by donating skins to luis on the official donation bot! Donate Here!</a></p>";
                echo "</div>";
                echo "<div class=\"alert alert-success\" role=\"alert\">";
                echo "<p style='display: inline'>Users who donate over $1 in skins get a special <p style='color: purple; font-weight: bold; display: inline'>[Donator]</p> Tag</p>";
                echo "</div>";
                }
              
              
              if($row['Ban'] != 1 && $row['Ban'] != 2) {
                echo "<form id='name' action='process17.php' method='post' accept-charset='UTF-8'>";
                echo "<fieldset>";
                echo "<button class=\"btn btn-lg btn-primary btn-block animated zoomIn\" type=\"submit\" value=\"Submit\">";
                echo $steamprofile['personaname'];
                echo ", Get 5 Points Free!</button>";
                echo "</fieldset>";
                echo "</form>";
              }
            }}
            else 
            {
              echo "<div class=\"alert alert-danger\" role=\"alert\">";
              echo "<p>Please login with steam to add your name. <a href=\"//www.luisgplays.com/login.php\"> Login here.</a></p>";
              echo "</div>";
            }
          ?>
        </div>
      </div>
      <hr>
      <footer>
        <?php include ('footer.php'); ?>
      </footer>
    </div>
  </body>
</html>
