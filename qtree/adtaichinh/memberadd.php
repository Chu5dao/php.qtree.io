<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>
<?php
    $us = new User();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertMem = $us->insert_member($_POST);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Thêm thành viên</h2>
               <div class="block copyblock">
                <?php
                if(isset($insertMem)){
                    echo $insertMem;
                }?>
                 <form acction="memberadd.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input required type="text" name="memName" placeholder="Tên đăng nhập..." class="medium" />
                                <input required type="text" name="memNickName" placeholder="Nick name..." class="medium" />
                                <input required type="email" name="memEmail" placeholder="Email..." class="medium" />
                                <select required name="chucvu" style="width: 56.70%;
                                                            padding: 4px 0px;
                                                            box-sizing: border-box;
                                                            border-width: 1px">
                                    <option value="">Bộ Phận</option>
                                    <option value="3">Tài chính</option>
                                    <option value="1">Bán hàng</option>
                                    <option value="2">Thủ Kho</option>
                                </select>
                                <select required name="store" style="width: 56.70%;
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
                                <input required type="Password" name="memPass" placeholder="Password..." class="medium" />
                                <input required type="Password" name="memRe_Pass" placeholder="Nhập lại Password..." class="medium" />
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