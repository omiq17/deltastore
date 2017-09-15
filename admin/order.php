<?php
require_once "../connect.php";
require_once "../inside.php";

if( isset($_GET['page']) ){
    $page = $_GET['page'];
    $page = ($page-1)*25;
}
else 
    $page = 0;
//end pagination work
if(empty($_SESSION['session'])){
	header('Location: ../index.php');
}

else if(!empty($_SESSION['session'])){
        $logged_user = $_SESSION['session'];
        
        $query1 = " select product.p_name, catagory.c_name
                        from product 
                        Inner Join catagory On 
                        product.f_username='$logged_user' 
                        and product.c_id=catagory.c_id Order By p_name ";
        $result1 = mysqli_query($link, $query1);
        
        $query3 = "  select customer.cu_name, customer.cu_phone
                            from customer Where 
                            customer.f_username='$logged_user'  Order By cu_name ";
        $result3 = mysqli_query($link, $query3);
        //main query
        $query = " select * from customer 
                        Inner Join `order` On 
                        customer.f_username='$logged_user' 
                        and customer.cu_id=order.cu_id
                        Inner Join product On 
                        order.p_id=product.p_id Order By o_id desc Limit 25 Offset $page  ";
        $result = mysqli_query($link, $query);
        $row_returned = mysqli_num_rows($result);
        //for pagination
        $query_nav = " select * from customer 
                                Inner Join `order` On 
                                customer.f_username='$logged_user' 
                                and customer.cu_id=order.cu_id
                                Inner Join product On 
                                order.p_id=product.p_id";
        $result_nav = mysqli_query($link, $query_nav);
        $row_nav = mysqli_num_rows($result_nav);
        $nav = $row_nav/25;
        if( ($row_nav%25)>0)
            $nav+=1;
 }

