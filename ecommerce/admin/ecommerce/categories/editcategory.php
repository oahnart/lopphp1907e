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
$category_id=$_GET['category_id'];

if(isset($_POST['save']) || isset($_POST['save_close'])){
    $title=$_POST['title'];
    $ordering=$_POST['ordering'];
    $published=$_POST['published'];
    $query="UPDATE `categories` SET `title` = '$title',`ordering` = '$ordering',`published` = '$published' WHERE `categories`.`id` = $category_id;";
    mysqli_query($connection,$query);
    if(isset($_POST['save_close'])){
        header("location:".ADMIN_ROOT_SITE."/ecommerce/categories/listcategory.php");
    }
}

$query="SELECT * FROM categories WHERE id='$category_id'";
$kq=mysqli_query($connection,$query);
$category=$kq->fetch_assoc();
$link_catgory='/ecommerce/categories/editcategory.php';


?>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <form action="<?php echo ADMIN_ROOT_SITE.$link_catgory ?>?category_id=<?php echo $category['id'] ?>" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Id</th>
                        <td><?php echo $category['id'] ?></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td><input type="text" name="title" value="<?php echo $category['title'] ?>"></td>
                    </tr>
                    <tr>
                        <th>Ordering</th>
                        <td><input type="text" name="ordering" value="<?php echo $category['ordering'] ?>"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="published">
                                <option value="1" <?php echo $category['published']==1?' selected ':'' ?>>published</option>
                                <option value="0" <?php echo $category['published']==0?' selected ':'' ?>>unpublished</option>
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
</body>
</html>