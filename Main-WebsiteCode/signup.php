<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'includes/config.php';
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    // $exists = false;                                 $exists means existance of record not function
    // Check wheather this username exists
    
    $existsSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($db_conn, $existsSql);
    $numExistsRows = mysqli_num_rows($result);
    if ($numExistsRows > 0) {
        // $exists = true;
        $showError = "Email Already Exists";
    } else {
        $exists = false;
        if ($password == $cpassword) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`name`, `phone`, `email`, `password`, `address`) VALUES ('$name','$phone','$email','$hash','$address');";
            $result = mysqli_query($db_conn, $sql);
            if ($result) {
                $showAlert = true;
            }
            header("Location:./login.php");
        } else {
            $showError = "Password do not match";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp Page</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <section class="bg-light vh-100 d-flex">
        <div class="m-auto">
            <div class="card" style="width:25rem">
                <div class="card-body">
                    <div class="text-center">
                        <span class="fa-stack fa-lg">
                            <i class="fa fa-circle fa-stack-2x text-light"></i>
                            <i class="fa fa-user fa-stack-1x text-dark"></i>
                        </span>
                    </div>
                    <form action="" method="POST">
                        <!-- Email input -->
                        <?php 
                        if($showError){
                            $message='<div class="mb-2"><p class="text-warning">' .$showError. '</p></div>';
                            echo $message;
                        }
                        ?>
                        <div class="form-outline mb-4">
                            <input type="text" id="name" name="name" class="form-control" required/>
                            <label class="form-label" for="form1Example1">Name</label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" id="email" name="email" class="form-control" required/>
                            <label class="form-label" for="form1Example1">Email address</label>
                        </div>


                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <div class="form-outline mb-0">
                                    <input type="password" id="password" name="password" class="form-control" required maxlength="15" minlength="8" />
                                    <label class="form-label" for="form1Example2">Password</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-outline mb-0">
                                    <input type="password" id="cpassword" name="cpassword" class="form-control" required/>
                                    <label class="form-label" for="form1Example2">Confirm Password</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="phone" id="phone" name="phone" class="form-control" required minlength="10" maxlength="10" />
                            <label class="form-label" for="form1Example1">Mobile No.</label>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea type="text" id="address" name="address" class="form-control" required></textarea>
                            <label class="form-label" for="form1Example1">Address</label>
                        </div>

                        <!-- 2 column grid layout for inline styling -->
                        <div class="row mb-4">
                            <div class="col d-flex justify-content-center">
                                <!-- Checkbox -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                                </div>
                            </div>

                            <div class="col">
                                <!-- Simple link -->
                                <a href="login.php">Already have an account?</a>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="signup" class="btn btn-primary btn-block" name="signup">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>
</body>

</html>