<?php
	include '../classes/adminlogin.php';
?>
<?php
	$class = new Adminlogin();
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		$adminUser = $_POST['adminUser'];
		$adminPass = md5($_POST['adminPass']);
		$chucvu = $_POST['chucvu'];

		$login_check = $class->login_admin($adminUser,$adminPass,$chucvu);
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Trang Đăng Nhập</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
	<div class="container my-md-5 text-center">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4" style="
				background-color:#F9F9F9;
				border-radius:  7px;">
				<form action="login.php" method="post">
				<br>
					<h2 class="content title">Đăng Nhập</h2>
				<br>
					<p style="font-size: 11px; color: #FBAB45;">Không phận sự đừng đăng nhập</p>
					<p style="font-size: 11px; color: #FBAB45;"> có User/Pass không ???</p>
				<br>
					<span><?php

						if(isset($login_check)){
							echo $login_check;
						}

					?></span>
				<br>

					<tr>
						<td class="text-left"></td>
						<td><input required type="text" class="form-control" name="adminUser" placeholder="Username" style="margin: 8px 0;">					
								<!-- placeholder=""-------văn bản giữ chỗ -->
						</td>
					</tr>

					<tr>
						<td class="text-left"></td>
						<td><input required type="password" class="form-control" name="adminPass" placeholder="Password" style="margin: 8px 0;"></td>
					</tr>

					<tr>
						<td><select name="chucvu" style="width: 100%;
															padding: 7px 7px;
															box-sizing: border-box;
															border-radius: 0.25rem;
															border-width: 2px">
							<option value="">Bộ Phận</option>
							<option value="3">Tài chính</option>
							<option value="1">Bán hàng</option>
							<option value="2">Thủ Kho</option>
						</select></td>
					</tr>
				<br>
				<br>
					<tr>
					<td></td>
					<button class="btn btn-info btn-block" value="Log in" type="submit">Đăng nhập</button>
					</tr>
				<br>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>