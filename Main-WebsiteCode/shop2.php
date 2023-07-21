<?php include('./includes/config.php') ?>
<?php include 'header.php' ?>
<?php
if (isset($_GET["addtocart"])) {
$addItem = $_GET['addtocart'];
$email = $_SESSION['useremail'];
$cartItems = mysqli_fetch_assoc(mysqli_query($db_conn, "SELECT cart FROM users
WHERE email = '$email'")) or die(mysqli_error($db_conn));
$cartArr = explode(",", $cartItems['cart']);
if (!in_array($addItem, $cartArr)) {
if (strlen($cartArr[0]) > 0) {
$newCartItems = $cartItems['cart'] . ',' . $addItem;
} else {
$newCartItems = $addItem;
}
mysqli_query($db_conn, "UPDATE `users` SET `cart` = '$newCartItems' WHERE
`users`.`email` = '$email'") or die(mysqli_error($db_conn));
echo '<script type="text/javascript">alert("Product is added in cart")</script>';
} else {
echo '<script type="text/javascript">alert("Product is already in cart")</script>';
}
}
if (isset($_GET["category"])) {
$category = $_GET['category'];
}
?>
<!-- Start Content -->
<div class="container mt-5">
<div class="row">
<div class="col-sm-3">
<h1 class="h2 pb-4">Categories</h1>
<ul class="list-unstyled templatemo-accordion">
<?php
$count = 1;
$category_query = mysqli_query($db_conn, 'SELECT * from categories');
while ($category = mysqli_fetch_object($category_query)) { ?>
<li class="pb-3">
<a class="h5 text-decoration-none" href="?category=<?= $category->title ?>">
<?= $category->title ?>
</a>
</li>
<?php } ?>
</ul>
</div>
<div class="col-12 col-sm-9">
<div class="row row-cols-1 row-cols-md-3 g-4">
<?php
if (isset($_GET["category"])) {
$category = $_GET['category'];
$count = 1;
$product_query = mysqli_query($db_conn, "SELECT * from products WHERE
Category='$category'");
while ($product = mysqli_fetch_object($product_query)) { ?>
<div class="col">
<div class="card">
<img src="./admin/uploads/<?= $product->image ?>" class="card-img-top"
alt="product image" style="height:250px">
<hr>
<div class="card-body">
<h4 class="card-title"><span class="badge bg-success"><?= $product->Title ?></span></h4>
<!-- <p class="card-title"><?= $product->Title ?> -->
<!-- <p class="card-text"><?= $product->Description ?></p> -->
<p  class="badge bg-primary">Price: &#8377;<?= $product->Price ?></p>
<h5><span class="badge bg-info"><?= $product->Category ?></span></h5>

<a href="?addtocart=<?= $product->id ?>" class="btn btn-danger">Add to cart</a>
</div>
</div>
</div>
<?php }
} else {
$count = 1;
$product_query = mysqli_query($db_conn, 'SELECT * from products');
while ($product = mysqli_fetch_object($product_query)) { ?>
<div class="col">
<div class="card">
<img src="./admin/uploads/<?= $product->image ?>" class="card-img-top"
alt="product image" style="height:250px">
<hr>
<div class="card-body">
<h4 class="card-title"><span class="badge bg-success"><?= $product->Title ?></span></h3>
<!-- <p class="card-text"><?= $product->Description ?></p> -->
<p class="badge bg-primary">Price: &#8377;<?= $product->Price ?></p>
<h5><span class="badge bg-info"><?= $product->Category ?></span></h5>

<a href="?addtocart=<?= $product->id ?>" class="btn btn-danger">Add
to cart</a>
</div>
</div>
</div>
<?php }
} ?>
</div>
</div>
</div>
</div>
<!-- End Content -->
<?php include 'footer.php' ?>