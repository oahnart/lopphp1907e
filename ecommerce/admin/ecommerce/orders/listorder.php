<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "../../../init.php";
    require_once ADMIN_ROOT_PATH."/components/head.php";
    ?>
    <title>List order</title>
</head>
<body>
<?php

if(!App::check_login()){
    header("location:login.php");
}

/*
 * delete category
 */
if(isset($_GET['action']) && $_GET['action']=="delete" ){
    $order_id=$_GET['order_id'];
    $query="DELETE FROM `orders` WHERE `id` = $order_id";
    mysqli_query($connection,$query);
}
/*
 * -----------------
 */

/*
 * select all category
 */
$query="SELECT * FROM orders";
$kq=mysqli_query($connection,$query);
?>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Order number</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Created date</th>
                    <th><a href="#" class="btn btn-primary">Add new order</a></th>
                </tr>
                </thead>
                <tbody>
                <?php while ($row=mysqli_fetch_array($kq)){ ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><a href="<?php echo ADMIN_ROOT_SITE ?>/ecommerce/orders/editorder.php?order_id=<?php echo $row['id'] ?>" class="btn btn-link"><?php echo $row['order_number'] ?></a>
                            </td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['status'] ?></td>
                        <td>
                            <a href="<?php echo ADMIN_ROOT_SITE ?>/ecommerce/orders/listorder.php?action=delete&order_id=<?php echo $row['id'] ?>" class="btn btn-primary btn-danger">Delete</a>
                            <a href="<?php echo ADMIN_ROOT_SITE ?>/ecommerce/orders/editorder.php?order_id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>