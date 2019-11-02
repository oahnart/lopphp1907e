<?php
$query="SELECT * FROM `products` WHERE product_old=1";
$kq=mysqli_query($connection,$query);
?>
<div class="module-new-product">
<h3>New products</h3>
<div class="row">
    <?php
    while ($row = mysqli_fetch_array($kq)) {
        ?>
        <div class="col-md-3">
            <div class="item-product">
                <div class="wrapper-content-image">anh se hien thi o day</div>
                <div class="item-footer">
                    <h3><?php echo $row['title'] ?></h3>
                    <div>
                        Old price:<span><?php echo $row['price'] ?> đ</span>
                        <br/>
                        Sale price:<span><?php echo $row['sale_price'] ?> đ</span>
                    </div>
                    <a href="<?php echo FRONT_END_ROOT_SITE ?>cart.php?action=add_to_cart&product_id=<?php echo $row['id'] ?>" class="btn btn-primary">Add to cart</a>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>
</div>