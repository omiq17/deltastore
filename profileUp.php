<?php
require_once 'inside.php';
require_once 'connect.php';//connect to DB

    
    if( isset($_POST['firstname'])
       && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['storename']) ) {
        $logged_user = $_SESSION['session'];
        $firstname =  mysqli_real_escape_string($link,$_POST['firstname']);
        $lastname =   mysqli_real_escape_string($link,$_POST['lastname']);
        $email =  mysqli_real_escape_string($link,$_POST['email']);
        $storename = mysqli_real_escape_string($link,$_POST['storename']);

        if( !empty($firstname) && !empty($lastname) &&
           !empty($email) && !empty($storename)  ) {
                 $query = " UPDATE foreman
                                    SET f_firstname='$firstname', f_lastname='$lastname',
                                    f_email='$email', f_storename='$storename'
                                    WHERE f_username ='$logged_user' ";
                 $result = mysqli_query($link, $query);
            //Success;
                 if ($result) {
                     $_SESSION['suc']='valid';
                     header('Location: profile.php');
                     die();
                    }
            else{
                header('Location: editprofile.php');
            }
            
        }
        
        else{
            //echo ' fill up all fields ';
            $_SESSION['fill']='invalid';
            header('Location:editprofile.php');
        }
        
    }    

else{
            //error Ocured;
            header('Location: login.php');
        }
        
 
?>