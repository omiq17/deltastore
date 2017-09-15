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
        $query = " select customer.f_username,customer.cu_id,customer.cu_name,invoice.i_id,  
                         invoice.i_sub_total,invoice.i_vat,
                         invoice.i_total_price,invoice.i_date
                         from customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id Order By i_id desc  Limit 25 Offset $page";
        $result = mysqli_query($link, $query);
        
         $query3 = "  select customer.cu_name, customer.cu_phone
                            from customer Where 
                            customer.f_username='$logged_user'  Order By cu_name ";
        $result3 = mysqli_query($link, $query3);
         //for pagination
        $query_nav = " select customer.f_username,customer.cu_id,customer.cu_name,invoice.i_id,  
                         invoice.i_sub_total,invoice.i_vat,
                         invoice.i_total_price,invoice.i_date
                         from customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id";
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
                 <li role="presentation"><a href="order.php">Order</a></li>
                 <li role="presentation" class="active"><a href="invoice.php">Invoice</a></li>
                 
            </ul>           
        </div>
        <!------------------------end  Sidebar ----------------------->
        <!------------------------start Content----------------------->
        <div class="col-md-9 content">

                        <!---checking if invoice no. is right or wrong---->
            <?php 
                if(isset($_SESSION['wrongIno']) && !empty($_SESSION['wrongIno']) ){
                    echo "<p style='color:red;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Invalid Invoice.Try again.</p>";
                    unset($_SESSION['wrongIno']);
                }
                else if(isset($_SESSION['iadd']) && !empty($_SESSION['iadd']) ){
                    echo "<p style='color:green;text-align:left;font-size:19px;
                                        padding-top:15px'>
                               Successfully created Invoice No. <strong>".$_SESSION['iadd']."
                               </strong></p>";
                    unset($_SESSION['iadd']);
                }
                 //if delete is successfull
                    else if(isset($_SESSION['delall']) && !empty($_SESSION['delall'])){
                        echo "<p style='color:green;'>
                        Successfully deleted the invoices.</p>";
                        unset($_SESSION['delall']);
                    }
                 //if user fill up all the fields
                    if(isset($_SESSION['ifill']) && !empty($_SESSION['ifill'])){
                        echo "<p style='color:red;'>
                        Please select invoices for delete.</p>";
                        unset($_SESSION['ifill']);
                    } 
            ?>
            
            <div>
                    <form class="form-inline col-md-6" method="post" action="showInvoice.php"
                                         target="_blank">
                      <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName2"
                                                name="ino" placeholder="Invoice No.">
                      </div>
                      <button type="submit" class="btn btn-primary btn-md">Show</button>
                    </form>
            </div>
            
            <div>
            <form class="form-inline"  method="post" action="deleteInvoice.php" >
            <table class="table table-striped">
                <thead>
                  <tr>
                   <th><input type="checkbox"  id="checkAll"/></th>
                    <th>Invoice No.</th>
                    <th>Customer Name</th>
                    <th>Sub Total</th>
                    <th>Total Price</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody id=tables>
                      <?php    
                        while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                            print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['i_id'].'"/></td>';
                            print '<td>'.$row['i_id'].'</td>';
                            print '<td>'.$row['cu_name'].'</td>';
                            print '<td>'.$row['i_sub_total'].'</td>';
                            print '<td>'.$row['i_total_price'].' tk'.'</td>';
                            print '<td>'.$row['i_date'].'</td>';
                            print '</tr>';
                        }
                      ?>  
                </tbody>
              </table>
               <input type="submit" class="btn btn-primary btn-md" 
                              value="Delete Invoice" name="dinv">
            </form>
            </div>
            
            <nav>
              <ul class="pagination">
               <?php
                    for($x = 1; $x <= $nav; $x++){
                        echo "<li><a href='invoice.php?page=".$x."'>".$x."</a></li>";
                    }
                ?>
              </ul>
        </nav>
            
        </div><!------------------------end Content----------------------->
    </div>
     <!--------my script------>
    <script>
    $(document).ready(function(){
            $( ".pagination li:nth-child(1)" ).addClass("active");
        
        $(".pagination a").click(function(event){
            event.preventDefault();
            var data = { invoice: $(this).text() };
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
