<?php
    require_once 'inside.php';
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>DeltaStore</title>
    <link rel="icon" href="images/fav.png" type="image/png" >
    <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="css/home.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
  </head>
<body>
<?php include_once("analyticstracking.php") ?>
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
                        <li class="active"><a href="login.php">Log In</a></li>
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
    </div>           <!------------end of header div-->
                 <!--------------------Registration Confirmation----------------------->
    <?php 
                if(isset($_SESSION['success']) && !empty($_SESSION['success'])){
                    echo "<p style='color:green;text-align:left;font-size:21px;
                                        padding-top:55px'>
                               <strong>Congratulation.</strong> You have successfully registered to 
                               <strong>Delta Store.</strong>
                               Now Log Into your account.</p>"; 
                    unset($_SESSION['success']);
                }

             ?>
                        <!------------Check if user Logged In or Not-->
       <?php 
            if(!empty($_SESSION['session'])){
                $logged_user = $_SESSION['session'];
                echo "<p class='loggedin_login'>You are already logged as  
                <strong>".$logged_user."</strong>. Please logout first</p>";
                die();
            }
       ?>
        <!-----------------start Log In form------------------>
     <form class="logForm form-horizontal" action="logincheck.php"
               method="post">
                    <!-----------------For Wrong Username And Password
                        For Not fill all the field----For Evething Wrong-------------------------->
         <?php 
                if(isset($_SESSION['invalidpassword']) && !empty($_SESSION['invalidpassword']) ){
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Invalid Username or Password</p>"; 
                    unset($_SESSION['invalidpassword']);
                }

                else if(isset($_SESSION['invalid']) && !empty($_SESSION['invalid'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Give Username or Password</p>"; 
                    unset($_SESSION['invalid']);
                }
                    
                else if(isset($_SESSION['fill']) && !empty($_SESSION['fill'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Fill Up all the fields in registration form</p>"; 
                    unset($_SESSION['fill']);
                }
                    
                else if(isset($_SESSION['pass']) && !empty($_SESSION['pass'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Password Not Matched</p>"; 
                    unset($_SESSION['pass']);
                }

                else if(isset($_SESSION['usermatched']) && !empty($_SESSION['usermatched'])) {
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Username Already Exists. Please Try Another Username.</p>"; 
                    unset($_SESSION['usermatched']);
                }

            
             ?>
         <div class = "row">
            <p class="bg-primary col-md-4">Existing User? Log Into Your Account</p>
        </div>
          <div class="form-group">
                <label class="col-md-2 control-label">Username</label>
                <div class="col-sm-4">
                  <input class="form-control"  id="inputEmail3" name="username"
                         placeholder="Username" maxlength="15"> 
                </div>
          </div>
          <div class="form-group">
                <label for="inputPassword3" class="col-md-2 control-label">Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" id="inputPassword3"
                               placeholder="Password" name="password" maxlength="32">
            </div>
          </div>
          <div class="form-group">
                <div class="col-sm-offset-2 col-md-10">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox"> Remember me
                    </label>
                  </div>
                </div>
          </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-md-10">
                  <button type="submit" class="btn btn-default">Log in</button>
                </div>
          </div>
     </form>
                                 <!--end Of LOg in form-->
                                <!--start Register In form-->
    <form class="form-horizontal reg-form" action="registration.php"
                      method="post">     
        <div class = "row">
            <p class="bg-primary col-md-4"> New User? Register Now</p>
        </div>
          <div class="form-group form-group-md">
                <label class="col-md-2 control-label">First Name</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" 
                         placeholder="First Name" maxlength="32" name="firstname">
                </div>
          </div>
        <div class="form-group form-group-md">
                <label class="col-md-2 control-label">Last Name</label>
                <div class="col-sm-6">
                  <input class="form-control" type="text" 
                         placeholder="Last Name" maxlength="32" name="lastname">
                </div>
          </div>
          <div class="form-group form-group-md">
            <label class="col-md-2 control-label">Username</label>
                <div class="col-sm-6">
                  <input class="form-control" type="text" 
                         placeholder="Username" maxlength="15" name="username">
                </div>
          </div> 
        <div class="form-group form-group-md">
                <label class="col-md-2 control-label">Email</label>
                <div class="col-md-6">
                  <input type="email" class="form-control"  
                         placeholder="Email" maxlength="32" name="email">
                </div>
          </div>
        <div class="form-group form-group-md">
                <label class="col-md-2 control-label">Password</label>
                <div class="col-md-6">
                  <input class="form-control" type="password" 
                         placeholder="Password" maxlength="32" name="password">
                </div>
          </div>
        <div class="form-group form-group-md">
                <label class="col-md-2 control-label">Confirm Password</label>
                <div class="col-sm-6">
                  <input class="form-control" type="password" 
                         placeholder="Confirm Password" maxlength="32" name="confirmpassword">
                </div>
          </div>
        <div class="form-group form-group-md">
                <label class="col-md-2 control-label">Your Store Name</label>
                <div class="col-md-6">
                  <input class="form-control" type="text" 
                         placeholder="Your Store Name" maxlength="32" name="storename">
                </div>
          </div>
         <div class="form-group">
                <div class="col-sm-offset-2 col-md-10">
                  <button type="submit" class="btn btn-default">Register</button>
                </div>
          </div>
    </form>
                              <!--End Regiter form-->
                              <!----Start footer div-->
    <div class="footer">
            <div class="well">A Delta Corporation Production. 
                All Rights Reserved.</div>
	</div>
	                              <!--end of footer div-->    
</div><!--end of main container div-->   

</body>
</html>
