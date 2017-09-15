<?php
require_once 'inside.php';
require_once 'connect.php';//connect to DB

    
    if( isset($_POST['password1'])
       && isset($_POST['password2']) && isset($_POST['password3']) ) {
        $logged_user = $_SESSION['session']; 
        
        if( !empty($_POST['password1']) && !empty($_POST['password2']) 
           && !empty($_POST['password3'])  ) {
           
            $o =  mysqli_real_escape_string($link,$_POST['password1']) ;
            $n =   mysqli_real_escape_string($link,$_POST['password2']) ;
            $n2 =  mysqli_real_escape_string($link,$_POST['password3']) ;
            
            $old =  sha1( md5($o).'raqib_hasan1993omiq' );
            $new =   sha1( md5($n).'raqib_hasan1993omiq' );
            $new2 =  sha1( md5($n2).'raqib_hasan1993omiq' );
            
            $query = " Select * From foreman WHERE f_username ='$logged_user' ";
            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
            $pass=$row['f_password'];
            
            if($old==$pass){
                
                if($new==$new2){
                     $query1 = " UPDATE foreman
                                        SET f_password='$new'
                                        WHERE f_username ='$logged_user' ";
                    $result1 = mysqli_query($link, $query1);
                //Success;
                    if ($result1) {
                         $_SESSION['sucp']='valid';
                         header('Location: profile.php');
                         die();
                        }
                        else{
                            header('Location: profile.php');
                        }
                }
                else{
                    $_SESSION['wrongn']='valid';
                     header('Location: editpass.php');
                     die();
                }
                //end of check new pass  
            }
            else{
                $_SESSION['wrong']='valid';
                     header('Location: editpass.php');
                     die();
            }
            //end of check old pass 
            
        }
        
        //fill up fields
        else{
            //echo ' fill up all fields ';
            $_SESSION['fill']='invalid';
            header('Location:editpass.php');
        }
        
    }   
        
 
?>