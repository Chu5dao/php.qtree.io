<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	$cs = new Customer();
    if(isset($_GET['shiftid'])){
     	$id = $_GET['shiftid'];
     	$date_cmt = $_GET['date_cmt'];
     	$ten_cmt = $_GET['ten_cmt'];
     	$shifted = $cs->shifted_cmt($id,$date_cmt,$ten_cmt);
    }

?>
<?php
	$cs = new Customer();
    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$date_cmt = $_GET['date_cmt'];
     	$ten_cmt = $_GET['ten_cmt'];
     	$del_shifted = $cs->del_shifted_cmt($id,$date_cmt,$ten_cmt);
    }

?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách comment</h2>
                <div class="block">
             	<?php 
                if(isset($shifted)){
                	echo $shifted;
                }

                ?>  
                <?php 
                if(isset($del_shifted)){
                	echo $del_shifted;
                }
                
                ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>

							<th>Thời gian</th>
							<th>Tên Sản phẩm</th>
							<th>Người <br>bình luận</th>
							<th>Email</th>
							<th>Số điên thoại</th>
							<th>Nội dung</th>
							<th>Hành động</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$cs = new Customer();
						$fm = new Format();
						$get_cmt = $cs->get_cmt();
						if($get_cmt){

							while($result = $get_cmt->fetch_assoc()){

						 ?>
						<tr class="odd gradeX">

							<td><?php echo $fm->formatDate($result['date_cmt']) ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['ten_cmt'] ?></td>
							<td><?php echo $result['email'] ?></td>
							<td><?php echo $result['SĐT'] ?></td>
							<td><?php echo $fm->textShorten($result['cmt'],24) ?><a href="detail_cmt.php?cmt_id=<?php echo $result['cmt_id'] ?>">Xem chi tiết</a></td>
							<td>
							<?php 
							if($result['status']==0){
							?>
							<a  href="?shiftid=<?php echo $result['product_id'] ?>&ten_cmt=<?php echo $result['ten_cmt'] ?>&date_cmt=<?php echo $result['date_cmt'] ?>">Duyệt</a> || 
							<?php
							}
							?>


							<a onclick="return confirm('Bạn có thực sự muốn xóa???');" href="?delid=<?php echo $result['productName'] ?>&ten_cmt=<?php echo $result['ten_cmt'] ?>&date_cmt=<?php echo $result['date_cmt'] ?>">Xóa</a>
							</td>
						</tr>
						<?php
						}} 
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
