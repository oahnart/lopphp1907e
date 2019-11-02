<?php
class ControllerBranch{
    function listing(){
        //kiêm tra xem với user này có quyền xem danh sách branch hay không
        $user=App::get_user();
        if($user->type!="admin"){
            $msg="you cannot access branch";
            header("Location:".ADMIN_ROOT_SITE."/index.php?msg=$msg");
        }
        $this->display("branch",'listing',"listing");

    }
    function display($view,$task,$layout){
        $model=$this->getModel('branch');
        //function getListing()
        $listing_branch=$model->get($task);
        $file_view=ADMIN_ROOT_PATH."/views/$view/$layout.php";
        if(file_exists($file_view)){
            require_once $file_view;
        }

    }
    function getModel($model_name){
        $file_model=ADMIN_ROOT_PATH."/models/$model_name.php";
        if(file_exists($file_model)){
            require_once $file_model;
            $model_class_name= "Model$model_name";
            $model_class=new $model_class_name();
            return $model_class;
        }
        return null;
    }
    function edit(){
        echo "hello edit";
    }
}
?>