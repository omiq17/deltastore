<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB
$logged_user = $_SESSION['session'];

    if(isset($_POST['date']) && !empty($_POST['date'])  ) {
         $date = $_POST['date'];
         //echo $date; die();
        $query_i = "SELECT * FROM customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id and
                         invoice.i_date='$date' ";
        $result_i = mysqli_query($link, $query_i);
        $dsum=0;
        while($row_i = mysqli_fetch_assoc($result_i)) {
            $dsum= $dsum+$row_i['i_total_price'];
        }
        $_SESSION['dsum']=$dsum;
        $_SESSION['date']=$date;
        header('Location: admin.php');
        
    }

//if field is empty
else{
    $_SESSION['dfill']='empty';
    header('Location: admin.php');
}
?>