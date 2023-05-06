<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/ncc.php';?>
<?php
    $nc = new Ncc();
    if (!isset($_GET['id']) && $_GET('id') == NULL){
        echo "<script>window.location = 'NCClist.php';</script>";
    }else{
        $id = $_GET['id'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name_NCC = $_POST['name_NCC'];
        $dia_chiNCC = $_POST['dia_chiNCC'];
        $updateNCC = $nc->update_NCC($name_NCC,$id,$dia_chiNCC);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa Nhà cung cấp</h2>
               <div class="block copyblock">
                <?php
                if(isset($updateNCC)){
                    echo $updateNCC;
                }?>
                <?php
                    $get_NCC_name = $nc->getNCCbyId($id);
                    if($get_NCC_name){
                        while ($result = $get_NCC_name->fetch_assoc()){
                ?>
                 <form acction="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input required type="text" value="<?php echo $result['nameNcc'] ?>" name="name_NCC" placeholder="Sửa Nhà cung cấp ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input required type="text" value="<?php echo $result['dia_chi'] ?>" name="dia_chiNCC" placeholder="Sửa Địa chỉ Nhà cung cấp ..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php
                    }
                    }
                    ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>