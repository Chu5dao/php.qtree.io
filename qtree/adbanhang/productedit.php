<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>

<?php
    $pd = new Product();

    if (!isset($_GET['productid']) && $_GET('productid') == NULL){
        echo "<script>window.location = 'productlist.php';</script>";
    }else{
        $id = $_GET['productid'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $pd->update_product($_POST, $_FILES, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
        <?php
            if(isset($updateProduct)){
                echo $updateProduct;
            }
        ?>
        <?php
            $get_product_by_id = $pd->getproductbyId($id);
                if($get_product_by_id){
                    while ($result_product = $get_product_by_id->fetch_assoc()) {
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
        <br>
                <tr>
                    <td>
                        <label>Tên sản phẩm</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $result_product['productName'] ?>" placeholder="Nhập tên sản phẩm..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Danh mục sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>-------Chọn Danh mục-------</option>
                            <?php
                            $cat = new Category();
                            $catlist = $cat->show_category();
                            if($catlist){
                                while ($result = $catlist->fetch_assoc()) {
                            ?>
                            <option
                            <?php
                            if($result['catId']==$result_product['catId']){
                                echo 'selected';}
                            ?>
                            value="<?php echo $result['catId'] ?>"><?php echo $result['catName']?></option>
                            <?php
                            }
                            }
                            ?>

                        </select>
                    </td>
                </tr>
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Mô tả sản phẩm</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_product['price'] ?>" placeholder="Nhập giá..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Hình ảnh</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_product['image'] ?>" width="90"><br>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Kiểu sản phẩm</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>-------Chọn Kiểu-------</option>
                            <?php
                            if($result_product['type']==0){
                            ?>
                            <option value="1">Nổi bật</option>
                            <option selected value="0">Không nổi bật</option>
                            <?php
                            }else{
                            ?>
                            <option selected value="1">Nổi bật</option>
                            <option value="0">Không nổi bật</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php
            }
            }?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


