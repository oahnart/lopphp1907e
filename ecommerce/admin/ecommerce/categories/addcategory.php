<!doctype html>
<html lang="en">
<head>
    <?php
    require_once "../../../init.php";
    ?>
    <?php include_once ADMIN_ROOT_PATH."/components/head.php"?>
    <title>Document</title>
</head>
<body>
<div class="container">
    <?php include_once ADMIN_ROOT_PATH."/components/top_header.php" ?>
    <div class="row">
        <?php include_once ADMIN_ROOT_PATH."/components/negative.php" ?>
        <div class="col-md-9">
            <form action="<?php echo ADMIN_ROOT_SITE ?>ecommerce/categories/listcategory.php" method="post">
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td><input type="text" name="title"></td>
                    </tr>
                    <tr>
                        <th>Ordering</th>
                        <td><input type="text" name="ordering"></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            <select name="published">
                                <option value="1">published</option>
                                <option value="0">unpublished</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button class="btn btn-primary" name="add-new">Save</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>