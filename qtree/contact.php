<?php
  include 'inc/header.php';
?>
<?php
if(isset($_POST['Lh_submit'])){
    	$lienhe_insert = $cs->insert_lienhe();
    }
?>


	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">CONTACT</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Liên hệ</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>

 <div class="main" >
 	<br>
    <div class="content" style="color: #474747;">


    	<div class="section group" style="margin: 20px auto 20px auto;
								width: 74%; padding: 4px;box-shadow:0px 0px 20px rgba(0 0 0 / 40%);">
			<div class="support" style="margin: 20px 20px; width:74%;">
	    		<div class="clear"></div>
	  			<div class="support_desc" style="">
	  				<header class="heading" style="font-family: Verdana, Geneva, sans-serif; color:#F1832A; font-size:22px">HỖ TRỢ TRỰC TUYẾN</header>
	  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Hỗ trợ kỹ thuật trực tiếp </span></p>
	  			</div>
	  		</div>
			<div style="display: grid;
						grid-template-columns: repeat(2, 0.1fr 0.5fr); ">
				<div class="clear"></div>

				<div class="contact-form" style="position:relative;
												padding-bottom:30px;
												padding:5px 0;">
				<br>
				<br>

			  	<h2>Liên hệ chúng tôi</h2>
			  	<?php
				if(isset($lienhe_insert)){
					echo $lienhe_insert;
				} 
				?>
				    <form action="#" method="post">
				    	<div>
					    	<span><label>Tên:</label></span>
					    	<span><input required name="nameLh"  type="text" value="" style="width: 100%;
																		padding: 12px 20px;
																		margin: 8px 0;
																		box-sizing: border-box;
																		border-radius: 4px;"></span>
					    </div>
					    <div>
					    	<span><label>E-MAIL:</label></span>
					    	<span><input required name="emailLh" type="text" value="" style="width: 100%;
																		padding: 12px 20px;
																		margin: 8px 0;
																		box-sizing: border-box;
																		border-radius: 4px;"></span>
					    </div>
					    <div>
					     	<span><label>Số điện thoại:</label></span>
					    	<span><input name="phoneLh" type="number" value="" style="width: 100%;
																		padding: 12px 20px;
																		margin: 8px 0;
																		box-sizing: border-box;
																		border-radius: 4px;
																		border-width: 2px;
																		border-color: #666"></span>
					    </div>
					    <div>
					    	<span><label>Góp ý:</label></span>
					    	<span><textarea name="Lh" style="width: 100%;
													padding: 12px 20px;
													margin: 8px 0;
													box-sizing: border-box;
													border-radius: 4px;
													border-width: 2px;"> </textarea></span>
					    </div>
					   	<div>
					   		<span><input name="Lh_submit" type="submit" value="Gửi đi" class="btn btn-waring" style="padding: 10px 18px; border-radius: 4px;"></span>
					  	</div>
				    </form>

				    <br>

			  	</div>

				<div class="clear"></div>

			  	<div  style="display: grid;
						grid-template-rows: repeat(2, 1fr);">
					<div><img src="images/contact.png" alt="" /></div>
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
				<div class="clear"></div>
				</div>
			</div>
			
			<br>

	    <!-- <?php include 'inc/map.php'?> -->
	    <br>
	    	      	
    </div>
 </div>
 
<?php
  include 'inc/footer.php';
?>