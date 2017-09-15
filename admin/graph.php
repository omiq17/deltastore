<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB
$logged_user = $_SESSION['session'];

    if(isset($_POST['date']) && !empty($_POST['date'])  ) {
         $date = $_POST['date'];
         $i_date = $date.'-01';
         $query = "SELECT last_day('$i_date') ";
         $results = mysqli_query($link, $query);
         $row = mysqli_fetch_array($results,MYSQLI_NUM);
         $l_date=$row[0];
         //echo $i_date.'<br>'.$l_date;
        $query_i = "SELECT * FROM customer 
                         Inner Join invoice On 
                         customer.f_username='$logged_user' 
                         and customer.cu_id=invoice.cu_id and
                         invoice.i_date BETWEEN '$i_date' 
                         AND '$l_date' ";
        $result_i = mysqli_query($link, $query_i);
        $sum=0;
        while($row_i = mysqli_fetch_assoc($result_i)) {
            $sum= $sum+$row_i['i_total_price'];
        }
        $_SESSION['sum']=$sum;
        $_SESSION['date']=$i_date;
        header('Location: admin.php');
        
    }

//if field is empty
else{
    $_SESSION['dfill']='empty';
    header('Location: admin.php');
}
?>