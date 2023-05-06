<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>
<?php
    $us = new User();
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $delmem = $us->del_mem($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thành viên</h2>
                <br>
                <?php
                if(isset($delmem)){
                    echo $delmem;
                }?>
                <div class="block">
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Tên đăng nhập</th>
								<th>Tên</th>
								<th>Email</th>
								<th>Bộ phận</th>
								<th>Địa chỉ bộ phận</th>
								<th>Hành động</th>
							</tr>
						</thead>
					<tbody>
						<?php
    						$us = new User();
							$show_member = $us->show_member();
							if($show_member){
								$i = 0;
								while ($result = $show_member->fetch_assoc()) {
									$i++;
								?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['adminUser'] ?></td>
								<td><?php echo $result['adminName'] ?></td>
								<td><?php echo $result['adminEmail'] ?></td>
								<td><?php
									if($result['level']==1){
										echo 'Bộ phận Bán Hàng';
									}if($result['level']==2){
										echo 'Bộ phận Thủ Kho';
									}if($result['level']==3){
										echo 'Admin - Bộ phận Kế toán';
									}
								?></td>
								<td><?php echo $result['store'] ?></td>

								<td><a href="memberedit.php?memid=<?php echo $result['adminId'] ?>&adminUser=<?php echo $result['adminUser'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa???')" href="?delid=<?php echo $result['adminId'] ?>">Xóa</a></td>
							</tr>
						<?php
						}
						}
						?>
					</tbody>
					</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
	$(document).ready(function () {
	    setupLeftMenu();

	    $('.datatable').dataTable();
	    setSidebarHeight();
	});
</script>
<?php include 'inc/footer.php';?>

