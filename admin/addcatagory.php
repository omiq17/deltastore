<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB

    if(isset($_POST['addnew']) && !empty($_POST['addnew'])){
        $add = mysqli_real_escape_string($link, $_POST['addnew']);
        //echo $add;
        $logged_user = $_SESSION['session'];
        //checking if catagory is already added or not
        $query1 = " select catagory.c_name from catagory where
                            catagory.f_username = '$logged_user' ";
        $result1 = mysqli_query($link, $query1);
        $a=0;
        while($row1 = mysqli_fetch_assoc($result1)) {
             if($add==$row1['c_name']){
                 $a=1;
                 $_SESSION['copy']=$add;         
                 header('Location: catagory.php');
                 die();
                            }
                        }
        //if not then insert data 
        if($a==0){
        $query = " INSERT INTO catagory (c_id, c_name, f_username)
                           VALUES (NULL, '$add', '$logged_user')";
        $result = mysqli_query($link, $query);
        $_SESSION['add']=$add;  
        header('Location: catagory.php'); }
        }
//if field is empty
else{
    header('Location: catagory.php');
}
?>