<?php
  session_start();
  require 'steamauth/steamauth.php';
  $servername = "...";
  $username = "...";
  $password = "...";
  $dbname = "...";

  if ($_SESSION['login_user'] == "luisgplays") 
  {
    echo "";
  }
  else 
  {
    echo "<meta http-equiv=\"refresh\" content=\"0;url=//www.luisgplays.com/login.php\" />";
  }


  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  $sqlget = "SELECT * FROM Players ORDER BY Date";
  $sqldata = mysqli_query($conn, $sqlget) or die('error getting data');

  $sqlget2 = "SELECT * FROM Desciption ORDER BY Date DESC LIMIT 3";
  $sqldata2 = mysqli_query($conn, $sqlget2) or die('error getting data');

  $sqlget3 = "SELECT * FROM Stream ORDER BY Time DESC LIMIT 3";
  $sqldata3 = mysqli_query($conn, $sqlget3) or die('error getting data');

  $sqlget4 = "SELECT COUNT(*) FROM Players";
  $sqldata4= mysqli_query($conn, $sqlget4) or die('error getting data');

  $sqlget5 = "SELECT * FROM MasterList ORDER BY ID";
  $sqldata5 = mysqli_query($conn, $sqlget5) or die('error getting data');

  $sqlget8 = "SELECT * FROM Log ORDER BY Time DESC LIMIT 10";
  $sqldata8 = mysqli_query($conn, $sqlget8) or die('error getting data');

  $sqlget9 = "SELECT * FROM Codes ORDER BY ID DESC LIMIT 1";
  $sqldata9 = mysqli_query($conn, $sqlget9) or die('error getting data');

  $conn->close();
?>

<html>
  <head>
    <?php include ('header.php'); ?>
    <meta http-equiv="refresh" content="60;url=//www.luisgplays.com/dashboard.php" />
  </head>
    <body>
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">LuisGPlays</a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav" style="float: right">
              <li style="float: right"><a href="logout.php">Logout</a></li>
            </ul>
          </div>
        </div>
      </nav>
      <?php include ('scroll.php'); ?>
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <hr>
            <div>
              <h2>List</h2>
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
                echo "<table>";
                echo "<tr><th style=\"padding: 20px\">ID</th><th style=\"padding: 20px\">Name</th><th style=\"padding: 20px\">Time</th><th style=\"padding: 20px\">SteamID</th></tr>";

                while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {
                  echo "<tr><td style=\"padding: 20px\">";
                  echo $row['ID'];
                  echo "</td>";
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
                  echo "</td><td style=\"padding: 20px\">";
                  echo "<a target=\"_blank\"  href=\"http://steamcommunity.com/profiles/";
                  echo $row['SteamID'];
                  echo "\">Profile</a>";
                  echo "</td><td style=\"padding: 20px\">";
                }

                echo "</table>";
              ?>
<!--
              <form id='name' action='process2.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="name" placeholder="Add Name" id="name" maxlength="30" required/>
                  <button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Add Name</button>  
                </fieldset>
              </form>
-->
              <form id='name' action='process3.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="id" placeholder="Remove By ID" id="id" maxlength="30" required/>
                  <button class="btn btn-lg btn-danger btn-block" type="submit" value="Submit">Remove Name And Take <i class="fa fa-money" aria-hidden="true"></i></button>  
                </fieldset>
              </form>
              <form id='name' action='process31.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="id" placeholder="Remove By ID" id="id" maxlength="30" required/>
                  <button class="btn btn-lg btn-info btn-block" type="submit" value="Submit">Remove Name And Refund <i class="fa fa-money" aria-hidden="true"></i></button>  
                </fieldset>
              </form>
<!--
              <form id='name' action='process4.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="name" placeholder="Add Name To Top" id="name" maxlength="30" required/>
                  <button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Add Name To Top</button>  
                </fieldset>
              </form>
-->
<!--
              <form id='name' action='process5.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <button class="btn btn-lg btn-danger btn-block" type="submit" value="Submit">Remove Top Name</button>  
                </fieldset>
              </form>
-->
<!--
              <form id='name' action='process6.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <button class="btn btn-lg btn-danger btn-block" type="submit" value="Submit">Remove All</button>  
                </fieldset>
              </form>
