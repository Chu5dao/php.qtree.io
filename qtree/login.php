<?php
  include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check){
    	header('Location:order.php');
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $insertCustomer = $cs->insert_Customer($_POST);
    }
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $loginCustomer = $cs->login_Customer($_POST);
    }
?>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">LOGIN</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Đăng nhập - Đăng ký</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>

<div class="main">
	<br>
	<br>
	<div class="content" style="color: #373737;
    							display: grid;
								grid-template-columns: repeat(5, 15% 30% 1% 45% 9%);">
		<div class="clear"></div>
    	<div class="login_panel" style="border:1px solid;
    									-moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;
    									padding:20px">
        	<h3 style="font-family: Verdana, Geneva, sans-serif;">Đăng nhập</h3>
        	<p>Đăng nhập bằng biểu mẫu bên dưới.</p>
        	<?php
        	if(isset($loginCustomer)){
    			echo $loginCustomer;
    		}
        	?>
        	<form action="" method="POST" style="margin:15px 0;">
                	<input type="text" name="eMail" class="field" placeholder="Nhập E-mail đã tạo" style="width: 100%;
  											padding: 12px 20px;
											margin: 8px 0;
											box-sizing: border-box;
											border-radius: 4px;">
                    <input type="password" name="Password" class="field" placeholder="Nhập Password của bạn" style="width: 100%;
  													padding: 12px 20px;
  													margin: 8px 0;
  													box-sizing: border-box;
  													border-radius: 4px;">
                 
                 <p class="note">Nếu bạn quên mật khẩu, hãy nhấn vào <a href="#">đây</a></p>
                    <div class="buttons">
                    	<div><input type="submit" name="login" class="btn btn-waring" style="border-radius: 4px;" value="Đăng nhập"></div>
                    </div>
            </form>

        </div>
        <div class="clear"></div>
        <?php

        ?>
    	<div class="register_account" style="border:1px solid;
    									-moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;
    									padding:20px">
    		<h3 style="font-family: Verdana, Geneva, sans-serif;">Đăng ký thành viên</h3>
    		<?php
    		if(isset($insertCustomer)){
    			echo $insertCustomer;
    		}
    		?>
    		<form style="margin:15px 0;" action="" method="POST">
		   		<table><tbody>
				<tr>
					<td>
						

						<div>
							<input required type="email" name="eMail" placeholder="Nhập E-Mail (Dùng để đăng nhập)" style="width: 100%;
								padding: 12px 20px;
								margin: 8px 0;
								box-sizing: border-box;
								border-radius: 4px;">
						</div>
						<div>
						<input required type="password" name="Password" placeholder="Nhập Password" 
						style="width: 100%;
								padding: 12px 20px;
								margin: 8px 0;
								box-sizing: border-box;
								border-radius: 4px;">
						</div>
						<div><input required type="password" name="re_pass" placeholder="Nhập lại mật khẩu" style="width: 100%;padding: 12px 20px;
									margin: 8px 0;
									box-sizing: border-box;
									border-radius: 4px;"></div>
	    			</td>
	    			<td>
	    				<div>
						<input required type="text" name="Name" placeholder="Nhập Name" style="width: 100%;
							padding: 12px 20px;
							margin: 8px 0;
							box-sizing: border-box;
							border-radius: 4px;">
						</div>
					<div>
						<input required type="text" name="Address" placeholder="Nhập Địa chỉ"
						style="width: 100%;
							padding: 12px 20px;
							margin: 8px 0;
							box-sizing: border-box;
							border-radius: 4px;">
					</div>
	    			<!-- <div>
						<select id="Tinh" name="Tinh" style="width: 100%;
															padding: 12px 20px;
															margin: 8px 0;
															box-sizing: border-box;
															border-radius: 4px;
															border-width: 2px">
							<option value="null">Chọn Tỉnh</option>         
							<option value="An Giang">An Giang</option>
							<option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option>
							<option value="Bạc Liêu">Bạc Liêu</option>
							<option value="Bắc Giang">Bắc Giang</option>
							<option value="Bắc Kạn">Bắc Kạn</option>
							<option value="Bắc Ninh">Bắc Ninh</option>
							<option value="Bến Tre">Bến Tre</option>
							<option value="Bình Dương">Bình Dương</option>
							<option value="Bình Định">Bình Định</option>
							<option value="Bình Phước">Bình Phước</option>
							<option value="Bình Thuận">Bình Thuận</option>
							<option value="Cà Mau">Cà Mau</option>
							<option value="Cao Bằng">Cao Bằng</option>
							<option value="Cần Thơ">Cần Thơ</option>
							<option value="Đà Nẵng">Đà Nẵng</option>
							<option value="Đắk Lắk">Đắk Lắk</option>
							<option value="Đắk Nông">Đắk Nông</option>
							<option value="Điện Biên">Điện Biên</option>
							<option value="Đồng Nai">Đồng Nai</option>
							<option value="Đồng Tháp">Đồng Tháp</option>
							<option value="Gia Lai">Gia Lai</option>
							<option value="Hà Giang">Hà Giang</option>
							<option value="Hà Nam">Hà Nam</option>
							<option value="Hà Nội">Hà Nội</option>
							<option value="Hà Tĩnh">Hà Tĩnh</option>
							<option value="Hải Dương">Hải Dương</option>
							<option value="Hải Phòng">Hải Phòng</option>
							<option value="Hậu Giang">Hậu Giang</option>
							<option value="Hòa Bình">Hòa Bình</option>
							<option value="Thành phố Hồ Chí Minh">Thành phố Hồ Chí Minh</option>
							<option value="Hưng Yên">Hưng Yên</option>
							<option value="Khánh Hòa">Khánh Hòa</option>
							<option value="Kiên Giang">Kiên Giang</option>
							<option value="Kon Tum">Kon Tum</option>
							<option value="Lai Châu">Lai Châu</option>
							<option value="Lạng Sơn">Lạng Sơn</option>
							<option value="Lào Cai">Lào Cai</option>
							<option value="Lâm Đồng">Lâm Đồng</option>
							<option value="Long An">Long An</option>
							<option value="Nam Định">Nam Định</option>
							<option value="Nghệ An">Nghệ An</option>
							<option value="Ninh Bình">Ninh Bình</option>
							<option value="Ninh Thuận">Ninh Thuận</option>
							<option value="Phú Thọ">Phú Thọ</option>
							<option value="Phú Yên">Phú Yên</option>
							<option value="Quảng Bình">Quảng Bình</option>
							<option value="Quảng Nam">Quảng Nam</option>
							<option value="Quảng Ngãi">Quảng Ngãi</option>
							<option value="Quảng Ninh">Quảng Ninh</option>
							<option value="Quảng Trị">Quảng Trị</option>
							<option value="Sóc Trăng">Sóc Trăng</option>
							<option value="Sơn La">Sơn La</option>
							<option value="Tây Ninh">Tây Ninh</option>
							<option value="Thái Bình">Thái Bình</option>
							<option value="Thái Nguyên">Thái Nguyên</option>
							<option value="Thanh Hóa">Thanh Hóa</option>
							<option value="Thừa Thiên Huế">Thừa Thiên Huế</option>
							<option value="Tiền Giang">Tiền Giang</option>
							<option value="Trà Vinh">Trà Vinh</option>
							<option value="Tuyên Quang">Tuyên Quang</option>
							<option value="Vĩnh Long">Vĩnh Long</option>
							<option value="Vĩnh Phúc">Vĩnh Phúc</option>
							<option value="Yên Bái">Yên Bái</option>
		         		</select>
					</div> -->		        

	        		<div>
				        <input required type="text" name="Phone" placeholder="Nhập Phone" style="width: 100%;
									padding: 12px 20px;
									margin: 8px 0;
									box-sizing: border-box;
									border-radius: 4px;">
	        		</div>

			  
					
	    	</td>
		    </tr> 
		    </tbody></table> 
		    <p class="terms">Bằng cách nhấp vào 'Tạo Tài khoản', bạn đồng ý với <a href="#">Điều khoản &amp; điều kiện.</a></p>
		   	<div class="search">
		   		<div><input type="submit" name="submit" class="btn btn-waring" style="border-radius: 4px;" value="Tạo tài khoản"></div>
		   	</div>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
    <br>		
    <br>		
    <br>		
    <br>		
</div>
    

 <?php
  include 'inc/footer.php';
?>