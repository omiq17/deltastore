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
        $query = "Select * From product,catagory 
                        Where product.f_username= '$logged_user'
                        And product.c_id=catagory.c_id Order By p_name Limit 25 Offset $page ";
        $result = mysqli_query($link, $query);
        $row_returned1 = mysqli_num_rows($result);
     
        $query1 = "Select catagory.c_name From catagory 
                        Where catagory.f_username= '$logged_user' Order By c_name";
        $result1 = mysqli_query($link, $query1);
    
     //for pagination
        $query_nav = " Select * From product,catagory 
                        Where product.f_username= '$logged_user'
                        And product.c_id=catagory.c_id";
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
                 <li role="presentation" class="active"><a href="product.php">
                    Product</a></li>
                 <li role="presentation"><a href="customer.php">Customer</a></li>
                 <li role="presentation"><a href="order.php">Order</a></li>
                 <li role="presentation"><a href="invoice.php">Invoice</a></li>
                 
            </ul>           
        </div>
        <!------------------------end  Sidebar ----------------------->
        <!------------------------start Content----------------------->       
        <div class="col-md-9 content">
            <!-- Checking if everything is right or not -->
             <?php
                    //if user dont check
                    if(isset($_SESSION['ofill']) && !empty($_SESSION['ofill'])){
                        echo "<p style='color:red;'>
                        Please select products for delete.</p>";
                        unset($_SESSION['ofill']);
                    } 
                    //if user fill up all the fields
                    if(isset($_SESSION['pfill']) && !empty($_SESSION['pfill'])){
                        echo "<p style='color:red;'>
                        Please fill up all the fields.</p>";
                        unset($_SESSION['pfill']);
                    }
                    //if name is already exists
                    else if(isset($_SESSION['pcopy']) && !empty($_SESSION['pcopy'])){
                        echo "<p style='color:red;'>
                        Product <strong>".$_SESSION['pcopy']."</strong>  under catagory 
                        <strong>".$_SESSION['pccopy']."</strong> has already been added.
                        Try with a new name.</p>";
                        unset($_SESSION['pcopy']);
                        unset($_SESSION['pccopy']);
                    }    
                    //if insertion is successfull
                    else if(isset($_SESSION['padd']) && !empty($_SESSION['padd'])){
                        echo "<p style='color:green;'>
                        Successfully added <strong>".$_SESSION['padd']."</strong> product under 
                        <strong>".$_SESSION['pcadd']."</strong> catagory with price
                         <strong>".$_SESSION['ppadd']."</strong> tk.</p>";
                        unset($_SESSION['padd']);
                        unset($_SESSION['pcadd']);
                        unset($_SESSION['ppadd']);
                    }         
                     //if delete is successfull
                    else if(isset($_SESSION['delall']) && !empty($_SESSION['delall'])){
                        echo "<p style='color:green;'>
                        Successfully deleted the products.</p>";
                        unset($_SESSION['delall']);
                    }
                     //if delete is not successfull
                    else if(isset($_SESSION['del']) && !empty($_SESSION['del'])){
                        echo "<p style='color:red;'>
                        The product <strong>".$_SESSION['del']."</strong> cannot
                        be deleted.<br>Make sure you delete the order/orders that belongs the 
                        product.<br>Also delete the invoice/invoices that belongs the order/orders
                        if any.</p>";
                        unset($_SESSION['del']);
                    } 
               ?>
             <!---add product---->     
            <div>
            <form class="form-inline" method="post" action="addproduct.php" >
              <div class="form-group">
                <input type="text" class="form-control" pattern="[a-zA-Z0-9\s]+" 
                            title="type only a-z,A-Z,0-9" maxlength="32" 
                             placeholder="Product Name" name="pname">
              </div>
              <div class="form-group">
                <input type="number" step="0.01" class="form-control"  
                             placeholder="Unit Price" name="pprice" 
                             max="9999999999999999999999999999999">
              </div>               
            <div class="form-group">
                <select class="form-control" name="cname">
                     <option disabled selected style='display:none;'>Catagory Name</option>
                     <?php    
                        while($row1 = mysqli_fetch_assoc($result1)) {
                            print '<option>'.$row1['c_name'].'</option>';
                        }
                      ?>  
                </select>
              </div>             
              <button type="submit" class="btn btn-primary btn-md">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add New</button>
            </form>
            <?php
                    //if there has no product ...............................
                    if($row_returned1==0){
                        echo "<p style='color:red;'>
                        No product is found.<br>Please add a new product.
                        <br>Make sure that you added a catagory first.</p>";
                        die();
                    }
            ?>
            </div> 
            
            <div>
            <form class="form-inline" method="post" action="delproduct.php" >
            <table class="table table-striped">
                <thead>
                  <tr>
                   <th><input type="checkbox"  id="checkAll"/></th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Catagory</th>
                  </tr>
                </thead>
                <tbody id=tables>
                      <?php    
                        while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                            print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['p_name'].'-'.$row['c_id'].'"/></td>';
                            print '<td>'.$row['p_name'].'</td>';
                            print '<td>'.$row['p_price'].' tk'.'</td>';
                            print '<td>'.$row['c_name'].'</td>';
                            print '</tr>';
                        }
                      ?>  
                </tbody>
              </table>
              <input type="submit" class="btn btn-primary btn-md"  
                              value="Delete Product" name="del">    
            </form>
            </div>
             <nav>
              <ul class="pagination">
               <?php
                    for($x = 1; $x <= $nav; $x++){
                        echo "<li><a href='product.php?page=".$x."'>".$x."</a></li>";
                    }
                ?>
              </ul>
        </nav>
        </div>
        <!------------------------end Content----------------------->
    </div>
    <!--------my script------>
    <script>
    $(document).ready(function(){
            $( ".pagination li:nth-child(1)" ).addClass("active");
        
        $(".pagination a").click(function(event){
            event.preventDefault();
            var data = { product: $(this).text() };
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