-->
            </div>
            <hr>
            <div>
              <h2>Codes</h2>
              <?php
                echo "<table>";
                echo "<tr><th style=\"padding: 20px\">Notification</th><th>Worth</th><th style=\"padding: 20px\">Daily</th><th>Worth</th><th style=\"padding: 20px\">End Of Stream</th><th>Worth</th><th style=\"padding: 20px\">Giveaway</th><th>Worth</th></tr>";

                while($row = mysqli_fetch_array($sqldata9, MYSQLI_ASSOC)) {
                  echo "<tr><td style=\"padding: 20px\">";
                  echo $row['NotificationNation'];
                  echo "</td><td>";
                  echo $row['NCoins'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['Daily'];
                  echo "</td><td>";
                  echo $row['DCoins'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['EndOfStream'];
                  echo "</td><td>";
                  echo $row['ECoins'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['Giveaway'];
                  echo "</td><td>";
                  echo $row['GCoins'];
                  echo "</td></tr>";
                }

                echo "</table>";
              ?>
              <form id='text' action='codes.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="NNC" placeholder="Add Notification Code" id="NNC" maxlength="500" style="padding:15px"/>
                  <select class="1-100" id="NNCA" name="NNCA"></select><br>
                  <input type="text" class="form-control" name="DC" placeholder="Add Daily Code" id="DC" maxlength="500" style="padding:15px"/>
                  <select class="1-100" id="DCA" name="DCA"></select><br>
                  <input type="text" class="form-control" name="EOSC" placeholder="Add End Of Stream Code" id="EOSC" maxlength="25" style="padding:15px"/>
                  <select class="1-100" id="EOSCA" name="EOSCA"></select><br>
                  <input type="text" class="form-control" name="GC" placeholder="Add Giveaway Code" id="GC" maxlength="25" style="padding:15px"/>
                  <select class="1-100" id="GCA" name="GCA"></select><br>
                  <button class="btn btn-lg btn-success btn-block" type="submit" value="Submit" style="padding:15px">Add Codes</button>  
                </fieldset>
              </form>
              <form id='text' action='codes2.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <button class="btn btn-lg btn-danger btn-block" type="submit" value="Submit" style="padding:15px">Reset Uses</button>  
                </fieldset>
              </form>
            </div>
            <hr>
            <div>
              <h2>Stream</h2>
              <?php
                echo "<table>";
                echo "<tr><th style=\"padding: 20px\">Date</th><th style=\"padding: 20px\">Desciption</th><th style=\"padding: 20px\">Skin Link</th></tr>";

                while($row = mysqli_fetch_array($sqldata3, MYSQLI_ASSOC)) {
                  echo "<tr><td style=\"padding: 20px\">";
                  echo $row['Date'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['Text'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['Skin'];
                  echo "</td></tr>";
                }

                echo "</table>";
              ?>
              <form id='text' action='process9.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="text" placeholder="Add Text" id="text" maxlength="500" required/>
                  <input type="text" class="form-control" name="skin" placeholder="Add Skin Link Bit.ly ONLY" id="skin" maxlength="25" required/>
                  <button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Add Skin</button>  
                </fieldset>
              </form>
            </div>
            <hr>
            <div>
              <h2>Description</h2>
              <?php
                echo "<table>";
                echo "<tr><th style=\"padding: 20px\">Date</th><th style=\"padding: 20px\">Desciption</th></tr>";

                while($row = mysqli_fetch_array($sqldata2, MYSQLI_ASSOC)) {
                  echo "<tr><td style=\"padding: 20px\">";
                  echo $row['Date'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['Text'];
                  echo "</td></tr>";
                }

                echo "</table>";
              ?>
              <form id='text' action='process8.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="text" placeholder="Change Descrpition" id="text" maxlength="500" required/>
                  <button class="btn btn-lg btn-primary btn-block" type="submit" value="Submit">Change Text</button>  
                </fieldset>
              </form>
            </div>
            <hr>
            <div>
              <h2>Master List</h2>
              <?php
                $num = 2;
                echo "<table>";
                echo "<tr><th style=\"padding: 20px\">ID</th><th style=\"padding: 20px\">Name</th><th style=\"padding: 20px\">SteamID</th><th style=\"padding: 20px\">Coins</th><th style=\"padding: 20px\">Ban Status</th></tr>";

                while($row = mysqli_fetch_array($sqldata5, MYSQLI_ASSOC)) {
                  echo "<tr><td style=\"padding: 20px\">";
                  echo $row['ID'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo $row['Name'];
                  echo "</td><td style=\"padding: 20px\">";
                  echo "<a target=\"_blank\"  href=\"http://steamcommunity.com/profiles/";
                  echo $row['SteamID'];
                  echo "\">Profile</a>";
                  echo "<td style=\"padding: 20px\">";
                  echo "<i class=\"fa fa-money\" aria-hidden=\"true\"></i>";
                  echo $row['Coins'];       
                  echo "</td><td style=\"padding: 20px\">";

                  if ($row['Ban'] == $num )
                  {
                    echo "<span class=\"label label-danger\">Banned</span>";
                  }
                  else 
                  {
                    echo "<span class=\"label label-info\">Not Banned</span>";
                  }

                  echo "</td></tr>";
                }

                echo "</table>";
              ?>
              <form id='name' action='ban.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="name" placeholder="Ban By ID" id="name" maxlength="30" required/>
                  <button class="btn btn-lg btn-danger btn-block" type="submit" value="Submit">Ban</button>  
                </fieldset>
              </form>
              <form id='name' action='ban2.php' method='post' accept-charset='UTF-8'>
                <fieldset>
                  <input type="text" class="form-control" name="name" placeholder="Un Ban By ID" id="name" maxlength="30" required/>
                  <button class="btn btn-lg btn-info btn-block" type="submit" value="Submit">Un Ban</button>  
                </fieldset>
              </form>
            </div>
            <div>
              <?php
            echo "<table class=\".table .table-striped .table-bordered .table-responsive\" style=\"display: inline; padding-top: 30px\">";
            echo "<tr><th style=\"padding: 20px\">Time</th><th style=\"padding: 20px\">Log</th></tr>";
            while($row = mysqli_fetch_array($sqldata8, MYSQLI_ASSOC)) {
              echo "<tr>";
              echo "<td style=\"padding: 20px; color: grey\">";
              echo $row['Time'];
              echo "</td>";
              echo "<td style=\"padding: 20px; color: grey\">";
              echo $row['Message'];
              echo "</td>";
            }
            echo "</table>";
          ?>
            </div>
          </div>
        </div>
        <hr>
        <footer>
          <?php include ('footer.php'); ?>
        </footer>
      </div>
  </body>
</html>