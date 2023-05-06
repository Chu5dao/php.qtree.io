<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/ncc.php';?>
<?php
    $nc = new Ncc();
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $delcat = $nc->del_ncc($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh mục sản phẩm</h2>
                <br>
                <?php
                if(isset($delcat)){
                    echo $delcat;
                }?>
                <div class="block">
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Tên Nhà cung cấp</th>
								<th>Địa chỉ NCC</th>
								<th>Hành động</th>
							</tr>
						</thead>
					<tbody>
						<?php
							$show_ncc = $nc->show_NCC();
							if($show_ncc){
								$i = 0;
								while ($result = $show_ncc->fetch_assoc()) {
									$i++;
								?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['nameNcc'] ?></td>
								<td><?php echo $result['dia_chi'] ?></td>
								<td><a href="NCCedit.php?id=<?php echo $result['idNcc'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa???')" href="?delid=<?php echo $result['idNcc'] ?>">Xóa</a></td>
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

