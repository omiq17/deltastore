<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB
$logged_user = $_SESSION['session'];

if (isset($_POST['delcus'])){
    
    if( isset($_POST['selected']) ){
        $id=$_POST['selected'];
        //$N = count($id);
        foreach ($id as $item){
            $cu_name = substr($item, 0, strpos($item,'-' ) );
            $cu_phone = substr($item, strpos($item,'-' )+1 );
            echo $cu_name."<br />".$cu_phone;
            $query1 = " DELETE FROM customer WHERE cu_name='$cu_name'
                                AND cu_phone='$cu_phone' AND f_username='$logged_user'  ";
            $result1 = mysqli_query($link, $query1);
            if (!$result1) {
                //$_SESSION['del']=$o_id;  header("location: order.php");
                echo "something went wrong";
                die();
                }
           }
        //die();
        //successfully deleted all customers
        $_SESSION['delall']='added';
        header("location: customer.php");
    }
    
    //if nothing is checked
    else{
        $_SESSION['ofill']='added';
        header("location: customer.php");
    }
    //end of if/else
}
    

?>