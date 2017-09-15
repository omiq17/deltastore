<?php
require_once 'inside.php';
require_once 'connect.php';//connect to DB

    
    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = mysqli_real_escape_string($link, $_POST['username']);
        $password = mysqli_real_escape_string($link, $_POST['password']);
        //$password_hash = md5($password);
        $password_hash = sha1( md5($password).'raqib_hasan1993omiq' );
        //$username ='".mysql_real_escape_string($username)."';

        if(!empty($username) && !empty($password)){
                $query = "Select * from foreman where f_username= '$username'
                                And f_password= '$password_hash' ";
                $result = mysqli_query($link, $query);
                $row = mysqli_num_rows($result);

                if($row==0){
                    //echo 'Invalid Username/Password';
                    $_SESSION['invalidpassword']="invalid";
                    header('Location: login.php');
                }
                else if($row==1){
                    //echo 'yes';
                     //take user name for create session
                    $rowuser = mysqli_fetch_assoc($result);
                    $session = $rowuser['f_username'];
                    $_SESSION['session']=$session; //creating a session
                    header('Location: admin/admin.php'); //back to home page and check the session
                }
                else
                    echo 'Don\'t mess with me';
        }
        
        else{
            //echo 'Give your Username & Password';
            $_SESSION['invalid']='invalid';
            header('Location: login.php');
        }
            
}
 
?>