<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/ncc.php';?>
<?php
    $nc = new Ncc();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $ncc = $_POST['ncc'];
        $diachi = $_POST['diachi'];

        $insertNCC = $nc->insert_ncc($ncc,$diachi);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm Nhà cung cấp</h2>
               <div class="block copyblock">
                <?php
                if(isset($insertNCC)){
                    echo $insertNCC;
                }?>
                 <form acction="catadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input required type="text" name="ncc" placeholder="Thêm Nhà Cung Cấp ở đây..." class="medium" />
                            </td>

                        </tr>
                        <tr>
                            <td>
                                <input required type="text" name="diachi" placeholder="Thêm Địa chỉ NCC ở đây..." class="medium" />
                            </td>
                            
                        </tr>
						<tr> 
                            <td>
                                <input required type="submit" name="submit" Value="Thêm" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>