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

	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$customer_id = Session::get('customer_id');
		$insertOrder = $ct->insertOrder($_POST, $customer_id);
		$delCart = $ct->del_all_data_cart();
    }

?>
<style type="text/css">
	.box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 4px;	
	}
 	.box_right {
    width: 48%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
	}
	.a_order {
    background: #F1832A;
    padding: 7px 20px;
    color: #fff;
    font-size: 21px;
    border-radius: 4px;
	cursor: pointer;
}
</style>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Payment Offline</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Giỏ hàng</a></li>
      <li><a href="#">Thanh toán</a></li>
      <li><a href="#">Thanh toán Offline</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>
 <div class="main">
<form action="" method="POST">

    <div class="content">
    	<div class="section group">
    		<div class="row" style="margin: 20px auto 20px auto;
								width: 80%; padding: 4px; width: 80%; margin: 20px auto 20px auto;">
				<div class="heading">
		    		<h3  style="font-family: Verdana, Geneva, sans-serif;
				    				color: #F1832A;
				    				font-size:22px;
									width: 80%;">Offline Payment</h3>
		    	</div>
	    		
		    	<div class="clear"></div>
	    		<div class="box_left">
	    			<div style="border-bottom: solid;">
	    				<h3  style="font-family: Verdana, Geneva, sans-serif;
				    				color: #F1832A;
				    				font-size:22px;
									width: 80%;
									margin-top: 10px;">Thông tin khách hàng</h3>
						<!-- <center><p class="error">Nhân viên của Store sẽ giao hàng theo địa chỉ bên dưới quý khác hãy cập nhập thông tin nếu cần thiết và vui lòng nhập địa chỉ bên bản đồ để tính phí SHIP trực tuyến</p></center> -->
		    			<table class="tblone" style="box-shadow:0px 0px 20px rgba(0 0 0 / 10%); color: #000;" >
							<?php
							$id=Session::get('customer_id');
							$get_customer = $cs->show_customer($id);
							if($get_customer){
								while ($result=$get_customer->fetch_assoc()) {
							
							?>
							<tr>
								<td>Tên</td>
								<td><?php echo $result['name']?></td>
							</tr>
							<tr>
								<td>Địa chỉ</td>
								<td><?php echo $result['dia_chi']?></td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><?php echo $result['phone']?></td>
							</tr>
							<tr>
								<td>E-Mail</td>
								<td><?php echo $result['email']?></td>
							</tr>
							<tr>
								<td colspan="3"><a href="editprofile.php">Chỉnh sửa thông tin cá nhân</a></td>
							</tr>
							<?php
							}
							}?>
						</table>
    				</div>

					<br>
					<div class="cartpage">
					<?php
					if(isset($update_amount_cart)){
						echo $update_amount_cart;
						}
					?>
					<?php
					if(isset($delcart)){
						echo $delcart;
						}
					?>
						<div >

							<h3  style="font-family: Verdana, Geneva, sans-serif;
					    				color: #F1832A;
					    				font-size:22px;
										width: 80%;">Thông tin đơn hàng</h3>
							  
							  	<div class="clear"></div>
								<table class="tblone" style="	color: #000;
																box-shadow:0px 0px 20px rgba(0 0 0 / 10%);
																margin-bottom: 12px;
																width: 100%;">
									<tr>
										<th width="7%">ID</th>
										<th width="35%">Tên sản phẩm</th>

										<th width="25%">Giá sản phẩm</th>
										<th width="8%">Số lượng</th>
										<th width="25%">Tạm tính</th>
									</tr>
									<?php
									$get_product_cart = $ct->get_product_cart();
									if($get_product_cart){
										$tong = 0;
										$amo = 0;
										$i = 0;
										while($result = $get_product_cart->fetch_assoc()){
											$i++;
									?>
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result['productName'] ?>
											<input name="productName" id="productName" type="hidden" value="<?php echo $result['productName'] ?>">
											<input name="productID" id="productID" type="hidden" value="<?php echo $result['productID'] ?>">

										</td>
										<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?>
											<input name="price" id="price" type="hidden" value="<?php echo $result['price'] ?>"></td>
										<td><?php echo $result['amount'] ?>
											<input name="amount" id="amount" type="hidden" value="<?php echo $result['amount'] ?>"></td>
										<td><?php
											$total = $result['price'] * $result['amount'];
											echo $fm->format_currency($total)." VNĐ"; ?>
											<input name="total" id="total" type="hidden" value="<?php echo $total; ?>">
										</td>

									</tr>
									<?php
									$tong += $total;
									$amo = $amo + $result['amount'];
									}
									}
									?>
								</table>

								<?php
		                		$check_cart = $ct->check_cart();
		                		  if($check_cart){
		                		?>
    
								<div  class="box_left" style="width: 60%; border: none;">
									<table style="text-align:left; color: #373737; top: 0px; box-shadow:0px 0px 20px rgba(0 0 0 / 10%);">
										<tr>
											<th>Tổng : </th>
											<td><?php
												echo $fm->format_currency($tong)." VNĐ"; 
												Session::set('sum',$tong);
												Session::set('amo',$amo);
												?>
												<!-- Giá trị để lấy price_main -->
												<input type="hidden" value="<?php echo $tong; ?>" id="price_main" name="">
											</td>
										</tr>
										<tr>
											<!-- BEN MAP -->
											<!-- <th>Phí giao hàng :
											<br><a id="tinhphi"  style='color: #000; display: inline; background-color: rgb(239, 239, 239); cursor: pointer;' type='submit' name='nutguitt'>Tính phí giao hàng</a> </th> 
											<td id="kc" name="kc"> </td> -->
											
											<!-- ----------- -->
											<th>VAT: </th>
											<td id="kc" name="kc"> 10% (<?php
											echo $fm->format_currency($vat = $tong * 0.1)." VNĐ";
											?>)</td>
											
										</tr>	
										<tr>
											<!-- <th>Tổng chi phí : </th>
											<td><span id="tong_chi_phi">
											</span></td> -->
											<th>Tổng chi phí : </th>
											<td><span id="tong_chi_phi2">
												<?php
													$vat = $tong * 0.1;
													$tong_chi_phi = $tong + $vat;
													echo $fm->format_currency($tong_chi_phi)." VNĐ";
												?>
											</span></td>
										</tr>
								   </table>
								   
								</div>
								<!-- <div><p ><br>Nhập địa điểm vận chuyển trên bản đồ <a href="">để tính phí giao hàng.</a></p></div> -->
								<?php
									}else{
										echo '<p class="error" href="store.php">Giỏ hàng của bạn trống, hãy chọn mua sản phẩm tại cửa hàng !!!</p>';
									}
								   ?>

						</div>
			    	</div>
    			

    			</div>
	    		<div class="box_right">
	    		<!-- <center><p class="error">Vui lòng nhập địa chỉ chi nhánh cửa hàng và địa chỉ giao hàng ở ô bên dưới <br>hoặc bạn có thể click vào bản đồ</p></center>
				<?php include 'inc/map.php'?> -->
	    			
				    <br>
				    <div class="company_address">
					     	<h2>THÔNG TIN CỬA HÀNG:</h2>
							    	<p>Địa chỉ: 205 - 207 Trần Hưng Đạo B, </p>
							   		<p>Quận 5, TP.Hồ Chí Minh, Việt Nam.</p>
							   		<p>Phone: +84 (0)56 373 1506</p>
							 	 	<p>Email: <span style="	text-decoration:underline;
															color:#FBAB45;
															cursor:pointer;">0650070039@sv.hcmunre.edu.com</span></p>
							   		<p>Follow on: <span style="	text-decoration:underline;
																color:#FBAB45;
																cursor:pointer;">Facebook</span>,
													<span style="text-decoration:underline;
																color:#FBAB45;
																cursor:pointer;">Google+</span></p>
					</div>
	    		</div>



 			</div>
 		</div>

 	</div>
	<br>

