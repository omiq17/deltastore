<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB
$logged_user = $_SESSION['session'];

if (isset($_POST['del'])){
    
    if( isset($_POST['selected']) ){
        $id=$_POST['selected'];
        $N = count($id);
        foreach ($id as $item){
            $p_name = substr($item, 0, strpos($item,'-' ) );
            $c_id = substr($item, strpos($item,'-' )+1 );
            $query1 = " DELETE FROM product WHERE p_name='$p_name'
                                AND c_id='$c_id' AND f_username='$logged_user' ";
            $result1 = mysqli_query($link, $query1);
            if (!$result1) {
                $_SESSION['del']=$p_name;
                header("location: product.php");
                die();
                }
           }
        //successfully deleted all orders
        $_SESSION['delall']='added';
        header("location: product.php");
    }
    
    //if nothing is checked
    else{
        $_SESSION['ofill']='added';
        header("location: product.php");
    }
    //end of if/else
}
    

?>