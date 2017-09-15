<?php
require_once "../connect.php";
require_once "../inside.php";
    
    if(isset($_POST['ino']) && !empty($_POST['ino'])){
        $ino = mysqli_real_escape_string($link, $_POST['ino']);
        //echo $ino;
        $logged_user = $_SESSION['session'];
         $query = " select customer.f_username,customer.cu_id,invoice.i_id
                         from customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id";
        $result = mysqli_query($link, $query);
        $a=0;
         while($row = mysqli_fetch_assoc($result)) {
             if($ino==$row['i_id']){
                 $a=1;
                 $_SESSION['ino']=$ino;         
                 header('Location: memo.php');
                            }
                        }  
        //if session or $ino is empty
        if($a==0){
            $_SESSION['wrongIno']='invalid';
            header('Location: invoice.php');
        }
        
    }

else{
    header('Location: invoice.php');
}

?>