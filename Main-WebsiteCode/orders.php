<?php

include('./includes/config.php') ?>

<?php include 'header.php' ?>

<?php
// if('true'=='true'){

// }
?>

<div class="container-md min-vh-100 mt-4">
    <div class="card">
        <div class="card-header py-2">
            <h3 class="card-title">My Orders</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered bg-white">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $email = $_SESSION['useremail'];
                        $order_query = mysqli_query($db_conn, "SELECT * FROM orders WHERE orderBy = '$email'") or die(mysqli_error($db_conn));
                        while ($order = mysqli_fetch_object($order_query)) {
                            $products = json_decode($order->productIdQuant) ?>
                            <tr>
                                <td rowspan=<?= count($products) ?>><?= $count++ ?></td>
                                <?php
                                foreach ($products as $key => $value) {
                                    $productInfo = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * from products WHERE id='$value[0]'")) ?>
                                    <td><?= $productInfo->Title ?></td>
                                    <td><img src="admin/uploads/<?= $productInfo->image ?>" alt="product image" width="auto" height=70></td>
                                    <td><?= $value[1] ?></td>
                                    <td><?= $value[2] ?></td>
                                    <?= $key == 0 ? '<td rowspan=' . count($products) . '>' . $order->time .  '</td>' : '' ?>
                                    <?php
                                   
                                    if ($key == 0) {
                                        if ($order->confirmed=='true' && $order->delivered=='false') {
                                            echo '<td rowspan=' . count($products) . '>Your Order is Confirmed</td>';
                                        } elseif ($order->confirmed=='true' && $order->delivered=='true') {
                                            echo '<td rowspan=' . count($products) . '>Your Order is Delivered</td>';
                                            // echo '<td rowspan=" . count($products)">'.gettype($order->delivered).'</td>';
                                        } else {
                                            echo '<td rowspan=' . count($products) . '>Your Order is not Confirmed</td>';
                                        }
                                    }
                                    ?>
                            </tr>
                    <?php }
                            } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php' ?>