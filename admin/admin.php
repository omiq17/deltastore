<?php
require_once "../connect.php";
require_once "../inside.php";

if(empty($_SESSION['session'])){
	header('Location: ../index.php');
}

else if(!empty($_SESSION['session'])){
        $logged_user = $_SESSION['session'];
        //$row = mysqli_fetch_assoc($result);
     $query1 = "SELECT COUNT(*) FROM catagory WHERE f_username='$logged_user' ";
     $results1 = mysqli_query($link, $query1);
     $row1 = mysqli_fetch_array($results1,MYSQLI_NUM);
     $query2 = "SELECT COUNT(*) FROM product WHERE f_username='$logged_user' ";
     $results2 = mysqli_query($link,$query2);
     $row2 = mysqli_fetch_array($results2,MYSQLI_NUM);
     $query3 = "SELECT COUNT(*) FROM customer WHERE f_username='$logged_user' ";
     $results3 = mysqli_query($link, $query3);
     $row3 = mysqli_fetch_array($results3,MYSQLI_NUM);
     $query4 = "SELECT COUNT(*) FROM customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id ";
     $results4 = mysqli_query($link, $query4);
     $row4 = mysqli_fetch_array($results4,MYSQLI_NUM);
     //get Monthly income
      if(isset($_SESSION['sum'])){
                        $date = $_SESSION['date'];
                        $sum = $_SESSION['sum'];
                        $date = date('F-Y', strtotime($date));
                        //echo $date;
                        unset($_SESSION['sum']);
                        unset($_SESSION['date']);
                    }
     else{
         //get Current Date
         $query5 = "SELECT  DATE_FORMAT(NOW() ,'%Y-%m-01') ";
         $results5 = mysqli_query($link, $query5);
         $row5 = mysqli_fetch_array($results5,MYSQLI_NUM);
         $firastDay=$row5[0];
         //get Current Date of Month
         $query6 = "SELECT last_day(now()) ";
         $results6 = mysqli_query($link, $query6);
         $row6 = mysqli_fetch_array($results6,MYSQLI_NUM);
         $lastDay=$row6[0];
         $query7 = "SELECT * FROM customer 
                             Inner Join invoice On 
                             customer.f_username='$logged_user' 
                             and customer.cu_id=invoice.cu_id and
                             invoice.i_date BETWEEN '$firastDay' 
                             AND '$lastDay' ";
         $results7 = mysqli_query($link, $query7);
         $sum=0;
          while($row7 = mysqli_fetch_assoc($results7)) {
              $sum= $sum+$row7['i_total_price'];
          }
         $date = date('F-Y');
     }
     ///////////////////////////////get Daily Income//////////////////////////
      if(isset($_SESSION['dsum'])){
                        $dsum = $_SESSION['dsum'];
                        $ddate = $_SESSION['date'];
                        $ddate = date('j F-Y', strtotime($ddate));
                        //echo $date;
                        unset($_SESSION['dsum']);
                        unset($_SESSION['date']);
                    }
     else{
        //get Current Date
         $query8 = "SELECT  DATE_FORMAT(NOW() ,'%Y-%m-%d') ";
         $results8 = mysqli_query($link, $query8);
         $row8 = mysqli_fetch_array($results8,MYSQLI_NUM);
         $Day=$row8[0];
         $query9 = "SELECT * FROM customer 
                             Inner Join invoice On 
                             customer.f_username='$logged_user' 
                             and customer.cu_id=invoice.cu_id and
                             invoice.i_date = '$Day' ";
         $results9 = mysqli_query($link, $query9);
         $dsum=0;
          while($row9 = mysqli_fetch_assoc($results9)) {
              $dsum= $dsum+$row9['i_total_price'];
          }
         $ddate = date("j F-Y");
     }
     //echo 
     
 }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DeltaStore</title>
    <link rel="icon" href="../images/fav.png" type="image/png">
    <!-- Bootstrap Core CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha256-Sk3nkD6mLTMOF0EOpNtsIry+s1CsaqQC1rVLTAy+0yc= sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-MfvZlkHCEqatNoGiOXveE8FIwMzZg4W85qfrfIFBfYc= sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <link href="../css/admin.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <?php include_once("analyticstracking.php") ?>
     <!-------------------header & Navbar div-------------------->
    <div class="row header container-fluid">
        <div class="col-md-8">
            <img src="../images/logo.png" alt="delta store">
        </div>
         <div class="col-md-4 ">
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
                                                <li><a href='../profile.php'>Profile</a></li>
                                                <li><a href='../index.php'>Home</a></li>
                                                <li><a href='../logout.php'>Logout</a></li>
                                              </ul> 
                                        </div>";
                                    }
                               ?>
            </div>
    </div>     
      <!------------------------end of header div----------------------->
      
    <!------------------------Start Section----------------------->
    <div class="container-fluid row section">
    <!------------------------Start Sidebar----------------------->
        <div class ="col-md-3 sidebar">
             <ul class="nav nav-pills nav-stacked">
                 <li role="presentation" class="active"><a href="admin.php">Dashboard
                      </a></li>
                 <li role="presentation"><a href="catagory.php">Catagory</a></li>
                 <li role="presentation"><a href="product.php">
                    Product</a></li>
                 <li role="presentation"><a href="customer.php">Customer</a></li>
                 <li role="presentation"><a href="order.php">Order</a></li>
                 <li role="presentation"><a href="invoice.php">Invoice</a></li>
                 
            </ul>           
        </div>
        <!------------------------end  Sidebar ----------------------->
        <!------------------------start Content----------------------->
        <div class="col-md-9 content">
          <?php 
                    //if user dont check
                    if(isset($_SESSION['dfill']) && !empty($_SESSION['dfill'])){
                        echo "<p style='color:red;'>
                        Please select date.</p>";
                        unset($_SESSION['dfill']);
                    }
           ?>
           <!----- Total catagory and  product---->
           <div class="row">
                <div  class="rcorners1 col-md-4 col-md-offset-1">
                    <h3><strong>Total Catagory</strong></h3>
                    <h1><?php echo $row1[0]; ?></h1></div>
                <div  class="rcorners2 col-md-4 col-md-offset-2" >
                    <h3><strong>Total Product</strong></h3> 
                    <h1><?php echo $row2[0]; ?></h1></div>
          </div>
          <!----- Total customer and invoice---->
          <div class="row">
                <div  class="rcorners1 col-md-4 col-md-offset-1">
                    <h3><strong>Total Customer</strong></h3>
                    <h1><?php echo $row3[0]; ?></h1></div>
                <div  class="rcorners2 col-md-4 col-md-offset-2" >
                    <h3><strong>Total Invoice</strong></h3> 
                    <h1><?php echo $row4[0]; ?></h1></div>
          </div>
          <!----- Sales ---->
          <div class="row">
               <!----- Daily Income---->
                <div  class="rcorners3 col-md-6">
                    <h3><strong>Daily Sale</strong></h3>
                    <h4><strong><?php echo $ddate; ?></strong></h4>
                    <h1><?php echo $dsum; ?> tk.</h1></div>
                    <!----- Monthly Income---->
                    <div  class="rcorners4 col-md-6 col-md-offset-1">
                    <h3><strong>Monthly Sale</strong></h3>
                    <h4><strong><?php echo $date; ?></strong></h4>
                    <h1><?php echo $sum; ?> tk.</h1></div>           
          </div>
                    
          <!----- Forms---->
          <div class="row" style="padding:11px">
                <form class="form-inline col-md-5 col-md-offset-1" method="post"
                                      action="Dgraph.php" >
                      <div class="form-group">
                        <input type="date" name="date">
                      </div>
                      <button type="submit" class="btn btn-primary btn-md">
                                    Show Daily Sale</button>
              </form>
              <form class="form-inline form-inline col-md-5 col-md-offset-1" method="post" action="graph.php" >
                      <div class="form-group">
                         <input type="month" name="date">
                      </div>
                      <button type="submit" class="btn btn-primary btn-md">
                                    Show Monthly Sale</button>
              </form>
          </div>
        <!------------------------end Content----------------------->
    </div>
    </div><!-------------end section------->
    
    

</body>
</html>









