<?php 
	include 'inc/header.php';
?>
<?php
	 if(isset($_GET['proid'])){
	 	$customer_id = Session::get('customer_id');
         $proid = $_GET['proid']; 
         $delwlist = $product->del_wlist($proid,$customer_id);
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
    <h6 class="heading">CART</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Sản phẩm yêu thích</a></li>
    </ul>
    <!-- ################################################################################################ -->
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
										width: 80%;">Sản phẩm yêu thích</h3>
			    	</div>
	    		<div class="box_left">

					<div class="cartpage" >
			    	
						<table class="tblone" style="	color: #000;
																font-size: 18px;
																box-shadow:0px 0px 20px rgba(0 0 0 / 10%);
																margin-bottom: 12px;
																width: 100%;">
							<tr>
								<th width="10%">ID Compare</th>
								<th width="20%">Product Name</th>
								<th width="8%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>
	
							</tr>
							<?php
							$customer_id = Session::get('customer_id');
							$get_wishlist = $product->get_wishlist($customer_id);
							if($get_wishlist){
								$i = 0;
								while($result = $get_wishlist->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="adbanhang/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price'])." VNĐ" ?></td>

								<td>
									<a  href="?proid=<?php echo $result['productId'] ?>">Xóa</a> ||
									<a  href="details.php?proid=<?php echo $result['productId'] ?>">Mua ngay</a>
								</td>
							</tr>
						<?php
							
							}
						}
						?>
							
						</table>
						
						
					
					
					</div>
					<center> class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						
					</center>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
</div>
<?php 
	include 'inc/footer.php';
?>