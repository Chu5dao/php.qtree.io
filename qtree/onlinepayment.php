<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
	
	$login_check = Session::get('customer_login'); 
	if($login_check==false){
		header('Location:login.php');
	}
		
?>
<?php

	// if(!isset($_GET['proid']) || $_GET['proid']==NULL){
 //       echo "<script>window.location ='404.php'</script>";
 //    }else{
 //        $id = $_GET['proid']; 
 //    }
 //    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
 //        $quantity = $_POST['quantity'];
 //        $AddtoCart = $ct->add_to_cart($quantity, $id);
        
 //    }
?>
<style>
	h3.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
    color: #000;
	}
	.wrapper_method {
	text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    /* margin: 20px; */
    background: #FDF0F1;
	}
	.wrapper_method a, .btn-success{
    padding: 10px;
    background: #F1832A;
    color: #fff;
    border-radius: 4px;
	}
    .btn-success {
        display: block;margin: 0 auto;
    }
	.wrapper_method h3 {
		margin-bottom: 20px;
	}
</style>

	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Payment</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Thanh toán</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>

 <div class="main">
    <div class="content">

    	<div class="row" style="box-shadow:0px 0px 20px rgba(0 0 0 / 40%); width: 80%; margin: 20px auto 20px auto;">
			<br>
			<div class="heading" style="color: #F1832A;
				font-size:22px;
				margin: auto 20px;
				width: 80%;">
				<h3 style="font-family: Verdana, Geneva, sans-serif;">Thanh toán online</h3>
			</div>
	    	<div class="section group">

	    		<div class="content_top">

		    		<div class="clear"></div>
		    		<div class="wrapper_method">
			    		<h3 class="payment">Choose your method online payment</h3>
                        <!-- <form action="donhangthanhtoanonl.php?congthanhtoan=vnpay" method="POST">
                            <button
							id="redirect"
							class="btn-success"
							name="redirect">Thanh toán VNPAY</button>
                        </form> -->

						<a href="donhangthanhtoanonl.php">Thanh toán VNPAY</a>
			    		<a href="donhangthanhtoanonl.php">Thanh toán MOMO</a>
                        <br><br><br>
			    		<a style="background:grey" href="payment.php"> << Quay về</a>
			    	</div>
	    		</div>
			</div>
			<br>
 		</div>
 	</div>
 </div>
<?php 
	include 'inc/footer.php';
	
 ?>
