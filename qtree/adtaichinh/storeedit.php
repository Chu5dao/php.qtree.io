<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>

<?php
    $us = new User();

    if (!isset($_GET['id']) && $_GET('id') == NULL){
        echo "<script>window.location = 'storelist.php';</script>";
    }else{
        $addr = $_GET['addr'];
        $id = $_GET['id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateStore = $us->update_store($_POST, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhập chi nhánh</h2>
        <div class="block copyblock">
        <?php
            if(isset($updateStore)){
                echo $updateStore;
            }
        ?>

        <?php
            $get_store_by_id = $us->getstorebyId($id);
                if($get_store_by_id){
                    while ($result = $get_store_by_id->fetch_assoc()) {
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">                    
                <tr>
                    <td>
                        <label>Địa chỉ</label>
                    </td>
                    <td>
                        <input required type="text" name="diachi" value="<?php echo $result['addr'] ?>" class="medium" />

                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Phone</label>
                    </td>
                    <td>
                        <input required type="number" name="sđt" value="<?php echo $result['phone'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input required type="email" name="Email" value="<?php echo $result['email'] ?>" class="medium" />
                    </td>
                </tr>

                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Cập nhập" />
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


