<?php include('./includes/config.php') ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    header('Location:./cart2.php');
    exit();
}

include 'header.php';

if (isset($_POST['checkout'])) {
    $email = $_SESSION['useremail'];
    $productQuantity = $_POST['productQuantity'];
    $products = json_decode($productQuantity);
    $newProductArrayWithPrice = array();
    $total = 0;
    // Get Customer Details
    $user = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * from users WHERE email='$email'"));
    //
?>

    <div class="container mt-4">
        <div id="printableArea" class="card mx-auto p-4 w-75">
            <div class="row">
                <div class="col-6 me-auto">
                    <h1>Sendriya</h1>
                    <h4>Company Address:</h4>
                    <h4>Phone Number:</h4>
                    <h4>Email Id:</h4>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-9 me-auto">
                    <table>
                        <tbody>
                            <tr>
                                <td><b>Buyer Name:</b></td>
                                <td><?= $user->name ?></td>
                            </tr>
                            <tr>
                                <td><b>Buyer Address:</b></td>
                                <td><?= $user->address ?></td>
                            </tr>
                            <tr>
                                <td><b>Buyer Phone Number:</b></td>
                                <td><?= $user->phone ?></td>
                            </tr>
                            <tr>
                                <td><b>Buyer Email Id:</b></td>
                                <td><?= $user->email ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-3 ms-auto">
                    <h6>Invoice Number: #######</h6>
                    <h6>Invoice Date:<?= ' ' . date('F j, Y, g:i a') ?></h6>
                </div>
            </div>
            <div class="mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Rate</th>
                            <th scope="col">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($products as $key => $product) {
                            $productInfo = mysqli_fetch_object(mysqli_query($db_conn, "SELECT `Title`,`Price`,`Quantity` from products WHERE id='$product[0]'"));
                            $total = $total + $product[1] * $productInfo->Price;
                            array_push($product, $productInfo->Price);
                            // print_r($product);
                            // echo '<br>';
                            array_push($newProductArrayWithPrice, $product);
                            mysqli_query($db_conn, "UPDATE `products` SET `Quantity` = $productInfo->Quantity-$product[1] WHERE `products`.`id` = '$key';"); // subtracting quantity
                       
                        ?>
                        <tr>
                            <td><?= $productInfo->Title ?></td>
                            <td><?= $product[1] ?></td>
                            <td>&#8377;<?= $productInfo->Price ?></td>
                            <td>&#8377;<?= $product[1] * $productInfo->Price ?></td>
                        </tr>
                    <?php
                        }
                        $newProductArrayWithPrice = json_encode($newProductArrayWithPrice);
                        mysqli_query($db_conn, "INSERT INTO `orders` (`orderBy`, `productIdQuant`) VALUES ('$email','$newProductArrayWithPrice')") or die(mysqli_error($db_conn));
                        mysqli_query($db_conn, "UPDATE `users` SET `cart` = '' WHERE `users`.`email` = '$email'") or die(mysqli_error($db_conn));
                    }
                    ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Total</td>
                            <td colspan="2">&#8377;<?= $total ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <button type="button" class="btn btn-primary" onclick="printDiv('printableArea')">Print</button>
    </div>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>