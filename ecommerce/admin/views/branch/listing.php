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