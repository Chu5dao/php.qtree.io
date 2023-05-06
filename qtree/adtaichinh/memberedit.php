<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>

<?php
    $us = new User();

    if (!isset($_GET['memid']) && $_GET('memid') == NULL){
        echo "<script>window.location = 'memberlist.php';</script>";
    }else{
        $adminUser = $_GET['adminUser'];
        $id = $_GET['memid'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updatemem = $us->update_mem($_POST, $id);
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Cập nhập thành viên</h2>
        <div class="block copyblock">
        <?php
            if(isset($updatemem)){
                echo $updatemem;
            }
        ?>

        <?php
            $get_mem_by_id = $us->getmembyId($id);
                if($get_mem_by_id){
                    while ($result = $get_mem_by_id->fetch_assoc()) {
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">                    
                <tr>
                    <td>
                        <label>Tên Đăng nhập</label>
                    </td>
                    <td>
                        <input type="text" name="memName" value="<?php echo $result['adminUser'] ?>" class="medium" />

                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Tên thành viên</label>
                    </td>
                    <td>
                        <input type="text" name="memNickName" value="<?php echo $result['adminName'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="email" name="memEmail" value="<?php echo $result['adminEmail'] ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Bộ phận</label>
                    </td>
                    <td>
                        <select name="chucvu" style="width: 56.70%;
                                                    padding: 4px 0px;
                                                    box-sizing: border-box;
                                                    border-width: 1px">

                            <?php
                            if($result['level']==1){
                            ?>
                            <option value="3">Tài chính</option>
                            <option selected value="1">Bán hàng</option>
                            <option value="2">Thủ Kho</option>
                            <?php
                            }if($result['level']==2){
                            ?>
                            <option value="3">Tài chính</option>
                            <option value="1">Bán hàng</option>
                            <option selected value="2">Thủ Kho</option>
                            <?php
                            }if($result['level']==3){
                            ?>
                            <option selected value="3">Tài chính</option>
                            <option value="1">Bán hàng</option>
                            <option value="2">Thủ Kho</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Store</label>
                    </td>
                    <td><select name="store" style="width: 56.70%;
                                                    padding: 4px 0px;
                                                    box-sizing: border-box;
                                                    border-width: 1px">
                            <?php
                                $us = new User();
                                $showStore = $us->show_Store();
                                if($showStore){
                                    while ($result = $showStore->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $result['addr'] ?>"><?php echo $result['addr']?></option>
                            <?php
                            }}
                            ?>
                        </select>
                    </td>
                </tr>
                
                <tr>
                    <td>
                        <label>Password mới</label>
                    </td>
                    <td>
                        <input required type="Password" name="memPass_yo" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Nhập lại Password mới</label>
                    </td>
                    <td>
                        <input required type="Password" name="memRe_Pass_yo" class="medium" />
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


