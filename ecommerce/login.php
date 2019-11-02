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
<?php
if(App::check_login()){
    header("Location:index.php");
}
if(isset($_GET['action']) && $_GET['action']=="login"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password1=md5($password);
    $query="SELECT * FROM users WHERE username='$username' AND password='$password1' AND block='0' AND type='client'";

    $kg=mysqli_query($connection,$query);
    $user=$kg->fetch_assoc();
    $json_user=json_encode($user);
    if(isset($user['id']) && $user['id']>0){
        $_SESSION['client_user']=$json_user;
        header("Location: checkout.php");
    }else{
        header("Location: checkout.php");
    }
}
?>
<div class="container">
    <?php require_once FRONT_END_ROOT_PATH."/components/banner_menu.php"; ?>

    <section class="area-login">
        <div class="row">
            <?php if(!App::check_login()){ ?>
                <div class="col-md-12">
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
        </div>

    </section>
    <?php require_once FRONT_END_ROOT_PATH."/components/footer.php"; ?>


</div>
</body>
</html>