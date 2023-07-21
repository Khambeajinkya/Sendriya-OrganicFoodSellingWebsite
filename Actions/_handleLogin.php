<?php
$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['loginEmail'];
    $pass = $_POST['loginPassword'];

    $sql= "SELECT * FROM `users` WHERE user_email = '$user_email'";
    
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) 
        $row = mysqli_fetch_assoc($result);
            if (password_verify($pass, $row['user_pass'])) {
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['useremail'] = $user_email;
                // echo "loggedin";
                // echo $user_email;
                header("location:/phptuts/tuts47-Php_Forum/index.php");
                exit();
            } else {
                $showError = "Invalid Credentials";
                header("location:/phptuts/tuts47-Php_Forum/index.php");
            }
        
    }

?>