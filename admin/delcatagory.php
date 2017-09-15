<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB
$logged_user = $_SESSION['session'];

if (isset($_POST['del'])){
    
    if( isset($_POST['selected']) ){
        $id=$_POST['selected'];
        //$N = count($id);
        foreach ($id as $item){
            $query1 = " DELETE FROM catagory WHERE c_name='$item' 
                                AND f_username='$logged_user' ";
            $result1 = mysqli_query($link, $query1);
            if (!$result1) {
                $_SESSION['del']=$item;
                header("location: catagory.php");
                die();
                }
           }
        //successfully deleted all orders
        $_SESSION['delall']='added';
        header("location: catagory.php");
    }
    
    //if nothing is checked
    else{
        $_SESSION['ofill']='added';
        header("location: catagory.php");
    }
    //end of if/else
}
    

?>