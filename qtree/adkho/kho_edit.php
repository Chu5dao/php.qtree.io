<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/ncc.php';?>
<?php include '../classes/productkho.php';?>

<?php
    $pk = new ProKho();

    if (!isset($_GET['productid']) && $_GET('productid') == NULL){
        echo "<script>window.location = 'kholist.php';</script>";
    }else{
        $id = $_GET['productid'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $pk->update_product($_POST, $id);
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
            $get_product_by_id = $pk->getproductbyId($id);
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
                        <label>Giá</label>
                    </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $result_product['price'] ?>" placeholder="Nhập giá..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Số lượng</label>
                    </td>
                    <td>
                        <input type="number" name="quantity" value="<?php echo $result_product['quantity'] ?>" placeholder="Nhập số lượng..." class="medium" />
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
                            <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName']?></option>
                            <?php
                            }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nhà cung cấp</label>
                    </td>
                    <td>
                        <select id="select" name="NCC">
                            <option>---Chọn Nhà cung cấp---</option>
                            <?php
                            $nc = new Ncc();
                            $ncclist = $nc->show_NCC();
                            if($ncclist){
                                while ($result = $ncclist->fetch_assoc()) {
                            ?>
                            <option value="<?php echo $result['idNcc'] ?>"><?php echo $result['nameNcc']?></option>
                            <?php
                            }
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                
            

                


                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
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


