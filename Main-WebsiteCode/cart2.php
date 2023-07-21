<?php include('./includes/config.php') ?>

<?php include 'header.php' ?>

<?php
if (isset($_GET["remove"])) {
    $removeItem = $_GET['remove'];
    $email = $_SESSION['useremail'];
    $cartItems = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT cart FROM users WHERE email = '$email'")) or die(mysqli_error($db_conn));
    $cartArr = explode(",", $cartItems['cart']);
    $newCartItems = array_diff($cartArr, [$removeItem]);
    $newCartItems = implode(',', $newCartItems);

    mysqli_query($db_conn, "UPDATE `users` SET `cart` = '$newCartItems' WHERE `users`.`email` = '$email'") or die(mysqli_error($db_conn));
}
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
                <form action="checkout3.php" method="POST">
                    <input id="productQuantity" name="productQuantity" value="" class="form-control" hidden/>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" name="checkout">Cash On Delivery</button>
                        <button type="button" class="btn btn-primary" name="online" disabled>Online Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal End -->


<div class="container-md min-vh-100 mt-4">
    <div class="card">
        <div class="card-header py-2">
            <h3 class="card-title">Cart</h3>
        </div>
        <?php $email = $_SESSION['useremail'];
        $cartItems = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT cart FROM users WHERE email = '$email'")) or die(mysqli_error($db_conn));
        $cartArr = explode(",", $cartItems['cart']);

        if (strlen($cartArr[0]) > 0) { ?>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered bg-white">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($cartArr as $value) {
                                $product_query = mysqli_query($db_conn, "SELECT * from products WHERE id='$value'");
                                $product = mysqli_fetch_object($product_query); ?>
                                <tr id=<?= $product->id ?>>
                                    <td><?= $product->Title ?></td>
                                    <td><img src="admin/uploads/<?= $product->image ?>" alt="product image" width="auto" height=100></td>
                                    <td>&#8377;<?= $product->Price ?><p class="price" hidden><?= $product->Price ?></p>
                                    </td>
                                    <td>
                                        <input class="form-control quantity" type="number" value="1" min="1" max="5" oninput="javascript: if (this.value > 5) this.value = 5; func()">
                                    </td>
                                    <td> <a href="?remove=<?= $product->id ?>" class="btn btn-danger">Remove</a>
                                    </td>
                                </tr>
                            <?php
                            } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">Total</td>
                                <td colspan="2">
                                    <h3 class="total"></h3>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-block" name="checkout" data-bs-toggle="modal" data-bs-target="#exampleModal">Checkout</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        <?php } else {
            echo 'Your cart is empty';
        }
        ?>
    </div>
</div>

<script>
    function func() {
        var k = document.getElementsByTagName('tbody')[0].getElementsByTagName('tr')
        var cart = []
        var total = 0
        for (let i = 0; i < k.length; i++) {
            var q = k[i].getElementsByTagName('input')[0].value
            var n = k[i].getElementsByClassName('price')[0].innerText
            total = total + q * n
            cart.push([k[i].id, q]) // k[i].id is product id and q is quantity
        }
        document.getElementsByClassName('total')[0].innerText = '₹' + total
        document.getElementById('productQuantity').value = JSON.stringify(cart)//encoding for cart send json so strinfying and posting for checkout
    }
    window.onload = func()
</script>

<?php include 'footer.php' ?>