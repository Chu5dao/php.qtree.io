<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class User
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_member($data){

			$memName = mysqli_real_escape_string($this->db->link, $data['memName']);
			$memNickName = mysqli_real_escape_string($this->db->link, $data['memNickName']);
			$memEmail = mysqli_real_escape_string($this->db->link, $data['memEmail']);
			$chucvu = mysqli_real_escape_string($this->db->link, $data['chucvu']);
			$memPass = mysqli_real_escape_string($this->db->link, md5($data['memPass']));
			$memRe_Pass = mysqli_real_escape_string($this->db->link, md5($data['memRe_Pass']));
			$store = mysqli_real_escape_string($this->db->link, $data['store']);


			$check_user = "SELECT * FROM mql_admin WHERE adminUser='$memName' LIMIT 1";
			$check_email = "SELECT * FROM mql_admin WHERE adminEmail='$memEmail' LIMIT 1";
			$result_check1 = $this->db->select($check_user);
			$result_check2 = $this->db->select($check_email);
				if($result_check1){
					$alert = "<span class='error'>Tên đăng nhập đã được đăng ký!!! Vui lòng nhập Tên đăng nhập khác</span>";
					return $alert;
				}
				if($result_check2){
					$alert = "<span class='error'>Email đã được đăng ký!!! Vui lòng nhập Email khác</span>";
					return $alert;
				}
				if($memRe_Pass != $memPass){
					$alert = "<span class='error'>Password không trùng khớp</span>";
					return $alert;
				}else{
			$query = "INSERT INTO mql_admin(adminName,adminEmail,adminUser,adminPass,re_pass,level,store) VALUES('$memNickName','$memEmail','$memName','$memPass','$memRe_Pass','$chucvu','$store')";
			$result = $this->db->insert($query);
			if($result){
				$alert = "<span class='success'>Thêm Thành viên thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Thêm không thành công</span>";
				return $alert;
			}
			}
		}
		public function show_member(){
			$query = "SELECT * FROM mql_admin where adminId !=1 ";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_mem($id){
			$query = "DELETE FROM mql_admin where adminId = '$id'";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thư góp ý thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
		}
		// show bên edit
		public function getmembyId($id){
			$query = "SELECT * FROM mql_admin where adminId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_mem($data, $id){

			$memName = mysqli_real_escape_string($this->db->link, $data['memName']);
			$memNickName = mysqli_real_escape_string($this->db->link, $data['memNickName']);
			$memEmail = mysqli_real_escape_string($this->db->link, $data['memEmail']);
			$chucvu = mysqli_real_escape_string($this->db->link, $data['chucvu']);
			$memPass_yo = mysqli_real_escape_string($this->db->link, md5($data['memPass_yo']));
			$memRe_Pass_yo = mysqli_real_escape_string($this->db->link, md5($data['memRe_Pass_yo']));
			$store = mysqli_real_escape_string($this->db->link, $data['store']);

				if($memPass_yo != $memRe_Pass_yo){
				$alert = "<span class='error'>Password không trùng khớp</span>";
				return $alert;

				}else{
					$query = "UPDATE mql_admin SET

					adminUser	= '$memName',
					adminName 	= '$memNickName',
					adminEmail	= '$memEmail',	
					level 		= '$chucvu',
					adminPass 	= '$memPass_yo',
					re_pass 	= '$memRe_Pass_yo',
					store 		= '$store'

					WHERE adminId ='$id'";

				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhập thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhập không thành công</span>";
					return $alert;
					}
				}
		}
		public function insert_store($Diachi,$Phone,$Email){
			$Diachi = $this->fm->validation($Diachi);
			$Phone = $this->fm->validation($Phone);
			$Email = $this->fm->validation($Email);

			$Diachi = mysqli_real_escape_string($this->db->link, $Diachi);
			$Phone = mysqli_real_escape_string($this->db->link, $Phone);
			$Email = mysqli_real_escape_string($this->db->link, $Email);
			$check= "SELECT * FROM mql_store WHERE addr='$Diachi' LIMIT 1";
			$result2 = $this->db->select($check);
			if($result2){
				$alert = "<span class='error'>Địa chỉ đã tồn tại</span>";
				return $alert;
			}else{
			$query = "INSERT INTO mql_store(addr,phone,email) VALUES('$Diachi','$Phone','$Email')";
			$result = $this->db->insert($query);
				if($result){
				$alert = "<span class='success'>Thêm thành công</span>";
				return $alert;
				}else{
				$alert = "<span class='error'>Thêm không thành công</span>";
				return $alert;
				}
			}
		}
		public function show_Store(){
			$query = "SELECT * FROM mql_store order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_store($id){
		$query = "DELETE FROM mql_store where id = '$id'";
		$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Xóa thành công</span>";
				return $alert;
			}else{
				$alert = "<span class='error'>Xóa không thành công</span>";
				return $alert;
			}
		}
		public function getstorebyId($id){
			$query = "SELECT * FROM mql_store where id = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_store($data, $id){
			$diachi = mysqli_real_escape_string($this->db->link, $data['diachi']);
			$sđt = mysqli_real_escape_string($this->db->link, $data['sđt']);
			$Email = mysqli_real_escape_string($this->db->link, $data['Email']);

					$query = "UPDATE mql_store SET

					addr	= '$diachi',
					phone 	= '$sđt',
					email	= '$Email'

					WHERE id ='$id'";

				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhập thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhập không thành công</span>";
					return $alert;
				}
		}










	}
?>