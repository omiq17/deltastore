<?php
require_once "inside.php";
// if(!empty($_SESSION['session']))
    // $logged_user = $_SESSION['session'];
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DeltaStore</title>
       <link rel="icon" href="images/fav.png" type="image/png">

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
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="features.php">Features</a></li>
                        <li><a href="login.php">Log In</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
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
         <div class="row jumbotron">
            <h1>Manage Your Store</h1>      
            <p>Delta Store is a simple Store Management System. It       
                keeps track of your products,customers and your whole bussiness in one place.
                You can make invoices and provide it to your customers easily.</p>
                <a href="login.php" class="btn btn-success btn-lg">&#x27b2; Register &amp; Start Now</a>
          </div>
          
       <div class="row section">
          <div class="col-md-7">
              <img src="images/img1.jpg" class="img-rounded" alt="Cinque Terre" 
                  width="655" height="280">   
          </div>
          <div class="col-md-5">
              <img src="images/inv.jpg" class="img-rounded" alt="Cinque Terre" 
                  width="487" height="280">   
          </div>
       </div><!--end of section div-->
       <div class="row jumbotron">
           <h2><b>Want To Buy DeltaStore?</b></h2>      
            <p>You can buy the whole software &amp; run it into your own computer or laptop. To buy  DeltaStore with a reasonable price contact to our developers now!!!</p>
                <a href="contact.php" class="btn btn-success btn-lg">&#x27b2; Contact Us</a>
          </div>
    
    <div class="footer">
            <div class="well" style="text-align:center;">A Software by xTeem Technology. 
                All Rights Reserved.</div>
	</div><!--end of footer div-->
    
</div><!--end of main container div-->
    
  </body>
</html>