<?php
    
    $db_conn = mysqli_connect('localhost','root','','sendriya_new');

    if(!$db_conn){
        echo 'Connection Failed';
        exit;
    }   
?>