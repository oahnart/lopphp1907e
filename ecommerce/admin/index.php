<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "../init.php";
    require_once ADMIN_ROOT_PATH."/components/head.php";
    ?>
    <title>Index</title>
</head>
<body>
<?php
require_once "../init.php";
if(!App::check_login()){
    header("location:login.php");
}




?>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <?php if(isset($_GET['msg'])){ ?>
    <div class="row">
        <div class="col-md-12"><div class="alert alert-danger"><?php echo $_GET['msg'] ?></div></div>
    </div>
    <?php } ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">noi dung cua index</div>
    </div>
</div>
</body>
</html>