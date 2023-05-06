<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php';?>


        <div class="grid_10">
            <div class="box round first grid">
                <h2>Danh sách thành viên</h2>
                <br>


                <div class="block">
                    <table class="data display datatable" id="example">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Tên</th>
								<th>Địa chỉ</th>
								<th>SĐT</th>
								<th>Email</th>
							</tr>
						</thead>
					<tbody>
						<?php
    						$cs = new Customer();
							$show_kh = $cs->showlist_customer();
							if($show_kh){
								$i = 0;
								while ($result = $show_kh->fetch_assoc()) {
									$i++;
								?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $result['name'] ?></td>
								<td><?php echo $result['dia_chi'] ?></td>
								<td><?php echo $result['phone'] ?></td>

								<td><?php echo $result['email'] ?></td>

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

