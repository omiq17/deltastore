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
                        <li class="active"><a href="features.php">Features</a></li>
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
    
    <div class="features">
       <h3>Main Features</h3>
        <p>&#9755; Deltastore is a virtual store in web. It is a web based sofrware to grow our own store in web. It acts as a cashier of your store.</p>
        <p>&#9755; The design of the website has been kept as simple as possible so that users can easily understand all the features easily and use it simply.</p>
        <h3>Things you can do</h3>
        <p>&#9755; You can keep track of your products,customers,invoices with Deltastore.</p>
        <p>&#9755; You can make invoices easily and print out to your customer.</p>
        <p>&#9755; You can also see your monthly sale.</p>
        <h3>Uses</h3>
        <p>&#9755; At first you have register to create an account.</p>
        <p>&#9755; Then you have to login to enter your account. By successful login you will be entered into your dashboad.</p>
        <p>&#9755; You can see your store's total no. of catagory,product,customer and invoice. You can also see your daily &amp; monthly sale (with vat).</p>
        <p>&#9755; At first you have to add catagories in catagory section.</p>
        <p>&#9755; In product section you have to add products of your store. You have to select catagory of your product and give a unit price of the product.</p>
        <p>&#9755; When customers will come to your store, you can add them in the catagory section by adding their name and phone no.</p>
        <p>&#9755; If customers buy something you can add them as orders one by one in the order section. </p>
        <p>&#9755; Now its time to give an invoice to your customer. In order section you have to checked the orders that belongs to that customer(Remember that you can select orders that belongs to same customer). You can also add a vat. Then you have to click create invoice. </p>
        <p>&#9755; After creating invoice you will redirect to invoice section. You have to type the number of your invoice and click show invoice.</p>
        <p>&#9755; In a new page you can see the invoice with all the information. You can also print this page by clicking print this page.(Make sure your turned on background images/graphics in print option.)</p>
        <p>&#9755; Now comes to delete options.</p>
        <p>&#9755; You can delete invoices as your wish. But if you delete invoice the total ammount in the invoice will not be counted in your daily or monthly sale.</p>
        <p>&#9755; If you want to delete an order you have to delete the invoice first that belongs that order.</p>
        <p>&#9755; You can delete customers as your wish. But if you delete any customer, his/her all information, orders and invoices will deleted.</p>
        <p>&#9755; If you want to delete a product you have to make sure you delete the order/orders that belongs the product.</p>
        <p>&#9755; If you want to delete a catagory you have to make sure that you delete the product/products that belongs the catagory. But if you delete any catagory all the product/products belongs to it orders will be deleted.</p>
        <p>&#9996; Now you are all set to go!!!</p>
    </div>
    <!--end of features div-->
    
</div><!--end of main container div-->
    
  </body>
</html>