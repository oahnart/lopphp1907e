<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "../../../init.php";
    require_once ADMIN_ROOT_PATH."/components/head.php";
    ?>
    <title>Index</title>
</head>
<body>
<?php

if(!App::check_login()){
    header("location:login.php");
}
$order_id=$_GET['order_id'];

if(isset($_POST['save']) || isset($_POST['save_close'])){
    $status=$_POST['status'];
    $published=$_POST['published'];
    $query="UPDATE `orders` SET `status` = '$status' WHERE `orders`.`id` = $order_id;";
    mysqli_query($connection,$query);
    if(isset($_POST['save_close'])){
        header("location:".ADMIN_ROOT_SITE."/ecommerce/orders/listorder.php");
    }
}

$query="SELECT orders.*,
        cus.last_name AS cus_last_name,cus.first_name AS cus_first_name,
        cus.phone_number AS cus_phone_number,cus.address AS cus_address
         FROM orders
        LEFT JOIN customers AS cus ON cus.id=orders.customer_id
        WHERE orders.id='$order_id'
";

$kq=mysqli_query($connection,$query);
$order=$kq->fetch_assoc();

$query2="SELECT products.*,order_product.price AS order_product_price FROM products
            LEFT JOIN order_product ON order_product.product_id=products.id
            WHERE order_product.order_id=$order_id
";
$link_edit_order='/ecommerce/orders/editorder.php';
$kq2=mysqli_query($connection,$query2);



?>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <form action="<?php echo ADMIN_ROOT_SITE.$link_edit_order ?>?order_id=<?php echo $order['id'] ?>" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <td><?php echo $order['id'] ?></td>
                    </tr>
                    <tr>
                        <th>Full name</th>
                        <td><?php echo $order['cus_last_name'] ?> <?php echo $order['cus_first_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Order number</th>
                        <td><?php echo $order['order_number'] ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $order['cus_phone_number'] ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $order['cus_address'] ?></td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td><?php echo $order['total'] ?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="status">
                                <option value="pending" <?php echo $order['status']=="pending"?' selected ':'' ?>>Pending</option>
                                <option value="process" <?php echo $order['status']=="process"?' selected ':'' ?>>Process</option>
                                <option value="confirm" <?php echo $order['status']=="confirm"?' selected ':'' ?>>Confirm</option>
                                <option value="shipping" <?php echo $order['status']=="shipping"?' selected ':'' ?>>Shipping</option>
                                <option value="completed" <?php echo $order['status']=="completed"?' selected ':'' ?>>Completed</option>
                            </select>
                        </td>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product name</th>
                            <th>price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($product=mysqli_fetch_array($kq2)){ ?>
                            <tr>
                                <td><?php echo $product['id'] ?></td>
                                <td><?php echo $product['title'] ?></td>
                                <td><?php echo $product['order_product_price'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary" name="save">Apply</button>
                            <button type="submit" class="btn btn-primary" name="save_close">Save & close</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>