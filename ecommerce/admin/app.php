<?php
define("ADMIN_ROOT_PATH",__DIR__);
define("ADMIN_ROOT_SITE","http://localhost/lopphp1907E/ecommerce/admin/");
//Todo sẽ sủ lý sau


class App
{
    static function check_login(){
        //viết code kiểm tra xem login
        //tạm thời cứ để login đã
        $user= $_SESSION['user'];
        $user=json_decode($user);
        if($user->id>0){
            return true;
        }
        return false;
    }
    static function get_user(){
        //viết code kiểm tra xem login
        //tạm thời cứ để login đã
        $user= $_SESSION['user'];
        $user=json_decode($user);
        if($user->id>0){
            return $user;
        }
        return null;
    }

}
