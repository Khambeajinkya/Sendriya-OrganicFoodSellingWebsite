<?php
    if(isset($_POST['login'])){
        $email=$_POST['email'];
        $pass=$_POST['password'];

        if($email == 'admin@example.com' && $pass == 'admin'){
            session_start();
            $_SESSION['adminLogin']=true;
            header("location:../admin/dashboard.php");
        }
        else{
            echo '<h1>Invalid Credential</h1>';
        }

    }
?>