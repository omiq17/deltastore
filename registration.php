<?php
require_once 'inside.php';
require_once 'connect.php';//connect to DB

    
    if(isset($_POST['username']) && isset($_POST['password'])  && isset($_POST['firstname'])
       && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['storename'])
       && isset($_POST['confirmpassword']) ){
        $username =  mysqli_real_escape_string($link,$_POST['username']);
        $firstname =  mysqli_real_escape_string($link,$_POST['firstname']);
        $lastname =   mysqli_real_escape_string($link,$_POST['lastname']);
        $email =  mysqli_real_escape_string($link,$_POST['email']);
        $password = mysqli_real_escape_string($link,$_POST['password']);
        $confirmpassword = mysqli_real_escape_string($link,$_POST['confirmpassword']);
        $storename = mysqli_real_escape_string($link,$_POST['storename']);

        if(!empty($username) && !empty($firstname) && !empty($lastname) &&
           !empty($email) && !empty($password) && !empty($confirmpassword) 
           && !empty($storename)  ){
                 $query = " SELECT * FROM foreman WHERE f_username='$username' ";
                 $result = mysqli_query($link, $query);
                 $row = mysqli_num_rows($result);
                if($row>0){
                    //username matched
                    $_SESSION['usermatched']="invalid";
                    header('Location: login.php');
                    die();
                }
            
                if( $password!=$confirmpassword ){
                    $_SESSION['pass']='invalid';
                    header('Location: login.php');
                    die();//important
                }
            
            $password_hash = sha1( md5($password).'raqib_hasan1993omiq' );
           // INSERT INTO `deltastore`.`foreman` (`f_username`, `f_firstname`, `f_lastname`, `f_email`, `f_password`, `f_storename`) VALUES ('aaa', 'MD', 'KJHdd', 'dsj@sd', '1234', 'jhk');
                $query = " INSERT INTO foreman (`f_username`, `f_firstname`,
                                `f_lastname`, `f_email`, `f_password`, `f_storename`) VALUES 
                                ( '$username', '$firstname', '$lastname', '$email',
                                '$password_hash', '$storename') ";
                $result = mysqli_query($link, $query);
                $_SESSION['success']='valid';
                header('Location: login.php');
            
        }
        
        else{
            //echo ' fill up all fields ';
            $_SESSION['fill']='invalid';
            header('Location: login.php');
        }
        
    }    

else{
            //error Ocured;
            header('Location: login.php');
        }
        
 
?>