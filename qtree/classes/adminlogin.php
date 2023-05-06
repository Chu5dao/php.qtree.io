<?php
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../lib/session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class Adminlogin
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function login_admin($adminUser,$adminPass,$chucvu){
			$adminUser = $this->fm->validation($adminUser);
			$adminPass = $this->fm->validation($adminPass);
			$chucvu = $this->fm->validation($chucvu);

			$adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
			$adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
			$chucvu = mysqli_real_escape_string($this->db->link, $chucvu);

			// if(empty($adminUser) || empty($adminPass)){
			// 	$alert = "User-Pass không được để trống!!!";
			// 	return $alert;
			// }else
			if (empty($chucvu)) {
				$alert = "Vui lòng chọn chức năng!!!";
				return $alert;
			}else{
				$query = "SELECT * FROM mql_admin WHERE adminUser = '$adminUser' AND adminPass = '$adminPass' AND level='$chucvu' LIMIT 1";
				$result = $this->db->select($query);

				if($result != false){
					$value = $result->fetch_assoc();

					Session::set('adminlogin', true); /*cùng tên với SS của checkSS*/

					Session::set('adminId', $value['adminId']);
					Session::set('adminUser', $value['adminUser']);
					Session::set('adminName', $value['adminName']);
					Session::set('chucvu', $value['level']);

					if($chucvu == 1){
						header('Location:../adbanhang/index.php');
						}if($chucvu == 3){
							header('Location:../adtaichinh/index.php');
						}if($chucvu == 2){
							header('Location:../adkho/index.php');
						}	
				}else{
				$alert = "User-Pass hoặc Chức năng không đúng !!!";
				return $alert;
				}
				
			}
		}
		











	}
?>