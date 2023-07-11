<?php
  include 'inc/header.php';
?>
<?php
	if(isset($_GET['cartID'])){
        $cartID = $_GET['cartID']; 
        $delcart = $ct->del_product_cart($cartID);
    }
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$cartID = $_POST['cartID'];
	    $amount = $_POST['amount'];
	    $update_amount_cart = $ct->update_amount_cart($amount, $cartID);
	    if($amount <= 0){
	    	$delcart = $ct->del_product_cart($cartID);
	    }    
	}
?>
<?php
	// if(!isset($_GET['id'])){
	// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	// }
?>

<style>
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
    <h6 class="heading">CART</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Thanh toan onl</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>
  
<div class="main">
    <div class="content">
			<div class="cartpage" >
                <?php
                    if(isset($_GET['congthanhtoan'])=='vnpay'){
                ?>
			    	<header style="font-family: Verdana, Geneva, sans-serif;
			    				color: #F1832A;
			    				font-size:22px;
								margin: 20px auto 20px auto;
								width: 80%;">
					Thanh toán bằng VNPAY
					</header>
                <?php
                }
                ?>
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
						<div class="row" style="margin: 20px auto 20px auto;
								width: 80%; padding: 4px;box-shadow:0px 0px 20px rgba(0 0 0 / 40%); width: 80%; margin: 20px auto 20px auto;">
						  
						  	<div class="clear"></div>
							<table class="tblone" style="	color: #373737;
															border: 2px solid #373737;
															margin-bottom: 12px;
															width: 100%;">
								<tr>
									<th width="20%">Tên sản phẩm</th>
									<th width="10%">Hình ảnh</th>
									<th width="15%">Giá sản phẩm</th>
									<th width="25%">Số lượng</th>
									<th width="20%">Tạm tính</th>
									<th width="10%">Hành động</th>
								</tr>
								<?php
								$get_product_cart = $ct->get_product_cart();
								if($get_product_cart){
									$tong = 0;
									$amo = 0;
									while($result = $get_product_cart->fetch_assoc()){
								?>
								<tr>
									<td><?php echo $result['productName'] ?></td>
									<td><img src="adbanhang/uploads/<?php echo $result['image'] ?>" alt=""/></td>
									<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?></td>
									<td>
										<form action="" method="post">
											<input type="hidden" name="cartID" value="<?php echo $result['cartID'] ?>">
											<input type="number" name="amount" min="0" value="<?php echo $result['amount'] ?>" >
											<input type="submit" name="submit" value="Update" />
										</form>
									</td>
									<td><?php
										$total = $result['price'] * $result['amount'];
										echo $fm->format_currency($total)." VNĐ"; ?>
									</td>
									<td><a onclick="return confirm('Bạn có muốn xóa không?');" href="?cartID=<?php echo $result['cartID'] ?>">Xóa</a></td>
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
								<div  style="width: 40%;">
									
									<table style="text-align:left; color: #373737; top: 0px;">
										<tr>
											<th>Tổng : </th>
											<td><?php
												echo $fm->format_currency($tong)." VNĐ"; 
												Session::set('sum',$tong);
												Session::set('amo',$amo);

											?>
											</td>
										</tr>
										<tr>
											<th>VAT : </th>
											<td><span> 10% (<?php echo $fm->format_currency($tong * 0.1)." VNĐ"; ?>)</span></td>
										</tr>
                                        <!-- <tr>
											<th>Phí giao hàng :
											<br><button style='color: #000; display: inline; background-color: rgb(239, 239, 239);' type='submit' name='nutguitt'>Tính phí giao hàng</button> </th>
											<td id="kc" name="kc"> </td>
										</tr> -->

										<tr>
											<th>Tổng chi phí : </th>
											<td><span> <?php echo $fm->format_currency($tongcuoi = $tong + ($tong * 0.1))." VNĐ"?></span></td>
										</tr>
								   </table>

						</div>
								   
								</div>
								<div>
								<div class="shopping">
                                    <br>
                                    <?php
                                        if(isset($_GET['congthanhtoan'])=='vnpay'){
                                    ?>
									    <center><form action="congthanhtoan.php" method="POST">
                                            <input type="hidden" name="total_congthanhtoan" value="<?php 
                                            echo $tongcuoi ?>">
                                            <button 
                                            id="redirect" 
                                            class="a_order"
                                            name="redirect"
                                            >Thanh toán VNPAY</button>
                                        </form></center>
                                    <?php
                                    }
                                    ?>

									<?php
									}else{
										echo '<p class="error">Giỏ hàng của bạn trống, hãy chọn mua sản phẩm tại cửa hàng !!!</p>';
									}
								   ?>
									
								</div>
							</div>
							

					</div>
						  
				
			
	    	</div>  	

	<br>

<!--     <?php
    include 'inc/map.php';
    ?>
 -->
    
	
	<!-- <script type="text/javascript">

	   $(document).ready(function(){ 
     	 //khai báo biến submit form lấy đối tượng nút submit
    	var submit = $("button[name='nutguitt']");

     	 //khi nút submit được click
	      submit.click(function()
	      {

	        var nhap = $("input[name='khoangcach']").val(); //lấy giá trị trong input user      
	        var price_main	 = $("#price_main").val(); 
	        var kc_fix = nhap.replace('m','');
	 		var kc_fix_1 = parseInt(kc_fix);

	        var price_ship_1 = "<span class='error'>Chúng tôi không hỗ trợ SHIP với đoạn đường >10.000m bạn có thể đến trực tiếp tại các cửa hàng để mua hoặc liên hệ hotline: 056.373.1506 để được tư vấn.</span>";
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
					price_ship = 250000;
				}else if(kc_fix_1 < 10000){
					price_ship = 350000;
				}
				$('#kc').html(price_ship + " VNĐ")

				var price_total = Number(price_ship) + Number(price_main);
	        	$('#tong_chi_phi').html(price_total  + " VNĐ");
			}


	      
	 		});
    	});
	</script> -->

	<br>
	<br>
</div>
<?php
  include 'inc/footer.php';
?>