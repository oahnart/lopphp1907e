<?php
class ModelBranch{
    function getListing(){
        $connection=mysqli_connect("localhost","root","","php1907e_db_1") or die("can not connect database");
        $query="SELECT * FROM branch";
        $kq=mysqli_query($connection,$query);
        $list=array();
        while ($row=mysqli_fetch_array($kq)){
            $list[]=$row;
        }
        return $list;

    }
    /*
     * Listing
     */
    function get($task){

        if(method_exists($this,"get$task")){
            return call_user_func(array($this, "get$task"));
        }
        return null;

    }
}
?>