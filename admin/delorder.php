<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB

if (isset($_POST['del'])){
    
    if( isset($_POST['selected']) ){
        $id=$_POST['selected'];
        $N = count($id);
        foreach ($id as $item){
            $o_id = substr($item, 0, strpos($item,'-' ) );
            $query1 = " DELETE FROM `order` WHERE o_id='$o_id' ";
            $result1 = mysqli_query($link, $query1);
            if (!$result1) {
                $_SESSION['del']=$o_id;
                header("location: order.php");
                die();
                }
            // echo $o_id."<br />";
           }
        //successfully deleted all orders
        $_SESSION['delall']='added';
        header("location: order.php");
    }
    
    //if nothing is checked
    else{
        $_SESSION['ofill']='added';
        header("location: order.php");
    }
    //end of if/else
}
    

?>