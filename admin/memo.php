<?php
require_once "../connect.php";
require_once "../inside.php";
$ino=$_SESSION['ino'];
//unset($_SESSION['ino']);
 if(!empty($_SESSION['session'])){
        $logged_user = $_SESSION['session'];
        $query = " select invoice_dt.i_id, invoice_dt.o_id, order.o_id, 
                         order.p_id, order.o_price, order.o_ammount,
                         product.p_id, product.p_name, product.p_price
                         from invoice_dt 
                         Inner Join `order` 
                         Inner Join product On
                         invoice_dt.i_id = $ino 
                         and order.o_id = invoice_dt.o_id
                         and product.p_id = order.p_id ";
        $result = mysqli_query($link, $query);
     
        $query2 =" select *
                         from invoice 
                         Inner Join customer On
                         invoice.i_id = $ino 
                         and customer.cu_id = invoice.cu_id ";
        $result2 = mysqli_query($link, $query2);
        $row2 = mysqli_fetch_assoc($result2);
     
        $query3 =" select foreman.f_storename
                         from foreman
                         WHERE foreman.f_username = '$logged_user' ";
        $result3 = mysqli_query($link, $query3);
        $row3 = mysqli_fetch_assoc($result3);
 }

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Delta Store</title>
    <link rel="icon" href="../images/fav.png" type="image/png">
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
    <link href="../css/memo.css" rel="stylesheet" >
    <link href="../css/memo1.css" rel="stylesheet" type="text/css" media="print" >

    
    <body>
       <!-------------------Main-------------------->
       <main class="container" >
       <!-------------------header-------------------->
            <div class="row header">
                <div class="col-xs-8">
                </div>
                <div class="col-xs-4">
                    <h2><?php echo $row3['f_storename'] ?></h2>
                    <!--     <p>Address</p>        -->
                </div>
            </div>
            <!-------------------Section-------------------->
            <div class="row section">
                <div class="col-xs-4">
                <h1>INVOICE</h1>
                <h4>BILL TO</h4>
                <ul style="list-style-type:none">
                      <li><?php echo $row2['cu_name'] ?></li>
                      <li><?php echo $row2['cu_phone'] ?></li>
                </ul>
                </div>
                <div class="col-xs-8">
                     <ul style="list-style-type:none">
                          <li>INVOICE #<?php echo $ino; ?></li>
                          <li><?php echo $row2['i_date'] ?></li>
                    </ul>               
                </div>
            </div>
            <!-------------------Content-------------------->
            <div class="row content">
                <table class="table">
                        <thead>
                         <tr>
                           <th>#</th>
                            <th>Item Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php    
                                $count=1;
                                while($row = mysqli_fetch_assoc($result)) {
                                    print '<tr>';
                                    print '<td>'.$count.'</td>';
                                    print '<td>'.$row['p_name'].'</td>';
                                    print '<td>'.$row['p_price'].' tk'.'</td>';
                                    print '<td>'.$row['o_ammount'].'</td>';
                                    print '<td>'.$row['o_price'].' tk'.'</td>';
                                    print '</tr>';
                                    $count++;
                                }
                              ?>  
                          </tbody>
                    </table>
            </div>
            <!-------------------Footer-------------------->
            <div class="row footer">
               <div class="col-xs-5">
               </div>
               <div class="col-xs-4">
                <ul style="list-style-type:none">
                      <li>Subtotal</li>
                      <li>Vat</li>
                      <li>Grand Total</li>
                </ul>               
               </div>
               <div class="col-xs-3">
                <ul style="list-style-type:none">
                     <?php 
                        $vat = ( $row2['i_total_price']-$row2['i_sub_total'] );
                    ?>
                      <li><?php echo $row2['i_sub_total'] ?> tk</li>
                      <li><?php echo '('.$row2['i_vat'].'%)'.$vat ?> tk</li>
                      <li><?php echo $row2['i_total_price'] ?> tk</li>
                </ul>               
               </div> 
            </div>
            <!-------------------Another Footer-------------------->
            <div class="row footer2">
                <h3>THANK YOU!</h3>
                <form class="no-print">
                    <input type="button"  class="btn btn-default" value="Print this page" onClick="window.print()">
                </form>
            </div>
            
        </main>
        
        <script src="../js/bootstrap.min.js"></script>
    </body>
    
</html>