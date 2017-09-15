<?php
    require_once 'inside.php';
    require_once 'connect.php';//connect to DB
    $logged_user = $_SESSION['session'];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DeltaStore</title>
    <link rel="icon" href="images/fav.png" type="image/png">
    <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="css/home.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
       <script src="js/bootstrap.min.js"></script>
  </head>
<body>
<div class="container"> <!--------------------Start main container div--------->
                 <!-------Start Header div-->
  <div class="row header">
        <div class="col-md-6">
            <img src="images/logo.png" alt="">
        </div>
         <div class="col-md-6">
              <div class="bs-example">
                    <ul class="nav nav-pills  ">
                        <li ><a href="index.php">Home</a></li>
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
                                              </ul> 
                                        </div>";
                                    }
                               ?>
                        </li>
                    </ul>
                </div>
            </div>
    </div>           <!------------end of header div-->
                 
                                <!--start Register In form-->
    <form class="form-horizontal reg-form" action="passUp.php"
                      method="post">
            <?php                                 
                if(isset($_SESSION['fill']) && !empty($_SESSION['fill'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                              Please Fill Up all the fields.</p>"; 
                    unset($_SESSION['fill']);
                }
                else if(isset($_SESSION['wrong']) && !empty($_SESSION['wrong'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                              Your current password is wrong.</p>"; 
                    unset($_SESSION['wrong']);
                }
                else if(isset($_SESSION['wrongn']) && !empty($_SESSION['wrongn'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                              Your new password not matched..</p>"; 
                    unset($_SESSION['wrongn']);
                }
            ?>     
          <div class="form-group">
                <label for="inputPassword3" class="col-md-2 control-label">Current Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" id="inputPassword3"
                               placeholder="Password" name="password1" maxlength="32">
            </div>
          </div>
        <div class="form-group">
                <label for="inputPassword3" class="col-md-2 control-label">New Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" id="inputPassword3"
                               placeholder="Password" name="password2" maxlength="32">
            </div>
          </div> 
        <div class="form-group">
                <label for="inputPassword3" class="col-md-2 control-label">
                                Confirm New Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" id="inputPassword3"
                               placeholder="Password" name="password3" maxlength="32">
            </div>
          </div>
         <div class="form-group">
                <div class="col-sm-offset-2 col-md-10">
                  <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
          </div>
    </form>
                              <!--End Regiter form-->
	                              <!--end of footer div-->    
</div><!--end of main container div-->   

</body>
</html>
