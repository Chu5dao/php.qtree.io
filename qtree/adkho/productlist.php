<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';;?>

<?php
    $pd = new Product();
    $fm = new Format();
    if(isset($_GET['productid'])){
        $id = $_GET['productid'];
        $delpro = $pd->del_product($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm ở Store</h2>
        <br>
        	<?php
        	if(isset($delpro)){
        		echo $delpro;
        	}
        	?>
        <div class="block">
        
        	
            <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tên sản phẩm</th>
						<th>Giá sản phẩm</th>
						<th>Danh mục sản phẩm</th>
						<th>Hình ảnh</th>
						<th>Kiểu sản phẩm</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$pd = new Product();
					$pdlist = $pd->show_product();
					if($pdlist){
						$i = 0;
						while ($result = $pdlist->fetch_assoc()) {
							$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i ?></td>
						<td><?php echo $result['productName'] ?></td>
						<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?></td>
						<td><?php echo $result['catName'] ?></td>
						<td><img src="uploads/<?php echo $result['image'] ?>" width="70"></td>
						<td><?php
							if($result['type']==0){
								echo 'Không Nổi bật';
							}else{
								echo 'Nổi bật';
							}
						?></td>

						<!-- <td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> || <a onclick="return confirm('Bạn có muốn xóa???')" href="?productid=<?php echo $result['productId'] ?>">Xóa</a></td> -->
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
