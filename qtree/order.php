<?php 
	include 'inc/header.php';
?>
<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
    	header('Location:login.php');
    }
?>
<style>
	
	.Order_page	 {
    font-size: 30px;
    font-weight: bold;
    color: red;
    font-family: Verdana, Geneva, sans-serif;
}
</style>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
	    <h6 class="heading">Products</h6>
	    <ul>
	      <li><a href="#">Trang chủ</a></li>
	      <li><a href="#">Order Page</a></li>
	    </ul>
  	</div>
</div>
	<div class="main">
	 	<div class="wrapper row2">
			<div class="hoc container clear">
				<div class="Order_page">
					<h3>Order Page</h3>
				</div>
			</div>
		</div>				
	</div>
	<div class="clear"></div>
 <?php 
	include 'inc/footer.php';
 ?>
