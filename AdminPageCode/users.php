<?php include('../includes/config.php') ?>
<?php include('header.php') ?>
<?php

if (isset($_GET['delete'])) {
    $dId = $_GET['delete'];
    // echo $sno;
    $delete = true;
    $sql = "DELETE FROM `users` WHERE `users`.`id` = '$dId'";
    mysqli_query($db_conn, $sql);
}
?>

<?php include('sidebar.php') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="card">
                <div class="card-header py-2">
                    <h3 class="card-title">Users</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Addresss</th>
                                    <th>Orders</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $product_query = mysqli_query($db_conn, 'SELECT * from users');
                                while ($user = mysqli_fetch_object($product_query)) { ?>
                                    <tr>
                                        <td><?= $count++ ?></td>
                                        <td><?= $user->name ?></td>
                                        <td><?= $user->phone ?></td>
                                        <td><?= $user->email ?></td>
                                        <td><?= $user->address ?></td>
                                        <td></td>
                                        <td>
                                            <button id="d<?= $user->id ?>" class="delete btn btn-danger">Delete</button>
                                        </td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
        element.addEventListener("click", (e) => {
            dId = e.target.id.substr(1, ); //substr(1, ) delete 'd' from id of delete button search substr on google

            if (confirm("Are You Sure You Want To Delete This User")) {
                // console.log("yes")
                window.location = `users.php?delete=${dId}`;
            } else {
                console.log("no")
            }
        })
    })
</script>
<?php include('footer.php') ?>