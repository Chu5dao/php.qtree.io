<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	$cs = new Customer();
    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$del_shifted = $cs->del_lh($id);
    }

?>



        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thư góp ý</h2>
                <div class="block">

                <?php 
                if(isset($del_shifted)){
                	echo $del_shifted;
                }
                
                ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>

							<th>Thời gian</th>
							<th>Tên</th>
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
						$get_cmt = $cs->get_lh();
						if($get_cmt){

							while($result = $get_cmt->fetch_assoc()){

						 ?>
						<tr class="odd gradeX">

							<td><?php echo $fm->formatDate($result['date_lh']) ?></td>
							<td><?php echo $result['name'] ?></td>
							<td><?php echo $result['email'] ?></td>
							<td><?php echo $result['SĐT'] ?></td>
							<td><?php echo $fm->textShorten($result['lh'],24) ?>
								<a href="detail_lienhe.php?id=<?php echo $result['id'] ?>">Xem chi tiết</a></td>
							<td>
								<a onclick="return confirm('Bạn có thực sự muốn xóa???');" href="?delid=<?php echo $result['id'] ?>">Xóa</a>
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
