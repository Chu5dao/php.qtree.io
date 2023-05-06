<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/user.php';?>

<?php
    $us = new User();
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $delstore = $us->del_store($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách chi nhánh</h2>
        <br>
        	<?php
        	if(isset($delstore)){
        		echo $delstore;
        	}
        	?>
        <div class="block">
        
        	
            <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Địa chỉ</th>
						<th>Phone</th>
						<th>Email</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$us = new User();
					$storelist = $us->show_Store();
					if($storelist){
						$i = 0;
						while ($result = $storelist->fetch_assoc()) {
							$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i ?></td>
						<td><?php echo $result['addr'] ?></td>
						<td><?php echo $result['phone'] ?></td>
						<td><?php echo $result['email'] ?></td>


					 
						<td><a href="storeedit.php?id=<?php echo $result['id'] ?>&addr=<?php echo $result['addr'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa???')" href="?id=<?php echo $result['id'] ?>">Xóa</a></td>
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
