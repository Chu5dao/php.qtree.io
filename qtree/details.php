<?php
  include 'inc/header.php';
?>

<?php
	if(!isset($_GET['proid']) || $_GET['proid']==NULL){
       // echo "<script>window.location ='404.php'</script>";
    }else{
        $id = $_GET['proid']; 
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {

        $productid = $_POST['productid'];
        $insertWishlist = $product->insertWishlist($productid, $customer_id);
        
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $amount = $_POST['amount'];
        $insertCart = $ct->add_to_cart($amount, $id);
    }
    if(isset($_POST['binhluan_submit'])){
    	$binhluan_insert = $cs->insert_binhluan();
    }
?>

	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Details</h6>
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#">Store</a></li>
      <li><a href="#">Thông tin sản phẩm</a></li>
    </ul>
      </div>
</div>
<div class="wrap">
  <div class="main">
    <div class="content">
    	<div class="section group" style="color: #474747">
    		<?php
				$get_product_details = $product->get_details($id);
				if($get_product_details){
					while($result_details = $get_product_details->fetch_assoc()){
				?>

				<div class="cont-desc span_1_of_2" style="border-right: 1px solid #ececec;">				
					<div class="grid images_3_of_2">
						<img src="adbanhang/uploads/<?php echo $result_details['image'] ?>" alt="" />
					</div>

					<div class="desc span_3_of_2">
						<h2><?php echo $result_details['productName'] ?></h2>
						<p><?php echo $fm->textShorten($result_details['product_desc'],300) ?></p>					
						<div class="price">
							<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." VNĐ" ?></span></p>
							<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						</div>
						<div class="add-cart">
							<form action="" method="post">
								<input type="number" class="buyfield" name="amount" value="1" min="1" style="width: 25%" />
								<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
								<form action="" method="POST">
									<input type="hidden" name="productid" value="<?php echo $result_details['productId'] ?>"/>
									<?php
									$login_check = Session::get('customer_login'); 
										if($login_check){
											
											echo '<input type="submit" class="buysubmit" name="wishlist" value="Yêu thích">';
										}else{
											echo '';
										}
									?>
									<p>
										<?php
										if(isset($insertWishlist)){
											echo $insertWishlist;
										}
										?>
									</p>
								</form>

									

							</form>
							<?php
								if(isset($insertCart)){
									echo $insertCart;
								}
							?>
						</div>


						
						
						
					</div>
					<div class="product-desc">
						<h2  style="padding:10px 15px;
		                                   border:1px solid;
		                                   border-radius:3px; color:#F1832A;">Mô tả sản phẩm</h2>
						<p><?php echo$result_details['product_desc'] ?></p>
			    	</div>

      <!-- ################################################################################################ -->
      
     
      <div id="comments">
        <h2 style="padding:10px 15px;
		                                   border:1px solid;
		                                   border-radius:3px; color:#F1832A;">Comments</h2>
        <ul>
          
          <?php
			$get_show_cmt = $cs->get_show_cmt();
			if($get_show_cmt){
				while($result = $get_show_cmt->fetch_assoc()){
					if($result['status']=='0'){
						echo '';
					}elseif($result['status']==1){
					
			?>

          <li>
            <article>
              <header>
                <figure class="avatar"><img src="images/demo/avatar.png" alt=""></figure>
                <address>
                By <a href="#"><?php echo $result['ten_cmt'] ?></a>
                </address>
                <time><?php echo $fm->formatDate($result['date_cmt']) ?></time>
              </header>
              <div class="comcont">
                <p><?php echo $result['cmt']?></p>
              </div>
            </article>
          </li>
          <?php
      		}}}?>
        </ul>

        <h2>Write A Comment</h2>
        <?php
			if(isset($binhluan_insert)){
				echo $binhluan_insert;
			} 
			?>
        <form action="#" method="post">

		<p><input type="hidden" value="<?php echo $id ?>" name="product_id_binhluan"></p>
    <p><input type="hidden" value="<?php echo $result_details['productName'] ?>" name="productName_id_binhluan"></p>


          <div class="one_third first">
            <label for="name">Name <span>*</span></label>
            <input type="text" name="nameCMT" id="name" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="email">Mail <span>*</span></label>
            <input type="email" name="emailCMT" id="email" value="" size="22" required>
          </div>
          <div class="one_third">
            <label for="number">SĐT</label>
            <input type="number" name="phoneCMT" id="number" value="" size="22">
          </div>
          <div class="block clear">
            <label for="comment">Your Comment</label>
            <textarea id="comment" name="commentCMT" cols="25" rows="10"></textarea>
          </div>
          <div>
            <input type="submit" name="binhluan_submit" value="Submit Form">
            &nbsp;
            <input type="reset" name="reset" value="Reset Form">
          </div>
        </form>
      </div>
      <!-- ################################################################################################ -->

				</div>

		
		    <?php
				}
				}
				?>




			<div class="rightsidebar span_3_of_1" style="color:#F1832A;">
				<h2>Danh mục sản phẩm</h2>
				<ul>
				<?php
				$getall_category = $cat-> show_category_fontend();
					if($getall_category){
						while ($result_allcat = $getall_category->fetch_assoc()) {
				?>
			      <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName']?></a></li>
			    <?php
				}}
			    ?>
				</ul>
		<br>
      <!-- ################################################################################################ -->

      <div class="sdb_holder">
        <h2>Thông tin cửa hàng</h2>
        <address style="color: #474747">
        Địa chỉ: 205 - 207 Trần Hưng Đạo B,
        Quận 5, TP.Hồ Chí Minh.<br>
        Address Line 2<br>
        Phone: +84 (0)56 373 1506<br>
        Email: <a href="#">0650070039@sv.hcmunre.<br>edu.com</a><br>
        Follow on: <a href="">Facebook</a>, <a href="">Google+</a>
        </address>
      </div>
      
      <!-- ################################################################################################ -->

			</div>
			
		</div>	
 	</div>
 </div>
</div>
 
<?php
  include 'inc/footer.php';
?>