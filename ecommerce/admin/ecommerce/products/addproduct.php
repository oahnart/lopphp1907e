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

if(isset($_POST['save']) || isset($_POST['save_close'])){
    $title=$_POST['title'];
    $short_description=$_POST['short_description'];
    $full_description=$_POST['full_description'];
    $price=$_POST['price'];
    $sale_price=$_POST['sale_price'];
    $ordering=$_POST['ordering'];
    $published=$_POST['published'];
    $product_old=$_POST['product_old'];
    $query="INSERT INTO `products`
            (`id`, `title`, `image_intro`, `short_description`, `full_description`, `ordering`, `price`, `sale_price`, `published`, `product_old`) 
    VALUES (NULL, '$title', '', '$short_description', '$full_description', '$ordering', '$price', '$sale_price', '$published', '$product_old');";
    mysqli_query($connection,$query);
    $new_product_insert_id=mysqli_insert_id($connection);
    if(isset($_POST['save_close'])){
        header("location:".ADMIN_ROOT_SITE."/ecommerce/products/listproduct.php");
    }
    if(isset($_POST['save'])){
        header("location:".ADMIN_ROOT_SITE."/ecommerce/products/editproduct.php?product_id=".$new_product_insert_id);
    }
}

$query="SELECT * FROM products WHERE id='$product_id'";
$kq=mysqli_query($connection,$query);
$product=$kq->fetch_assoc();
$link_add_product='ecommerce/products/addproduct.php';


?>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <form action="<?php echo ADMIN_ROOT_SITE.$link_add_product ?>" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Product name</th>
                        <td><input type="text" name="title" value=""></td>
                    </tr>
                    <tr>
                        <th>Product price</th>
                        <td><input type="text" name="price" value=""></td>
                    </tr>
                    <tr>
                        <th>Sale price</th>
                        <td><input type="text" name="sale_price" value=""></td>
                    </tr>
                    <tr>
                        <th>Ordering</th>
                        <td><input type="text" name="ordering" value=""></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="published">
                                <option value="1" >published</option>
                                <option value="0" >unpublished</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Old product ?</th>
                        <td>
                            <select name="product_old">
                                <option value="1" >Yes</option>
                                <option value="0">No</option>
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