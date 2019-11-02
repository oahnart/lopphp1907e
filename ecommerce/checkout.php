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
$user=App::get_user();
?>
<div class="container">
    <?php require_once FRONT_END_ROOT_PATH."/components/banner_menu.php"; ?>
    <div class="row">
        <?php if(!App::check_login()){ ?>
            <div class="col-md-6">
                <h3>Login</h3>
                <form action="<?php echo FRONT_END_ROOT_SITE ?>login.php?action=login" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Remember password
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        <?php } ?>
        <?php if(!App::check_login()){ ?>
            <div class="col-md-6">
                <h3>Register</h3>
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <input type="file" id="exampleInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"> Check me out
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </form>
            </div>
        <?php } ?>
    </div>

        <div class="row">
            <?php if($user){ ?>
                <div class="col-md-6">
                    <form action="<?php echo FRONT_END_ROOT_SITE ?>paynow.php?action=pay_now" method="post">
                        <p>Full name: <?php echo $user->full_name ?></p>
                        <h4>Contact info</h4>
                        <input type="text" class="form-control" value="<?php echo $user->email ?>">
                        <h4>Address shipping</h4>
                        <table class="table table-bordered">
                            <tr>
                                <th>First name</th>
                                <th><input class="form-control" name="first_name"></th>
                            </tr>
                            <tr>
                                <th>Last name</th>
                                <th><input class="form-control" name="last_name"></th>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <th><input class="form-control" name="phone_number"></th>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <th><textarea name="address" class="form-control"></textarea></th>
                            </tr>
                            <tr>
                                <th colspan="2" style="text-align: right"><button type="submit" class="btn btn-primary">Pay now</button></th>
                            </tr>
                        </table>
                    </form>
                </div>
            <?php } ?>
            <div class="col-md-6">
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
                            </tfoot>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    <?php require_once FRONT_END_ROOT_PATH."/components/footer.php"; ?>


</div>

</body>
</html>