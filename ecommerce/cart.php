<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "init_frontend.php";
    require_once FRONT_END_ROOT_PATH."/components/head.php";
    ?>
    <title>Cart</title>
</head>
<body>
<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}
if (isset($_GET['action']) && $_GET['action'] === "add_to_cart") {
    $product_id = $_GET['product_id'];
    $query = "SELECT * FROM products WHERE  id = $product_id AND published=1";
    $kq = mysqli_query($connection, $query);
    $product = $kq->fetch_assoc();
    if(!$product){
        header("location: index.php");
    }
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quality']++;
    } else {
        $_SESSION['cart'][$product_id] = array(
            "product_id" => $product_id,
            "title" => $product['title'],
            "price" => $product['price'],
            "sale_price" => $product['sale_price'],
            "quality" => 1
        );
    }

}
?>
<div class="container">
    <?php require_once FRONT_END_ROOT_PATH."/components/banner_menu.php"; ?>
    <div class="row">
        <div class="col-md-12">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Product name</th>
                    <th>Old price</th>
                    <th>New price</th>
                    <th>Quality</th>
                    <th>Sub price</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $total=0;
                ?>
                <?php foreach ($_SESSION['cart'] as $key=> $product){ ?>
                    <?php
                    $current_price=$product['sale_price']!=0?$product['sale_price']:$product['price'];
                    $total_current_product=$current_price*$product['quality'];
                    $total+=$total_current_product;
                    ?>
                    <tr>
                        <td><?php echo $product['id'] ?></td>
                        <td><?php echo $product['title'] ?></td>
                        <td><?php echo $product['price'] ?></td>
                        <td><?php echo $product['sale_price'] ?></td>
                        <td><?php echo $product['quality'] ?></td>
                        <td><?php echo $total_current_product ?></td>
                    </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                    <th colspan="5">Total</th>
                    <th><?php echo $total ?></th>
                </tr>
                <tr>
                    <th style="text-align: right" colspan="6"><a href="<?php echo FRONT_END_ROOT_SITE ?>checkout.php" class="btn btn-primary">Checkout</a></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <?php require_once FRONT_END_ROOT_PATH."/components/footer.php"; ?>


</div>

</body>
</html>