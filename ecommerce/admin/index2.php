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
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <?php
            if(isset($_GET['controller'])){
                $control=$_GET['controller'];//branch
                $file_control=ADMIN_ROOT_PATH."/controllers/$control.php";

                $task=isset($_GET['task'])?$_GET['task']:'listing';//listing
                if(file_exists($file_control)){

                    require_once $file_control;
                    $control_class_name= "Controller$control";
                    $control_class=new $control_class_name();
                    if(method_exists($control_class,$task)){
                        call_user_func(array($control_class, $task));
                    }else{
                        echo "function <b>$task</b> trong class $control_class_name không tồn tại";
                    }


                }
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>