<?php
session_start();

if ($_SESSION['login_user'] == "luisgplays")
{
    echo "<meta http-equiv=\"refresh\" content=\"0;url=https://www.luisgplays.com/dashboard.php\"/>";
}

?>
<html>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    @import "bourbon";

    body {
        background: #eee !important;	
    }

    .wrapper {	
        margin-top: 80px;
      margin-bottom: 80px;
    }

    .form-signin {
      max-width: 380px;
      padding: 15px 35px 45px;
      margin: 0 auto;
      background-color: #fff;
      border: 1px solid rgba(0,0,0,0.1);  

      .form-signin-heading,
        .checkbox {
          margin-bottom: 30px;
        }

        .checkbox {
          font-weight: normal;
        }

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

        input[type="text"] {
          margin-bottom: -1px;
          border-bottom-left-radius: 0;
          border-bottom-right-radius: 0;
        }

        input[type="password"] {
          margin-bottom: 20px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    }  
  </style>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>LuisGPlays</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-frontpage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
  <body>
      <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">LuisGPlays</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav" style="float: right">
                        <li style="float: right"><a href="login.php">Login</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
    <?php include ('scroll.php'); ?>
    <div class="wrapper">
        <form class="form-signin" action="process7.php" method="post">       
            <h2 class="form-signin-heading">Please login</h2>
            <input type="text" class="form-control" name="user" placeholder="Username" id="user" required/>
            <input type="password" class="form-control" name="pass" placeholder="Password" id="pass" required/>      
            <button class="btn btn-lg btn-primary btn-block" type="submit" value="Login">Login</button>   
        </form>
    </div>
      <?php

      require 'steamauth/steamauth.php';
      if(!isset($_SESSION['steamid'])) {

      echo "<div align=\"center\">";
      loginbutton("rectangle"); //login button
      echo "</div>";
        }  else {

            echo "<meta http-equiv=\"refresh\" content=\"0;url=http://www.beorn.top/luis/index.php/>";

            
        }   

      ?>
  </body>
</html>