<!-- <input type="hidden" id="kc2" name="kc2" value="">
<input type="hidden" id="tien_ship_save" name="tien_ship_save" value="">
<input type="hidden" id="tong_chi_phi2" name="tong_chi_phi2" value="">

    
	
	<script type="text/javascript">
    	<?php
  		// include_once 'helpers/format.php';
    	// $fm = new Format();
    	?>

	   $(document).ready(function(){ 
     	 //khai báo biến submit form lấy đối tượng nút submit
    	var submit = $("button[name='nutguitt']");

     	 //khi nút submit được click
	      $("#tinhphi").click(function()
	      {

	        var nhap = $("input[name='khoangcach']").val(); //lấy giá trị trong input user      
	        var price_main	 = $("#price_main").val(); 
	        var kc_fix = nhap.replace('m','');
	 		var kc_fix_1 = parseInt(kc_fix);

	        var price_ship_1 = '<span class="error">Chúng tôi không hỗ trợ SHIP với đoạn đường >10.000m bạn có thể đến trực tiếp tại các cửa hàng để mua hoặc liên hệ hotline: 056.373.1506 để được tư vấn.</span>';
	        var	tong_chi_phi_1 = "";
	 		
			console.log(kc_fix_1);
			console.log(price_ship);

			if(kc_fix_1 > 10000){
				price_ship = price_ship_1;
				$('#kc').html(price_ship)
	        	$('#tong_chi_phi').html(tong_chi_phi_1);
			}else{
				var price_ship = 0;
		 		if (kc_fix_1 < 2000){
			 		price_ship = 0;
				}else if(kc_fix_1 < 5000){
					price_ship = 25000;
				}else if(kc_fix_1 < 10000){
					price_ship = 35000;
				}
				$('#kc').html(price_ship + " VNĐ");

				$('#tien_ship_save').val(price_ship);
				$('#kc2').val(kc_fix_1);

				var price_total = Number(price_ship) + Number(price_main);
	        	$('#tong_chi_phi').html(price_total  + " VNĐ");
	        	$('#tong_chi_phi2').val(price_total);


			}


	      
	 		});
    	});
	</script> -->
<center><button type="submit" name="submit" class="a_order">Order Now</button></center><br>
<!-- <center><a href="?oderid=order" class="a_order">Order Now</a></center><br> -->


</form>
	

	<br>
	<br>

<?php
	include 'inc/footer.php';
?>
