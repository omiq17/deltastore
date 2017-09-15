<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB

    if(isset($_POST['pname']) && !empty($_POST['pname']) &&
        isset($_POST['pprice']) && !empty($_POST['pprice']) &&
        isset($_POST['cname']) && !empty($_POST['cname'])  ) {
        $pname = mysqli_real_escape_string($link, $_POST['pname']);
        $pprice = mysqli_real_escape_string($link, $_POST['pprice']);
        $cname = mysqli_real_escape_string($link, $_POST['cname']);
        $logged_user = $_SESSION['session'];
        //echo $cname;
        //find out catagory id from catagory name
        $query2 = " select catagory.c_id from catagory where
                            catagory.f_username = '$logged_user' 
                            and catagory.c_name = '$cname' ";
        $result2 = mysqli_query($link, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        //echo $row2['c_id'];
        $cid =$row2['c_id'];
        
        //checking if product within is already added or not
        $query1 = " select product.p_name,product.c_id from product where
                            product.f_username = '$logged_user' and 
                            product.p_name= '$pname' and
                            product.c_id = $cid ";
        $result1 = mysqli_query($link, $query1);
        $row_returned = mysqli_num_rows($result1);
        
        if($row_returned>0){
            $_SESSION['pcopy']=$pname;
            $_SESSION['pccopy']=$cname;
            header('Location: product.php');
        }
        //if not then insert data 
        else{
        $query =" INSERT INTO product (p_id, p_name, p_price, 
                        c_id, f_username) VALUES (NULL, '$pname', $pprice , $cid,  '$logged_user') ";
        $result = mysqli_query($link, $query);
        $_SESSION['padd']=$pname;
        $_SESSION['pcadd']=$cname;
        $_SESSION['ppadd']=$pprice;
        header('Location: product.php'); 
        }
    }

//if field is empty
else{
    $_SESSION['pfill']='empty';
    header('Location: product.php');
}
?>