?>
  
   <?php   require_once 'header.php';  ?> <!--include header part-->
    
    <div class="container-fluid row section">
    <!------------------------Start Sidebar----------------------->
        <div class ="col-md-3 sidebar">
             <ul class="nav nav-pills nav-stacked">
                 <li role="presentation"><a href="admin.php">Dashboard
                      </a></li>
                 <li role="presentation"><a href="catagory.php">Catagory</a></li>
                 <li role="presentation"><a href="product.php">
                    Product</a></li>
                 <li role="presentation"><a href="customer.php">Customer</a></li>
                 <li role="presentation" class="active"><a href="order.php">Order</a></li>
                 <li role="presentation"><a href="invoice.php">Invoice</a></li>
                 
            </ul>           
        </div>
        <!------------------------end  Sidebar ----------------------->
        <!------------------------start Content----------------------->
        <div class="col-md-9 content">
         <!-- Checking if everything is right or not -->
          <?php
                     //if user not select orders
                    if(isset($_SESSION['addorder']) && !empty($_SESSION['addorder'])){
                        echo "<p style='color:red;'>
                        Please fill up all the fields.</p>";
                        unset($_SESSION['addorder']);
                    } 
                    //if user not select order
                    if(isset($_SESSION['ofill']) && !empty($_SESSION['ofill'])){
                        echo "<p style='color:red;'>
                        Please select orders for delete.</p>";
                        unset($_SESSION['ofill']);
                    } 
                     //if user not select invoice
                    if(isset($_SESSION['ocufill']) && !empty($_SESSION['ocufill'])){
                        echo "<p style='color:red;'>
                        Please select orders to create invoice.</p>";
                        unset($_SESSION['ocufill']);
                    } 
                    //if user select many customer
                   else if(isset($_SESSION['manycus']) && !empty($_SESSION['manycus'])){
                        echo "<p style='color:red;'>
                        Please choose orders those belongs to only one customer</p>";
                        unset($_SESSION['manycus']);
                    }  
                    //if insertion is successfull
                    else if(isset($_SESSION['oadd']) && !empty($_SESSION['oadd'])){
                        echo "<p style='color:green;'>
                        Successfully added an order.</p>";
                        unset($_SESSION['oadd']);
                    }         
                    //if delete is successfull
                    else if(isset($_SESSION['delall']) && !empty($_SESSION['delall'])){
                        echo "<p style='color:green;'>
                        Successfully deleted the orders.</p>";
                        unset($_SESSION['delall']);
                    }
                     //if delete is not successfull
                    else if(isset($_SESSION['del']) && !empty($_SESSION['del'])){
                        echo "<p style='color:red;'>
                        The Order No. <strong>".$_SESSION['del']."</strong> cannot
                        be deleted.<br>Make sure you delete the Invoice first that 
                        belongs that order.</p>";
                        unset($_SESSION['del']);
                    }  
               ?>
           <!-- form for add order -->
            <div>
            <form class="form-inline" method="post" action="addorder.php" >
             
              <div class="form-group">
                <select class="form-control" name="pro_name">
                     <option disabled selected style='display:none;'>Product Name(Catagory Name)
                                 </option>
                     <?php    
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            print '<option>'.$row1['p_name'].'('.$row1['c_name'].')'.'</option>';
                        }
                      ?>  
                </select>
              </div>
              <div class="form-group">
                <input type="number" class="form-control" max="10000000000" 
                             placeholder="Quantity" name="amm_name">
              </div>
              <div class="form-group">
              <select class="form-control" name="cust_name">
                     <option disabled selected style='display:none;'>Customer Name(Phone No.)
                                 </option>
                     <?php    
                        while($row3 = mysqli_fetch_assoc($result3)) {
                            print '<option>'.$row3['cu_name'].
                                    '('.$row3['cu_phone'].')'.'</option>';
                        }
                      ?>  
                </select>
                </div>
              <button type="submit" class="btn btn-primary btn-md">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    Add New</button>
            </form>
            <?php
                    //if there has no order...............
                    if($row_returned==0){
                        echo "<p style='color:red;'>
                        No order is found.<br>Please add a new order.<br>
                        Make sure that you added catagory,product & customer first.</p>";
                        die();
                    }
            ?>
            
            <!------------------------start Table----------------------->
            <div>
                <form class="form-inline"  method="post" action="makeInvoice.php" >
                <table class="table table-striped">
                    <thead>
                      <tr>
                       <th><input type="checkbox"  id="checkAll"/></th>
                        <th>Order No.</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Customer Name</th>
                        <th>Phone No.</th>
                      </tr>
                    </thead>
                    <tbody id=tables>
                          <?php    
                            while($row = mysqli_fetch_assoc($result)) {
                                print '<tr>';
                                print '<td><input type="checkbox" name="selected[]"
                                            value="'.$row['o_id'].'-'.$row['cu_id'].'='.$row['o_price'].'" /></td>';
                                print '<td>'.$row['o_id'].'</td>';
                                print '<td>'.$row['p_name'].'</td>';
                                print '<td>'.$row['o_ammount'].'</td>';
                                print '<td>'.$row['o_price'].' tk'.'</td>';
                                print '<td>'.$row['cu_name'].'</td>';
                                print '<td>'.$row['cu_phone'].'</td>';
                                print '</tr>';
                            }
                          ?>  
                    </tbody>
                  </table>
                <div class="form-group">
                    <input type="number" class="form-control" max="1000"
                             placeholder="VAT%" name="vat">
                      <input type="submit" class="btn btn-primary btn-md" 
                              value="Create Invoice" name="inv">
                </div>
                    <input type="submit" class="btn btn-primary btn-md"  
                              value="Delete Order" name="del" formaction="delorder.php">              
                </form>
            </div>       <!------end Table--------->
        </div>
        <nav>
              <ul class="pagination">
               <?php
                    for($x = 1; $x <= $nav; $x++){
                        echo "<li><a href='order.php?page=".$x."'>".$x."</a></li>";
                    }
                ?>
              </ul>
        </nav>
        
        </div>        <!--------end Content------>
    </div>
    <!--------my script------>
    <script>
    $(document).ready(function(){
            $( ".pagination li:nth-child(1)" ).addClass("active");
        
        $(".pagination a").click(function(event){
            event.preventDefault();
            var data = { page: $(this).text() };
            var act = $(this).text() ;
           
            $.ajax({
                url: 'http://localhost/xteem_deltastore/admin/pagination.php',
                type: 'get',
                data: data,
                success: function(result){
                                    $('#tables').html(result);
                                    $(".pagination  li.active").removeClass('active');
                                    $( ".pagination  li:nth-child("+act+") " ).addClass("active");
                                    //$( " ul> li" ).index(act).addClass("active");
                            }
            }); //ajax end
        });//pagination end
        
        
        
        $('#checkAll').change(function(){
            $('#tables input:checkbox').prop('checked', $(this).prop("checked") );
        }); //end ckeckAll
        
    });
    </script>
    
</body>
</html>
