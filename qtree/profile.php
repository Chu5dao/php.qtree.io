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
	// if(!isset($_GET['proid']) || $_GET['proid']==NULL){
 //       echo "<script>window.location ='404.php'</script>";
 //    }else{
 //        $id = $_GET['proid']; 
 //    }
 //    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

 //        $amount = $_POST['amount'];
 //        $insertCart = $ct->add_to_cart($amount, $id);
 //    }
?>
	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Profile</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Hồ sơ</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>

<div class="main">
	<div class="wrapper row2">
		<div class="hoc container clear">
	        <header class="heading" style=" font-family: Verdana, Geneva, sans-serif;
                                font-size:22px;
                                color:#F1832A;">Hồ sơ CÁ NHÂN</header>
			<table class="tblone">
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
				<!-- <tr>
					<td>Password</td>
					<td></td>
				</tr> -->
				<tr>
					<td colspan="3"><a href="editprofile.php">Chỉnh sửa thông tin cá nhân</a></td>
				</tr>
				<?php
				}
				}?>
			</table>
		</div>
	</div>
</div>
<?php
  include 'inc/footer.php';
?>