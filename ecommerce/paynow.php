<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "init_frontend.php";
    require_once FRONT_END_ROOT_PATH . "/components/head.php";
    ?>
    <title>Trang chủ</title>
</head>
<body>

<div class="container">
    <?php require_once FRONT_END_ROOT_PATH . "/components/banner_menu.php"; ?>
    <?php $msg=""; ?>
    <?php if (isset($_GET['action']) && $_GET['action'] == "pay_now") {
        //save oder
        $total = 0;
        foreach ($_SESSION['cart'] as $key => $product) {
            $current_price = $product['sale_price'] != 0 ? $product['sale_price'] : $product['price'];
            $total_current_product = $current_price * $product['quality'];
            $total += $total_current_product;
        }

        //save info contact
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $user = App::get_user();
        $user_id = $user->id;
        $query = "INSERT INTO `customers` (`id`, `user_id`, `last_name`, `first_name`, `phone_number`, `address`, `block`) 
                VALUES (NULL, '$user_id', '$last_name', '$first_name', '$phone_number', '$address', '0');";
        mysqli_query($connection, $query);
        $new_customer_insert_id = mysqli_insert_id($connection);
        $random_order_number = mt_rand(1, time());
        $query="INSERT INTO `orders` 
                (`id`, `order_number`, `customer_id`, `status`, `total`)
        VALUES (NULL, 'ORDER_$random_order_number', '$new_customer_insert_id', 'pending', '$total');";
        mysqli_query($connection, $query);
        $new_order_insert_id = mysqli_insert_id($connection);
        foreach ($_SESSION['cart'] as $key => $product) {
            $product_id=$product['product_id'];
            $current_price = $product['sale_price'] != 0 ? $product['sale_price'] : $product['price'];
            $total_current_product = $current_price * $product['quality'];
            $query="INSERT INTO `order_product` 
                    (`order_id`, `product_id`, `price`) 
            VALUES ('$new_order_insert_id', '$product_id', '$total_current_product');";
            mysqli_query($connection, $query);

        }
        $msg="Cám ơn bạn đã mua hàng của chúng tôi";
        $_SESSION['cart']=array();

    } ?>
    <h3><?php echo $msg ?></h3>
    <a href="<?php echo FRONT_END_ROOT_SITE ?>">Quay về trang chủ</a>
    <?php require_once FRONT_END_ROOT_PATH . "/components/footer.php"; ?>


</div>
</body>
</html>