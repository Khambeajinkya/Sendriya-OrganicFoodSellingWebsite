<?php
$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '_dbconnect.php';
    $user_email = $_POST['signupEmail'];
    $pass = $_POST['signupPassword'];
    $cpass = $_POST['signupCpassword'];

    // check whether this email exists

    $existSql= "SELECT * FROM `users` WHERE user_email = '$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError = true;
    
    }
    else{
        if($pass == $cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`) VALUES ('$user_email', '$hash')";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert = true;
                header("Location:/phptuts/tuts47-Php_Forum/index.php?signupSuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password does not match";
        }
    }
    
    header("Location:/phptuts/tuts47-Php_Forum/index.php?false&error=false");

}

?>