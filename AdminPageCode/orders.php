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

    <!-- Product modal start -->
    <div class="modal fade" id="product-modal">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Products</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <!-- <th>Sr.No</th> -->
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td id="total"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product modal end -->

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Manage Orders</h1>
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
                    <h3 class="card-title">Orders</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Order By</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Addresss</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $order_query = mysqli_query($db_conn, 'SELECT * from orders');
                                while ($order = mysqli_fetch_object($order_query)) {
                                    $customer = $order->orderBy;
                                    $user_query = mysqli_query($db_conn, "SELECT * from users WHERE email='$customer'");
                                    while ($user = mysqli_fetch_object($user_query)) { ?>
                                        <tr>
                                            <td><?= $count++ ?></td>
                                            <td><?= $user->name ?></td>
                                            <td><?= $user->phone ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->address ?></td>
                                            <td>
                                                <button class="view btn btn-primary" onclick='getProducts(<?= $order->productIdQuant ?>)'>View</button>
                                            </td>
                                            <td>
                                            <p id='<?=$order->orderId?>'><?php echo (json_decode($order->confirmed)) ? '<button class="btn btn-success mb-1" disabled>Confirmed</button>' :'<button class="btn btn-success mb-1" onclick="confirmOrder('.$order->orderId.')">Confirm</button>'?></p>
                                            <p id='d<?=$order->orderId?>'><?php echo (json_decode($order->delivered)) ? '<button class="btn btn-success mb-1" disabled>Delivered</button>' :'<button class="btn btn-success mb-1" onclick="delivered('.$order->orderId.')">Delivered</button>'?></p>
                                            </td>
                                        </tr>
                                <?php }
                                } ?>
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
    function getProducts(productsObject) {
        productJSONstring = JSON.stringify(productsObject)
        // console.log(typeof(productJSONstring))
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementsByTagName('tbody')[0].innerHTML = ''
                var total = 0
                JSON.parse(this.response).forEach(element => {
                    document.getElementsByTagName('tbody')[0].innerHTML += `<tr>
                                <td>${element[0]}</td>
                                <td><img src="uploads/${element[3]}" alt="product image" width="auto" height=100></td>
                                <td>${element[4]}</td>
                                <td>${element[1]}</td>
                                <td>&#8377;${element[2]*element[1]}</td>
                            </tr>`
                    total += element[2] * element[1]
                });
                document.getElementById('total').innerHTML = '&#8377;' + total
            }
        }
        xmlhttp.open("GET", "getProducts.php?q=" + productJSONstring, true);
        xmlhttp.send();
        $('#product-modal').modal('toggle');
    }

    function confirmOrder(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
                document.getElementById(id).innerHTML='<button class="btn btn-success mb-1" disabled>Confirmed</button>'
            }
        }
        xmlhttp.open("GET", "getProducts.php?confirm=" + id, true);
        xmlhttp.send();
    }

    function delivered(id){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText)
                document.getElementById('d'+id).innerHTML='<button class="btn btn-success mb-1" disabled>Delivered</button>'
            }
        }
        xmlhttp.open("GET", "getProducts.php?delivered=" + id, true);
        xmlhttp.send();
    }
</script>
<?php include('footer.php') ?>