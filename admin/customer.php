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
        $query = "Select * From customer 
                        Where f_username = '$logged_user'  Order By cu_name Limit 25 Offset $page";
        $result = mysqli_query($link, $query);
        $row_returned2 = mysqli_num_rows($result);
    
    //for pagination
        $query_nav = "Select * From customer 
                        Where f_username = '$logged_user' ";
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
                 <li role="presentation" class="active"><a href="customer.php">Customer</a></li>
                 <li role="presentation"><a href="order.php">Order</a></li>
                 <li role="presentation"><a href="invoice.php">Invoice</a></li>
                 
            </ul>           
        </div>
        <!------------------------end  Sidebar ----------------------->
        <!------------------------start Content----------------------->
        <div class="col-md-9 content">
            <!-- Checking if everything is right or not -->
             <?php
                    //if user fill up all the fields
                    if(isset($_SESSION['cfill']) && !empty($_SESSION['cfill'])){
                        echo "<p style='color:red;'>
                        Please fill up all the fields.</p>";
                        unset($_SESSION['cfill']);
                    }
                    else if(isset($_SESSION['ofill']) && !empty($_SESSION['ofill'])){
                        echo "<p style='color:red;'>
                        Please select customers for delete.</p>";
                        unset($_SESSION['ofill']);
                    }
                    //if name is already exists
                    else if(isset($_SESSION['cu_copy']) && !empty($_SESSION['cup_copy'])){
                        echo "<p style='color:red;'>
                        Customer <strong>".$_SESSION['cu_copy']."</strong>  with phone no. 
                        <strong>".$_SESSION['cup_copy']."</strong> has already been added.
                        Try with a new name and no.</p>";
                        unset($_SESSION['cu_copy']);
                        unset($_SESSION['cup_copy']);
                    }    
                    //if insertion is successfull
                    else if(isset($_SESSION['cu_add']) && !empty($_SESSION['cup_add'])){
                        echo "<p style='color:green;'>
                        Successfully added <strong>".$_SESSION['cu_add']."</strong> customer 
                        with phone no. <strong>".$_SESSION['cup_add']."</strong></p>";
                        unset($_SESSION['cu_add']);
                        unset($_SESSION['cup_add']);
                    }  
                     //if delete is successfull
                    else if(isset($_SESSION['delall']) && !empty($_SESSION['delall'])){
                        echo "<p style='color:green;'>
                        Successfully deleted all customers.</p>";
                        unset($_SESSION['delall']);
                    }
               ?>
           <!-- form for add customer -->
            <div>
            <form class="form-inline" method="post" action="addcustomer.php" >
              <div class="form-group">
                <input type="text" class="form-control" pattern="[a-zA-Z0-9\s]+" 
                            title="type only a-z,A-Z,0-9" maxlength="32" 
                             placeholder="Customer Name" name="cus_name">
              </div>
              <div class="form-group">
                <input type="number" class="form-control" maxlength="32" 
                             placeholder="Phone No." name="cus_phone">
              </div>
                  <button type="submit" class="btn btn-primary btn-md">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                    Add New</button>
            </form>
            <?php
                    //if there has no customer...............
                    if($row_returned2==0){
                        echo "<p style='color:red;'>
                        No customer is found.<br>Please add a new customer.</p>";
                        die();
                    }
            ?>
            
            <div>
            <form class="form-inline" method="post" action="delcustomer.php" >
            <table class="table table-striped">
                <thead>
                  <tr>
                      <th><input type="checkbox"  id="checkAll"/></th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                  </tr>
                </thead>
                <tbody id=tables>
                      <?php    
                        while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                            print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['cu_name'].'-'.$row['cu_phone'].'"/></td>';
                            print '<td>'.$row['cu_name'].'</td>';
                            print '<td>'.$row['cu_phone'].'</td>';
                            print '</tr>';
                        }
                      ?>  
                </tbody>
              </table>
              <input type="submit" class="btn btn-primary btn-md"  
                              value="Delete Customer" name="delcus"> 
            </form>
            <p>(If you delete any customer his/her all information, orders and invoices will 
                    deleted)</p>
            </div>
            <nav>
              <ul class="pagination">
               <?php
                    for($x = 1; $x <= $nav; $x++){
                        echo "<li><a href='customer.php?page=".$x."'>".$x."</a></li>";
                    }
                ?>
              </ul>
        </nav>
        </div>
        <!------------------------end Content----------------------->
    </div>
    </div>
    <!--------my script------>
    <script>
    $(document).ready(function(){
            $( ".pagination li:nth-child(1)" ).addClass("active");
        
        $(".pagination a").click(function(event){
            event.preventDefault();
            var data = { customer: $(this).text() };
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