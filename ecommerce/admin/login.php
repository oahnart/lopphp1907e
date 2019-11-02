<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "../init.php";
    require_once ADMIN_ROOT_PATH."/components/head.php";
    ?>
    <title>Login</title>
</head>
<body>
<?php

if(App::check_login()){
    header("Location: index.php");
}
if(isset($_POST['login'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $password1=md5($password);
    $query="SELECT * FROM users WHERE username='$username' AND password='$password1' AND block='0' AND (type='admin' OR type='published')";
    $kg=mysqli_query($connection,$query);
    $user=$kg->fetch_assoc();
    $json_user=json_encode($user);
    if(isset($user['id']) && $user['id']>0){
        $_SESSION['user']=$json_user;
        header("Location: index.php");
    }

}

?>
<div class="wrapper-login-page">
    <form action="login.php" method="post">
        <table class="table table-bordered" style="margin: 40px auto">
            <tr>
                <td>Username</td>
                <td><input class="form-control" type="text" name="username"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input class="form-control" type="password" name="password"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button class="btn btn-primary btn-login" name="login" type="submit">Login</button>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>