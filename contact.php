<?php
require_once "inside.php";
?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DeltaStore</title>

       <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="css/home.css">
       
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  <?php include_once("analyticstracking.php") ?>
   <div class="container"> <!--main container div-->
        <!--    <?php 
            if(!empty($_SESSION['session'])){
                $logged_user = $_SESSION['session'];
                echo "<p class='loggedin'>Hi, 
                <strong>".$logged_user."</strong>
                <a href='admin/admin.php' style='color:#34495e;'><b>Dashboard</b></a>
                <a href='profile.php' style='color:#34495e;'><b>Profile</b></a>
                <a href='logout.php' style='color:red;'><b>Logout</b></a>
                </p>";
            }
       ?>    -->
                     <!-------------------header & Navbar div-------------------->
  <div class="row header">
        <div class="col-md-6">
            <img src="images/logo.png" alt="">
        </div>
         <div class="col-md-6">
              <div class="bs-example">
                    <ul class="nav nav-pills  ">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="features.php">Features</a></li>
                        <li><a href="login.php">Log In</a></li>
                        <li class="active"><a href="contact.php">Contact Us</a></li>
                        <li>
                             <?php 
                                    if(!empty($_SESSION['session'])){
                                        $logged_user = $_SESSION['session'];
                                        echo "<div class='dropdown profile'>
                                            <button class='btn btn-primary dropdown-toggle' type='button' 
                                                                data-toggle='dropdown'>
                                                Hi, <strong>".$logged_user."</strong>&nbsp;
                                              <span class='caret'></span>
                                              </button>
                                              <ul class='dropdown-menu'>
                                                <li><a href='profile.php'>Profile</a></li>
                                                <li><a href='admin/admin.php'>Dashboard</a></li>
                                                <li><a href='logout.php'>Logout</a></li>
                                              </ul> 
                                        </div>";
                                    }
                               ?>
                        </li>
                    </ul>
                </div>
            </div>
    </div><!--end of header div-->
    
    <div class="contact">
      <h1>Contact us</h1>
      <p>A software by <a href="xteem.net" target="_blank"><b>xTeem Technology</b></a></p>
      <p>&#9993; minion@xteem.net</p>
      <p>&#9742; +88018 5588 6064</p>
        <p><a target="_blank" title="find us on Facebook" href="http://www.facebook.com/XTeemTechnology"><img alt="find us on facebook" src="images/find-us-on-facebook-badge.png" border=0></a></p>
       
    </div>
    <!--end of features div-->
    
</div><!--end of main container div-->
    
  </body>
</html>