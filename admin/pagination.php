<?php
require_once "../connect.php";
require_once "../inside.php";
$logged_user = $_SESSION['session'];
//for order pagination
if( isset($_GET['page']) && !empty($_GET['page']) ) {
    $page = $_GET['page'];
    $page = ($page-1)*25;

    $query = " select * from customer 
                        Inner Join `order` On 
                        customer.f_username='$logged_user' 
                        and customer.cu_id=order.cu_id
                        Inner Join product On 
                        order.p_id=product.p_id Order By o_id desc Limit 25 Offset $page  ";
    $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_assoc($result)) {
                                print '<tr>';
                                print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['o_id'].'-'.$row['cu_id'].'='.$row['o_price'].'"/></td>';
                                print '<td>'.$row['o_id'].'</td>';
                                print '<td>'.$row['p_name'].'</td>';
                                print '<td>'.$row['o_ammount'].'</td>';
                                print '<td>'.$row['o_price'].' tk'.'</td>';
                                print '<td>'.$row['cu_name'].'</td>';
                                print '<td>'.$row['cu_phone'].'</td>';
                                print '</tr>';
                            }
    //echo $page;
}

//for invoice pagination
else if( isset($_GET['invoice']) && !empty($_GET['invoice']) ) {
    $page = $_GET['invoice'];
    $page = ($page-1)*25;

   $query = " select customer.f_username,customer.cu_id,customer.cu_name,invoice.i_id,  
                         invoice.i_sub_total,invoice.i_vat,
                         invoice.i_total_price,invoice.i_date
                         from customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id Order By i_id desc  Limit 25 Offset $page";
    $result = mysqli_query($link, $query);
        
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
}

//for customer pagination
else if( isset($_GET['customer']) && !empty($_GET['customer']) ) {
    $page = $_GET['customer'];
    $page = ($page-1)*25;

    $query = "Select * From customer 
                        Where f_username = '$logged_user'  Order By cu_name Limit 25 Offset $page";
    $result = mysqli_query($link, $query);
        
         while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                            print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['cu_name'].'-'.$row['cu_phone'].'"/></td>';
                            print '<td>'.$row['cu_name'].'</td>';
                            print '<td>'.$row['cu_phone'].'</td>';
                            print '</tr>';
                        }
}
//for catagory pagination
else if( isset($_GET['catagory']) && !empty($_GET['catagory']) ) {
    $page = $_GET['catagory'];
    $page = ($page-1)*25;

     $query = "Select * From catagory Where f_username= '$logged_user'
                        Order By c_name Limit 25 Offset $page";
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                             print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['c_name'].'"/></td>';
                            print '<td>'.$row['c_name'].'</td>';
                            print '</tr>';
                        }
}
//for product pagination
else if( isset($_GET['product']) && !empty($_GET['product']) ) {
    $page = $_GET['product'];
    $page = ($page-1)*25;

     $query = "Select * From product,catagory 
                        Where product.f_username= '$logged_user'
                        And product.c_id=catagory.c_id Order By p_name Limit 25 Offset $page ";
        $result = mysqli_query($link, $query);
        
        while($row = mysqli_fetch_assoc($result)) {
                            print '<tr>';
                            print '<td><input type="checkbox" name="selected[]" 
                                            value="'.$row['p_name'].'-'.$row['c_id'].'"/></td>';
                            print '<td>'.$row['p_name'].'</td>';
                            print '<td>'.$row['p_price'].' tk'.'</td>';
                            print '<td>'.$row['c_name'].'</td>';
                            print '</tr>';
                        }
}
?>