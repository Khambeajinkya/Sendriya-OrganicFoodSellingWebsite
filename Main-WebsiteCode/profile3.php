<?php include('./includes/config.php') ?>

<?php include 'header.php' ?>

<?php
$email = $_SESSION['useremail'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['editInfo'])) {
        $name = $_POST["name"];
        $address = $_POST["address"];

        mysqli_query($db_conn, "UPDATE `users` SET `name` = '$name', `address`='$address' WHERE `users`.`email` = '$email'") or die(mysqli_error($db_conn));
    }
    if (isset($_POST['updatePassword'])) {
        $oldPassword = $_POST["oldPassword"];
        $npassword = $_POST["npassword"];
        $cnpassword = $_POST["cnpassword"];

        $password_query = mysqli_query($db_conn, "SELECT password FROM users WHERE email = '$email'") or die(mysqli_error($db_conn));
        $password = mysqli_fetch_object($password_query);
        // print($password->password);
        if (password_verify($oldPassword, $password->password)) {
            // echo 'Verified';
            if ($npassword == $cnpassword) {
                $hash = password_hash($npassword, PASSWORD_DEFAULT);
                mysqli_query($db_conn, "UPDATE `users` SET `password` = '$hash' WHERE `users`.`email` = '$email'") or die(mysqli_error($db_conn));
            }
        } else {
            echo 'You Entered wrong password';
        }
    }
}

$user_query = mysqli_query($db_conn, "SELECT name, email, phone, address  FROM users WHERE email = '$email'") or die(mysqli_error($db_conn));
$user = mysqli_fetch_object($user_query);
// print_r($user);
// echo $user->name;
?>
<!-- Modal Start -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Select Payment Mode</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Enter Old Password</label>
                        <input type="password" class="form-control" id="oldPassword" name="oldPassword">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="npassword" name="npassword">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="cnpassword" name="cnpassword">
                    </div>
                    <button type="submit" name="updatePassword" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->

<div class="container-md min-vh-100 mt-4">
    <div class="card">
        <div class="card-header py-2">
            <h3 class="d-inline card-title">Your Information</h3>
            <button type="button" onclick="enableDisable()" class="d-inline btn btn-primary">Edit</button>
        </div>
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" id="name" name="name" value="<?= $user->name ?>" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" id="phone" name="phone" value="<?= $user->email ?>" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Mobile No.</label>
                    <input type="text" id="email" name="email" value="<?= $user->phone ?>" class="form-control" disabled>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Address</label>
                    <textarea type="text" class="form-control" id="address" name="address" disabled><?= $user->address ?></textarea>
                </div>
                <button type="submit" id="submit" name="editInfo" class="btn btn-primary" hidden>Update</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</button>
            </form>
        </div>
    </div>
</div>
<script>
    const enableDisable = () => {
        document.getElementById('name').disabled = false
        document.getElementById('address').disabled = false
        document.getElementById('submit').hidden = false
    }
</script>
<?php include 'footer.php' ?>