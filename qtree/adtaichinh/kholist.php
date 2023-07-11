<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/ncc.php';?>
<?php include '../classes/productkho.php';?>
<?php include_once '../helpers/format.php';;?>

<?php

    $fm = new Format();
	$pk = new ProKho();

    if(isset($_GET['productid'])){
        $id = $_GET['productid'];
        $delpro = $pk->del_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm Kho đã nhập</h2>
        <br>
			<?php
        	if(isset($delpro)){
        		echo $delpro;
        	}
        	?>
        <div class="block">
        
        	
            <table class="data display datatable" id="example"  style="position: relative; ">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên sản phẩm</th>
						<th>Giá sản phẩm</th>
						<th>Số lượng nhập</th>
						<th>Danh mục sản phẩm</th>
						<th>Nhà cung cấp</th>
						<th>Tổng chi</th>
						<th>Hành động</th>

					</tr>
				</thead>
				<tbody>
					<?php
					$pk = new ProKho();
					$pdlist = $pk->show_product();
					if($pdlist){
						$tong = 0;
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i ?></td>
						<td><?php echo $result['productName'] ?></td>
						<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?></td>
						<td><?php echo $result['quantity'] ?></td>
						<td><?php echo $result['catName'] ?></td>
						<td><?php echo $result['nameNcc'] ?></td>
						<td><?php $tong = $result['price'] * $result['quantity']; echo  $fm->format_currency($tong). " VNĐ"?></td>
						<td><a onclick="return confirm('Bạn có muốn xóa???')" href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td>
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
