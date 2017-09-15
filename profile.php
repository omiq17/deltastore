<?php
    require_once 'inside.php';
    require_once 'connect.php';//connect to DB
    $logged_user = $_SESSION['session'];
    
    $query = " Select * From foreman WHERE f_username ='$logged_user' ";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);

?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Delta Store</title>
    <link rel="icon" href="images/fav.png" type="image/png">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
       <link rel="stylesheet" href="css/home.css">
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  </head>
<body>
<?php include_once("analyticstracking.php") ?>
<!--------------------Start main container div--------->
<div class="container"> 
                 <!-------Start Header div-->
  <div class="row header">
        <div class="col-md-6">
            <img src="images/logo.png" alt="">
        </div>
         <div class="col-md-6 nav">
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
    <!------------end of header div--> 
    <div class='pro'>
       <h1>Profile</h1>
            <?php                                 
                if(isset($_SESSION['suc']) && !empty($_SESSION['suc'])) {
                    echo "<p style='color:green;font-size:17px;
                                        padding-bottom:15px'>
                              Successfully Updated Your Profile.</p>"; 
                    unset($_SESSION['suc']);
                }
                 else if(isset($_SESSION['sucp']) && !empty($_SESSION['sucp'])) {
                    echo "<p style='color:green;font-size:17px;
                                        padding-bottom:15px'>
                              Successfully changed your password.</p>"; 
                    unset($_SESSION['sucp']);
                }
                
            ?> 
        <p><b>First name : </b> <?php echo $row['f_firstname'] ?></p>
        <p><b>Last name : </b> <?php echo $row['f_lastname'] ?></p>
        <p><b>Username : </b> <?php echo $row['f_username'] ?></p>
        <p><b>Email : </b> <?php echo $row['f_email'] ?></p>
        <p><b>Store name : </b> <?php echo $row['f_storename'] ?></p>   
        <a href="editprofile.php" class="btn btn-primary" role="button">Change Profile Info</a>
        <a href="editpass.php" class="btn btn-primary" role="button">Change Password</a>
    </div>
    <!------------end of header div--> 
</div><!--end of main container div-->   

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
