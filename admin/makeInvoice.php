<?php
require_once "../connect.php";
require_once "../inside.php";//connect to DB

if (isset($_POST['inv'])){
    
    if(isset($_POST['selected']) && isset($_POST['vat'])  ){
        $id=$_POST['selected'];
        $N = count($id);
        $vat= $_POST['vat'];
        
        if($N==1){
            //$id[0]='1110985-19823=2569852236';  echo $id[0].'<br>';
            //setting up some things................ 
            $l1=strpos($id[0],'-');
            $l2=strpos($id[0],'=')-1;
            $length = $l2-$l1;
            $o_id = substr($id[0], 0, $l1 );
            $c_id = substr($id[0], $l1+1, $length );
            $o_p = substr($id[0], $l2+2 );
            $t_p = $o_p+($o_p*($vat/100) );
            //echo $o_p.'<br>'.$t_p.'<br>';
            $today = date("Y-m-d");
            //echo $today;
            //echo $l1.'<br>'; echo $l2.'<br>'; echo $o_id.'<br>'.$c_id.'<br>'.$o_p; die();
            $query_i = "INSERT INTO invoice (i_id, cu_id, i_sub_total, i_vat, i_total_price,
                                i_date) VALUES (NULL, '$c_id', '$o_p', '$vat', '$t_p', '$today') ";
            $result_i = mysqli_query($link, $query_i);
            $i_id = mysqli_insert_id($link);
            
            $query_i2 = " INSERT INTO invoice_dt (i_id, o_id) VALUES ('$i_id', '$o_id') ";
            $result_i2 = mysqli_query($link, $query_i2);
            $_SESSION['iadd']=$i_id; 
            header("location: invoice.php");  
        }
        
        //if there is more than one order........
        else{
                $l1=strpos($id[0],'-');
                $l2=strpos($id[0],'=')-1;
                $length = $l2-$l1;
                $c_id = substr($id[0], $l1+1, $length );
            
           foreach ($id as $item){
                $l1=strpos($item,'-');
                $l2=strpos($item,'=')-1;
                $length = $l2-$l1;
                $temp = substr($item, $l1+1, $length );
               if($c_id!=$temp){
                    $_SESSION['manycus']='many';
                    header("location: order.php");
                    die();
               }
                //echo $c_id."<br />";
           }
            //if there is only ONe customer
            $o_p=0;
            foreach ($id as $item){
                $l2=strpos($item,'=')-1;
                $p = substr($item, $l2+2 );
                $o_p= $o_p+$p;
                echo $o_p.'<br>'; 
            }
            //die();
            $t_p = $o_p+($o_p*($vat/100) );
            $today = date("Y-m-d");
            $query_i = "INSERT INTO invoice (i_id, cu_id, i_sub_total, i_vat, i_total_price,
                                    i_date) VALUES (NULL, '$c_id', '$o_p', '$vat', '$t_p', '$today') ";
            $result_i = mysqli_query($link, $query_i);
            $i_id = mysqli_insert_id($link);
            
            foreach ($id as $item){
                $l1=strpos($item,'-');
                $o_id = substr($item, 0, $l1 );
                $query_i2 = " INSERT INTO invoice_dt (i_id, o_id) VALUES ('$i_id', '$o_id') ";
                $result_i2 = mysqli_query($link, $query_i2);
            }
            $_SESSION['iadd']=$i_id; 
            header("location: invoice.php");
            //end of multiple insert
        }
        
        //end of if/else
    }
    
    //if nothing is checked
    else{
        $_SESSION['ocufill']='added';
        header("location: order.php");
    }

}
?>