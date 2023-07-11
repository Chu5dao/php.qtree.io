<?php 
	include 'inc/header.php';
	
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	header('Location:login.php');
    }
 
?>
<?php
	if(isset($_GET['confirmid'])){
     	$id = $_GET['confirmid'];
     	$time = $_GET['time'];
     	$price = $_GET['price'];
     	$shifted_confirm = $ct->shifted_confirm($id,$time,$price);
    }
?>
<style type="text/css">
	.box_left {
    width: 100%;
    padding: 4px;	
	}

</style>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">History payment</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Lịch sử đặt hàng</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>
 <div class="main">


    <div class="content">
    	<div class="section group">
    		<div class="row" style="margin: 20px auto 20px auto;
								width: 80%; padding: 4px; width: 80%; margin: 20px auto 20px auto;">
				<div class="heading">
		    		<h3  style="font-family: Verdana, Geneva, sans-serif;
				    				color: #F1832A;
				    				font-size:22px;
									width: 80%;">Chi tiết đơn hàng đã đặt</h3>
		    	</div>
	    		
		    	<div class="clear"></div>
	    		<div class="box_left">

					<div class="cartpage">






							  
							  	<div class="clear"></div>
								<table class="tblone" style="	color: #000;
																font-size: 12px;
																box-shadow:0px 0px 20px rgba(0 0 0 / 10%);
																margin-bottom: 12px;
																width: 100%;">
									<tr>
										<th width="1%">ID</th>
										<th width="20%">Tên sản phẩm</th>
										<th width="8%">Hình ảnh</th>
										<th width="12%">Giá sản phẩm</th>
										<th width="1%">Số lượng</th>
										<th width="10%">Phí ship</th>
										<th width="10%">Tổng thanh toán</th>
										<th width="22%">Thời gian</th>
										<th width="12%">Tình trạng</th>
										<th width="4%">Hành động</th>
									</tr>
									<?php
             						$customer_id = Session::get('customer_id');
									$get_cart_ordered = $ct->get_cart_ordered($customer_id);
									if($get_cart_ordered){

										$i = 0;
										while($result = $get_cart_ordered->fetch_assoc()){
											$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result['productName'] ?></td>
										<td><img src="adbanhang/uploads/<?php echo $result['image'] ?>" alt=""/></td>
										<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?></td>
										<td><?php echo $result['amount'] ?></td>
										<td><?php echo $fm->format_currency($result['tien_ship_save'])." VNĐ"  ?></td>
										<td><?php echo $fm->format_currency($result['total_price'])." VNĐ" 	 ?></td>
										<td><?php echo $fm->formatDate($result['date_order']) ?></td>
										<td><?php 
											if($result['status']=='0'){
												echo 'Đang chờ xử lý';
											}elseif($result['status']==1){
											?>
											<span>Đang vận chuyển</span>
											<?php
											}elseif($result['status']==2){
												echo 'Nhận';
											}
										?></td>
										<?php
											if($result['status']=='0'){
										?>
											<td><?php echo 'N/A'?></td>
										<?php
											}elseif($result['status']=='1'){

										?>
										<td>
											<a onclick="return confirm('Bạn đã nhận hàng??? Chúng tôi sẽ không chịu trách nhiệm về các vấn đề hàng hóa sau khi bạn xác nhận đã nhận được hàng?');" href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Đã Nhận hàng</a>
										</td>
										<?php
										}else{
										?>
										<td><?php echo '<span class="fas fa-check"></span>'; ?></td>
										<?php
										}
										?>

									</tr>
									<?php
								
									}
									}
									?>
								</table>



	
			    	</div>
    			

    			</div>




 			</div>

 		</div>

 	</div>
	<br>

	
	


	

	<br>
	<br>

<?php
	include 'inc/footer.php';
?>
