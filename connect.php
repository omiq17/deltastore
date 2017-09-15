<?php
$hostname = 'localhost';
$username = 'root';
$password = 'root';
$db = 'xteem_deltastore';

/**
 * if(!@mysql_connect($hostname,$username,$password)
    && !@mysql_select_db($db) )
    echo 'Error'.mysql_error();
 */ 

$link = mysqli_connect("$hostname", "$username", "$password", "$db");

date_default_timezone_set('Asia/Dhaka');

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


?>
