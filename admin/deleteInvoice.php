<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB
$logged_user = $_SESSION['session'];

if (isset($_POST['dinv'])){
    
    if( isset($_POST['selected']) ){
        $id=$_POST['selected'];
        //$N = count($id);
        foreach ($id as $item){
            $query1 = " DELETE FROM invoice WHERE i_id='$item' ";
            $result1 = mysqli_query($link, $query1);
            //if (!$result1) {
               // echo 'error occured';
                //die();
                //}
           }
        //successfully deleted all orders
        $_SESSION['delall']='added';
        header("location: invoice.php");
    }
    
    //if nothing is checked
    else{
        $_SESSION['ifill']='added';
        header("location: invoice.php");
    }
    //end of if/else
}
    

?>