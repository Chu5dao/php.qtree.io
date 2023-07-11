<?php 
	include 'inc/header.php';
	
?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
      header('Location:login.php');
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
	a.a_order {
    background: #F1832A;
    padding: 7px 20px;
    color: #fff;
    font-size: 21px;
    border-radius: 4px;
  }
  h2.success_order {
    text-align: center;
    color: green;
  }
  .group{
    text-align: center;
  }
</style>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Payment</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Giỏ hàng</a></li>
      <li><a href="#">Thanh toán</a></li>
      <li><a href="#">Thanh toán Thành công</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>
 <div class="main">
<form action="" method="POST">

    <div class="content">
    	<div class="section group ">
        <div >
    		  <h2 class="success_order">Success Order</h2></p>
            <p >Đặt hàng thành công. Đơn hàng đang chờ duyệt. 
            <?php
              $customer_id = Session::get('customer_id');
              $get_tongchiphi = $ct->get_tongchiphi($customer_id);
              if($get_tongchiphi){
              while ($result = $get_tongchiphi->fetch_assoc()) {
                $total_price = $fm->format_currency($result['total_price']);
              }
              }
            ?>
            <p>Tổng giá trị đơn hàng là <a href=""><?php echo $total_price." VNĐ"; ?></a>.</p>

            <p>Chúng tôi sẽ liên hệ với bạn sớm nhất có thể.</p>
            <p>Bạn có thể xem lại Thông tin chi tiết đơn đặt hàng <a href="order_details.php">tại đây.</a></p>
        </div>
    	</div>
    </div>
	<br>


<?php
	include 'inc/footer.php';
?>
