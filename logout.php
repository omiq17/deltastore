<?php
        require_once"inside.php";
        session_destroy();
        
        if(!empty($http_referer)) {
                if (strpos($http_referer,'/admin/') == true || strpos($http_referer,'/profile') == true)
                    header("Location: index.php");
            else 
                header("Location: $http_referer");
        }

        else
                header("Location: index.php");

?>