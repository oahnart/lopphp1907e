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
/*
 * save when add new
 */
if(isset($_POST['add-new'])){
    $title=$_POST['title'];
    $ordering=$_POST['ordering'];
    $published=$_POST['published'];
    $query="INSERT INTO `categories` (`id`, `title`, `ordering`, `published`) VALUES (NULL, '$title', '$ordering', '$published');";
    mysqli_query($connection,$query);
}
/*
 * ---------------
 */
/*
 * delete category
 */
if(isset($_GET['action']) && $_GET['action']=="delete" ){
    $category_id=$_GET['category_id'];
    $query="DELETE FROM `categories` WHERE `categories`.`id` = $category_id";
    mysqli_query($connection,$query);
}
/*
 * -----------------
 */

/*
 * select all category
 */
$query="SELECT * FROM categories";
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
                        <th>Title</th>
                        <th>Ordering</th>
                        <th>Status</th>
                        <th><a href="<?php echo ADMIN_ROOT_SITE ?>ecommerce/categories/addcategory.php" class="btn btn-primary">Add category</a></th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row=mysqli_fetch_array($kq)){ ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['ordering'] ?></td>
                        <td><?php echo $row['published'] ?></td>
                        <td><a href="<?php echo ADMIN_ROOT_SITE ?>ecommerce/categories/listcategory.php?action=delete&category_id=<?php echo $row['id'] ?>" class="btn btn-primary btn-danger">Delete</a><a href="<?php echo ADMIN_ROOT_SITE ?>/ecommerce/categories/editcategory.php?category_id=<?php echo $row['id'] ?>" class="btn btn-primary">Edit</a></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>