<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>
<?php
    $us = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $Diachi = $_POST['Diachi'];
        $Phone = $_POST['Phone'];
        $Email = $_POST['Email'];

        $insertStore = $us->insert_store($Diachi,$Phone,$Email);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm Chi nhánh</h2>
               <div class="block copyblock">
                <?php
                if(isset($insertStore)){
                    echo $insertStore;
                }?>
                 <form acction="storeadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input required type="text" name="Diachi" placeholder="Thêm địa chỉ ở đây..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input required type="text" name="Phone" placeholder="Thêm SĐT của cửa hàng ở đây..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input required type="text" name="Email" placeholder="Thêm Email của cửa hàng ở đây..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Thêm" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>