<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB

    if(isset($_POST['cus_name']) && !empty($_POST['cus_name']) &&
        isset($_POST['cus_phone']) && !empty($_POST['cus_phone'])  ) {
        $cus_name = mysqli_real_escape_string($link, $_POST['cus_name']);
        $cus_phone = mysqli_real_escape_string($link, $_POST['cus_phone']);
        $logged_user = $_SESSION['session'];
        /*echo $cus_name;
        echo $cus_phone;
        die();*/
        //find out if customer name and phone already exists or not...........
        $query1 = " select customer.cu_name from customer where
                            customer.f_username = '$logged_user' and 
                            customer.cu_name= '$cus_name' and
                            customer.cu_phone = '$cus_phone' ";
        $result1 = mysqli_query($link, $query1);
        $row_returned = mysqli_num_rows($result1);
        
        if($row_returned>0){
            $_SESSION['cu_copy']=$cus_name;
            $_SESSION['cup_copy']=$cus_phone;
            header('Location: customer.php');
        }
        //if not then insert data 
        else{
        $query =" INSERT INTO customer (cu_id, cu_name, cu_phone,
                        f_username) VALUES (NULL, '$cus_name', '$cus_phone', '$logged_user'); ";
        $result = mysqli_query($link, $query);
        $_SESSION['cu_add']=$cus_name;
        $_SESSION['cup_add']=$cus_phone;
        header('Location: customer.php'); 
        }
        
    }

//if field is empty
else{
    $_SESSION['cfill']='empty';
    header('Location: customer.php');
}
?>