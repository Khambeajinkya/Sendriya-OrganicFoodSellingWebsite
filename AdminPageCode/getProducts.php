<?php include('../includes/config.php') ?>

<?php
if (isset($_GET['q'])) {
    $productQuantity = $_GET['q'];
    $products = json_decode($productQuantity);
    $arr=array();
    foreach ($products as $key => $product) {
        $productInfo = mysqli_fetch_object(mysqli_query($db_conn, "SELECT * from products WHERE id='$product[0]'"));
        $product[0]=$productInfo->Title;
        array_push($product,$productInfo->image,$productInfo->Category);
        array_push($arr,$product);
    }
    echo json_encode($arr);
}

if (isset($_GET['confirm'])) {
    $id = $_GET['confirm'];
    mysqli_query($db_conn, "UPDATE `orders` SET `confirmed` = 'true' WHERE `orders`.`orderId` = $id;") or die(mysqli_error($db_conn));
    echo 'Success';
}

if (isset($_GET['delivered'])) {
    $id = $_GET['delivered'];
    mysqli_query($db_conn, "UPDATE `orders` SET `delivered` = 'true' WHERE `orders`.`orderId` = $id;") or die(mysqli_error($db_conn));
    echo 'Success';
}
?>
