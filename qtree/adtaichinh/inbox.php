﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	$ct = new Cart();
    if(isset($_GET['shiftid'])){
     	$id = $_GET['shiftid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$shifted = $ct->shifted($id,$time,$price);
    }

?>
<?php
	$ct = new Cart();
    if(isset($_GET['delid'])){
     	$id = $_GET['delid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$del_shifted = $ct->del_shifted($id,$time,$price);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Quản lý Thu</h2>
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
							<th>STT</th>
							<th>Thời gian</th>
							<th>Sản phẩm</th>
							<th>Số lượng</th>
							<th>Giá</th>
							<th>Phí Ship</th>
							<th>Tổng chi phí</th>
							<th>Customer ID</th>
							<th>Địa chỉ</th>
							<th>Hành động</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$ct = new Cart();
						$fm = new Format();
						$get_inbox_cart = $ct->get_inbox_cart();
						if($get_inbox_cart){
							$i = 0;
							while($result = $get_inbox_cart->fetch_assoc()){
								$i++;
						 ?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['amount'] ?></td>
							<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?></td>
							<td><?php echo $fm->format_currency($result['tien_ship_save'])." VNĐ" ?></td>
							<td><?php echo $fm->format_currency($result['total_price'])." VNĐ" ?></td>
							<td><?php echo $result['customer_Id'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customer_Id'] ?>">Xem hồ sơ</a></td>
							<td>
							<?php 
							if($result['status']==0){
							?>
							<a href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xác nhận</a>
							<?php
							}elseif($result['status']==1){
								?>
								<?php
								echo 'Shipping...';
								?>
							<?php
							}elseif($result['status']==2){

							?>
							<a href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Xóa</a>	
							<?php
							}
							?>
							</td>
						</tr>
						<?php
						}} 
						?>
					</tbody>
				</table>

				<hr>

                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Thời gian</th>
							<th>Biến động Tổng thu không tính Ship</th>
						</tr>
					</thead>
					<tbody>
						<?php
	                    $show_thu = $ct->show_thu();
	                    if($show_thu){
	                    	$thu_k_ship=0;
							$amo = 0;
								$i = 0;

	                        while ($result = $show_thu->fetch_assoc()){
							$total = $result['price'] * $result['amount'];
									$i++;

	                    	$thu_k_ship +=$total;
							$amo = $amo + $result['amount'];


                		?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td><?php echo $fm->format_currency($thu_k_ship). " VNĐ";
                                				Session::set('sum',$thu_k_ship);
												Session::set('amo',$amo); ?></td>

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
