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
    $id = Session::get('customer_id');
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
        $UpdateCustomer = $cs->Update_Customer($_POST, $id);
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['doipass'])) {
        $ChangePass = $cs->ChangePass_Customer($_POST, $id);
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
</style>

	<div id="breadcrumb" class="hoc clear" > 
    <!-- ################################################################################################ -->
    <h6 class="heading">Editprofile</h6>
    <ul>
      <li><a href="#">Trang chủ</a></li>
      <li><a href="#">Hồ sơ</a></li>
      <li><a href="#">Chỉnh sửa thông tin cá nhân</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
</div>

<div class="main">
	<div class="wrapper row2">
		<div class="hoc container clear">
	        <header class="heading" style=" font-family: Verdana, Geneva, sans-serif;
                                font-size:22px;
                                color:#F1832A;">Cập nhập Hồ sơ CÁ NHÂN</header>
            <div class="box_left">
			<form method="POST" action="" >
				<table class="tblone" >
					<tr>
						<?php
						if(isset($UpdateCustomer)){
							echo '<td colspan="3">'.$UpdateCustomer.'</td>';
						}
						?>
					</tr>
					<?php
					$id=Session::get('customer_id');
					$get_customer = $cs->show_customer($id);
					if($get_customer){
						while ($result=$get_customer->fetch_assoc()) {
					
					?>
					<tr>
						<td>Tên</td>
						<td><input type="text" name="name" value="<?php echo $result['name'] ?>"></td>
					</tr>
					<tr>
						<td>Địa chỉ</td>
						<td><input type="text" name="dia_chi" value="<?php echo $result['dia_chi'] ?>"></td>
					</tr>

					
					<tr>
						<td>Phone</td>
						<td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
					</tr>
					<tr>
						<td>E-Mail</td>
						<td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
					</tr>
					<!-- <tr>
						<td>Password</td>
						<td></td>
					</tr> -->
					<tr>
						<td colspan="3" ><input type="submit" name="save" value="Cập nhập" style="padding: 10px;
																						    background: #F1832A;
																						    color: #fff;
																						    border-radius: 4px;border: 0px solid #000;"></td>
					</tr>
					<?php
					}
					}?>
				</table>
			</form>
			</div>
			<div class="box_right">
			<form method="POST" action="">
				<table class="tblone">
					<tr>
						<?php
						if(isset($ChangePass)){
							echo '<td colspan="3">'.$ChangePass.'</td>';
						}
						?>
					</tr>

					<tr>
						<td>Mật khẩu mới</td>
						<td><input required type="password" name="password_yo"></td>
					</tr>
					<tr>
						<td>Nhập lại khẩu mới</td>
						<td><input required type="password" name="password_re"></td>
					</tr>
					<tr>
						<td colspan="3" ><input type="submit" name="doipass" value="Cập nhập" style="padding: 10px;
																						    background: #F1832A;
																						    color: #fff;
																						    border-radius: 4px;border: 0px solid #000;"></td>
					</tr>

				</table>
			</form>
			</div>
		</div>
	</div>
</div>
<?php
  include 'inc/footer.php';
?>