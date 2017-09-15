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
        $query = "Select * From catagory Where f_username= '$logged_user'
                        Order By c_name Limit 25 Offset $page";
        $result = mysqli_query($link, $query);
        $num_rows = mysqli_num_rows($result);
        //$row = mysqli_fetch_assoc($result);
     //for pagination
        $query_nav = " Select * From catagory Where f_username= '$logged_user' ";
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
                 <li role="presentation" class="active"><a href="catagory.php">Catagory</a></li>
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
            <div>
            <!-- Checking if everything is right or not -->
             <?php 
                    //if user dont check
                    if(isset($_SESSION['ofill']) && !empty($_SESSION['ofill'])){
                        echo "<p style='color:red;'>
                        Please select catagory for delete.</p>";
                        unset($_SESSION['ofill']);
                    } 
                    if(isset($_SESSION['copy']) && !empty($_SESSION['copy'])){
                        echo "<p style='color:red;font-size:17px;'>
                        Catagory <strong>".$_SESSION['copy']."</strong>  already added.
                        Try with a new name.</p>";
                        unset($_SESSION['copy']);
                    }    
                    if(isset($_SESSION['add']) && !empty($_SESSION['add'])){
                        echo "<p style='color:green;font-size:17px;'>
                        Successfully added <strong>".$_SESSION['add']."</strong> catagory.</p>";
                        unset($_SESSION['add']);
                    }   
                    //if delete is successfull
                    else if(isset($_SESSION['delall']) && !empty($_SESSION['delall'])){
                        echo "<p style='color:green;'>
                        Successfully deleted the catagories.</p>";
                        unset($_SESSION['delall']);
                    }
                     //if delete is not successfull
                    else if(isset($_SESSION['del']) && !empty($_SESSION['del'])){
                        echo "<p style='color:red;'>
                        The catagory <strong>".$_SESSION['del']."</strong> cannot
                        be deleted.<br>Make sure you delete the product/products that belongs the 
                        catagory.</p>";
                        unset($_SESSION['del']);
                    } 
               ?>
             </div> 
             <div>
            <form class="form-inline" method="post" action="addcatagory.php">
              <div class="form-group">
                <input type="text" class="form-control" pattern="[a-zA-Z0-9\s]+" 
                            title="type only a-z,A-Z,0-9" maxlength="32" 
                             placeholder="Catagory Name" name="addnew">
              </div>
              <button type="submit" class="btn btn-primary btn-md">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                        Add New</button>
            </form>    
            </div>
            <!-- Checking if there exists any data or not -->
            <?php
                //if there is no catagory
                if($num_rows==0){
                        echo "<p style='color:red;font-size:17px;'>
                        No catagory is found.<br>Please add a new catagory.</p>";
                        die();
                  }
             ?>
            <div>
            <form class="form-inline" method="post" action="delcatagory.php">
            <table class="table table-striped">
                <thead>
                  <tr>
                   <th><input type="checkbox"  id="checkAll"/></th>
                    <th>Catagory Name</th>
                    <!-- <th>Product Name</th> -->
                  </tr>
                </thead>
                <tbody id=tables>
                      <?php    
                        while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                             print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['c_name'].'"/></td>';
                            print '<td>'.$row['c_name'].'</td>';
                            print '</tr>';
                        }
                      ?>  
                </tbody>
              </table>
              <input type="submit" class="btn btn-primary btn-md"  
                              value="Delete Catagory" name="del">    
            <p>(If you delete any catagory all the product/products belongs to it orders 
                   will be deleted)</p>
            </form>
            </div>
            <nav>
              <ul class="pagination">
               <?php
                    for($x = 1; $x <= $nav; $x++){
                        echo "<li><a href='catagory.php?page=".$x."'>".$x."</a></li>";
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
            var data = { catagory: $(this).text() };
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
