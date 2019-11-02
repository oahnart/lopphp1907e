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
$product_id=$_GET['product_id'];

if(isset($_POST['save']) || isset($_POST['save_close'])){
    $title=$_POST['title'];
    $ordering=$_POST['ordering'];
    $published=$_POST['published'];
    $price=$_POST['price'];
    $sale_price=$_POST['sale_price'];
    $short_description=$_POST['short_description'];
    $full_description=$_POST['full_description'];
    $query="UPDATE `products`
            SET `title` = '$title',
            `ordering` = '$ordering',
            `published` = '$published',
            `price` = '$price',
            `sale_price` = '$sale_price',
            `short_description` = '$short_description',
            `full_description` = '$full_description'
             WHERE `id` = $product_id;";
    mysqli_query($connection,$query);
    if(isset($_POST['save_close'])){
        header("location:".ADMIN_ROOT_SITE."/ecommerce/products/listproduct.php");
    }
}

$query="SELECT * FROM products WHERE id='$product_id'";
$kq=mysqli_query($connection,$query);
$product=$kq->fetch_assoc();
$link_product='/ecommerce/products/editproduct.php';


?>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <form action="<?php echo ADMIN_ROOT_SITE.$link_product ?>?product_id=<?php echo $product['id'] ?>" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <td><?php echo $product['id'] ?></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><input type="text" name="title" value="<?php echo $product['title'] ?>"></td>
                    </tr>
                    <tr>
                    <th>Product price</th>
                    <td><input type="text" name="price" value="<?php echo $product['price'] ?>"></td>
                    </tr>
                    <tr>
                        <th>Sale price</th>
                        <td><input type="text" name="sale_price" value="<?php echo $product['sale_price'] ?>"></td>
                    </tr>
                    <tr>
                        <th>Ordering</th>
                        <td><input type="text" name="ordering" value="<?php echo $product['ordering'] ?>"></td>
                    </tr>
                    <tr>
                        <th>Old product ?</th>
                        <td>
                            <select name="product_old">
                                <option value="1" <?php echo $product['product_old']==1?' selected ':'' ?>>Yes</option>
                                <option value="0" <?php echo $product['product_old']==0?' selected ':'' ?>>No</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th>Short description</th>
                        <td>
                            <textarea name="short_description" class="form-control" rows="5"><?php echo $product['short_description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Full description</th>
                        <td>
                            <textarea id="full_description" name="full_description" class="form-control" rows="5"><?php echo $product['full_description'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="published">
                                <option value="1" <?php echo $product['published']==1?' selected ':'' ?>>published</option>
                                <option value="0" <?php echo $product['published']==0?' selected ':'' ?>>unpublished</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary" name="save">Apply</button>
                                <button type="submit" class="btn btn-primary" name="save_close">Save & close</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace( 'full_description' );
</script>
</body>
</html>