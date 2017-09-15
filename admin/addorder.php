<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB

    if(isset($_POST['pro_name']) && !empty($_POST['pro_name']) &&
        isset($_POST['amm_name']) && !empty($_POST['amm_name']) &&
        isset($_POST['cust_name']) && !empty($_POST['cust_name'])  ) {
        $pro_name = mysqli_real_escape_string($link, $_POST['pro_name']);
        $amm_name = mysqli_real_escape_string($link, $_POST['amm_name']);
        $cust_name = mysqli_real_escape_string($link, $_POST['cust_name']);
        $logged_user = $_SESSION['session'];
        //echo $pro_name."<br>";
        $cat_name = substr($pro_name, strpos($pro_name,'(' )+1, -1 );
        $product_name = substr($pro_name, 0, strpos($pro_name,'(' ) );
        //taking product id...............................................
        $query_p = " select product.p_id,product.p_price from product 
                        Inner Join catagory On 
                        catagory.c_name='$cat_name' 
                        and product.c_id=catagory.c_id 
                        and product.p_name = '$product_name' "; 
        $result_p = mysqli_query($link, $query_p);
        $row_p = mysqli_fetch_assoc($result_p);
        $product_id = $row_p['p_id'];
        $product_price = $amm_name*$row_p['p_price'];
        //echo $product_price."<br>";
        //echo $cat_name."<br>";
        //echo $product_name."<br>";
        //echo $cust_name."<br>";
        //taking customer id...............................................
        $phone_no = substr($cust_name, strpos($cust_name,'(' )+1, -1 );
        $customer_name = substr($cust_name, 0, strpos($cust_name,'(' ) );
        $query_c = " select customer.cu_id from customer 
                            Where customer.cu_name='$customer_name' 
                            and customer.cu_phone = '$phone_no' and f_username='$logged_user' "; 
        $result_c = mysqli_query($link, $query_c);
        $row_c = mysqli_fetch_assoc($result_c);
        $customer_id = $row_c['cu_id'];
        //echo $customer_id."<br>";
        //echo $customer_name."<br>";
        //echo $phone_no;
        //die();
        
        //Inserting data into order.................
        $query ="INSERT INTO `order` (o_id, p_id, o_ammount, cu_id,o_price) VALUES
                        (NULL, '$product_id', '$amm_name', '$customer_id', '$product_price')";
        $result = mysqli_query($link, $query);
        $_SESSION['oadd']='added';
        header('Location: order.php'); 
    }

//if field is empty
else{
    $_SESSION['addorder']='empty';
    header('Location: order.php');
}
?>