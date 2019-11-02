<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "init_frontend.php";
    require_once FRONT_END_ROOT_PATH."/components/head.php";
    ?>
    <title>Trang chủ</title>
</head>
<body>

<div class="container">
    <?php require_once FRONT_END_ROOT_PATH."/components/banner_menu.php"; ?>

    <section class="promotion-product">
        <?php require_once FRONT_END_ROOT_PATH."/modules/promo_product.php"; ?>
    </section>
    <section class="new-product">
        <?php require_once FRONT_END_ROOT_PATH."/modules/new_product.php"; ?>
    </section>
    <?php require_once FRONT_END_ROOT_PATH."/components/footer.php"; ?>


</div>
</body>
</html>