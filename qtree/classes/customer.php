<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class Customer
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_Customer($data){
			$Name = mysqli_real_escape_string($this->db->link, $data['Name']);
			$eMail = mysqli_real_escape_string($this->db->link, $data['eMail']);
			$Address = mysqli_real_escape_string($this->db->link, $data['Address']);
			$Phone = mysqli_real_escape_string($this->db->link, $data['Phone']);
			$re_pass = mysqli_real_escape_string($this->db->link, md5($data['re_pass']));
			$Password = mysqli_real_escape_string($this->db->link, md5($data['Password']));
		
			if($Name=="" || $eMail =="" || $Address =="" || $re_pass =="" || $Phone =="" || $Password ==""){
				$alert = "<span class='error'>Không được bỏ trống !!!</span>";
				return $alert;
			}else{
				$check_email = "SELECT * FROM mql_customer WHERE email='$eMail' LIMIT 1";
				$result_check = $this->db->select($check_email);
				if($result_check){
					$alert = "<span class='error'>Email đã được đăng ký!!! Vui lòng nhập Email khác</span>";
					return $alert;
				}if($re_pass != $Password){
					$alert = "<span class='error'>Password không trùng khớp</span>";
					return $alert;

				}else{
					$query = "INSERT INTO mql_customer(name, dia_chi, re_pass, phone, email, password) VALUES('$Name','$Address','$re_pass','$Phone', '$eMail', '$Password')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Đăng ký thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Đăng ký không thành công</span>";
						return $alert;
					}
				}
			}
		}
		public function login_Customer($data){
			$eMail = mysqli_real_escape_string($this->db->link, $data['eMail']);
			$Password = mysqli_real_escape_string($this->db->link, md5($data['Password']));

			if($eMail =="" || $Password ==""){
				$alert = "<span class='error'>Không được bỏ trống !!!</span>";
				return $alert;
			}else{
				$check_login = "SELECT * FROM mql_customer WHERE email='$eMail' AND password='$Password'";
				$result_check = $this->db->select($check_login);
				if($result_check != false){
					$VALUES = $result_check->fetch_assoc();
					Session::set('customer_login', true);
					Session::set('customer_id', $VALUES['id']);
					Session::set('customer_name', $VALUES['name']);
					header('Location:welcome.php');
				}else{
					$alert = "<span class='error'>Email hoặc Password không đúng</span>";
					return $alert;
					}
				}
			}
		public function show_customer($id){
			$query = "SELECT * FROM mql_customer WHERE id='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function Update_Customer($data, $id){
			$Name = mysqli_real_escape_string($this->db->link, $data['name']);
			$re_pass = mysqli_real_escape_string($this->db->link, $data['re_pass']);
			$eMail = mysqli_real_escape_string($this->db->link, $data['email']);
			$Address = mysqli_real_escape_string($this->db->link, $data['dia_chi']);
			$Phone = mysqli_real_escape_string($this->db->link, $data['phone']);
		
			if($Name=="" || $re_pass=="" || $eMail =="" || $Address =="" || $Phone ==""){
				$alert = "<span class='error'>Không được bỏ trống !!!</span>";
				return $alert;
			}else{
				$query = "UPDATE mql_customer SET name='$Name', dia_chi='$Address', re_pass='$re_pass', phone='$Phone', email='$eMail' WHERE id='$id'";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Cập nhập thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhập không thành công</span>";
					return $alert;
					}
				}
			}
		public function insert_binhluan(){
			$product_id = $_POST['product_id_binhluan'];
			$productName = $_POST['productName_id_binhluan'];
			$nameCMT = $_POST['nameCMT'];
			$emailCMT = $_POST['emailCMT'];
			$phoneCMT = $_POST['phoneCMT'];
			$commentCMT = $_POST['commentCMT'];
			// if($tenbinhluan=='' || $binhluan==''){
			// 	$alert = "<span class='error'>Không để trống các trường</span>";
			// 	return $alert;
			// }else{
				$query = "INSERT INTO mql_cmt(ten_cmt,cmt,product_id,productName,SĐT,email) VALUES('$nameCMT','$commentCMT','$product_id','$productName','$phoneCMT','$emailCMT')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Bình luận đã gửi, đang chờ admin duyệt</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Bình luận không thành công</span>";
						return $alert;
				}
			// }
		}
		public function get_cmt(){
			$query = "SELECT * FROM mql_cmt";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_adcmt($id){
			$query = "SELECT * FROM mql_cmt WHERE cmt_id ='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_show_cmt(){
			$pro_id = $_GET['proid'];
			// $getname = "SELECT productName FROM mql_product WHERE pro_id='$pro_id'";
			// $truyvan = mysqli_query($conn, $getname);
			// $prd_name =mysqli_fetch_array($truyvan)['pro_name'];

			$query = "SELECT ten_cmt, date_cmt, cmt, status
			FROM mql_cmt INNER JOIN mql_product
			ON mql_cmt.product_id = mql_product.productId
			WHERE product_id = '$pro_id'
			ORDER BY date_cmt desc"; 
			// thêm DESC sx thứ tự  hiển thị
			$result = $this->db->select($query);
			return $result;
		}
		public function shifted_cmt($id,$date_cmt,$ten_cmt){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$ten_cmt = mysqli_real_escape_string($this->db->link, $ten_cmt);
			$date_cmt = mysqli_real_escape_string($this->db->link, $date_cmt);
			$query = "UPDATE mql_cmt SET

					status = '1'

					WHERE product_id = '$id' AND date_cmt='$date_cmt' AND ten_cmt ='$ten_cmt'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Duyệt Thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Duyệt không Thành công</span>";
				return $msg;
			}
		}
		public function del_shifted_cmt($id,$date_cmt,$ten_cmt){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$ten_cmt = mysqli_real_escape_string($this->db->link, $ten_cmt);
			$date_cmt = mysqli_real_escape_string($this->db->link, $date_cmt);
			$query = "DELETE FROM mql_cmt 
					WHERE productName = '$id' AND ten_cmt ='$ten_cmt' AND date_cmt='$date_cmt'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Xóa thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Xóa không thành công</span>";
				return $msg;
			}
		}
		public function insert_lienhe(){
			$nameLH = $_POST['nameLh'];
			$emailLH = $_POST['emailLh'];
			$phoneLH = $_POST['phoneLh'];
			$LienHe = $_POST['Lh'];
			// if($tenbinhluan=='' || $binhluan==''){
			// 	$alert = "<span class='error'>Không để trống các trường</span>";
			// 	return $alert;
			// }else{
				$query = "INSERT INTO mql_lienhe(name,SĐT,email,lh) VALUES('$nameLH','$phoneLH','$emailLH','$LienHe')";
					$result = $this->db->insert($query);
					if($result){
						$alert = "<span class='success'>Góp ý đã gửi, chúng tôi cảm ơn bạn!!!</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Góp ý không thành công</span>";
						return $alert;
				}
			// }
		}
		public function get_lh(){
			$query = "SELECT * FROM mql_lienhe";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_lh_details($id){
			$query = "SELECT * FROM mql_lienhe WHERE id ='$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_lh($id){
			$query = "DELETE FROM mql_lienhe where id = '$id'";
			$result = $this->db->delete($query);
			if($result){
				if($result){
					$alert = "<span class='success'>Xóa thư góp ý thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Xóa không thành công</span>";
					return $alert;
				}
			}
		}
		public function ChangePass_Customer($data, $id){

			$password_yo = mysqli_real_escape_string($this->db->link, md5($data['password_yo']));
			$password_re = mysqli_real_escape_string($this->db->link, md5($data['password_re']));

				if($password_yo != $password_re){
					$alert = "<span class='error'>Password không trùng khớp</span>";
					return $alert;
				}else{
					$query2 = "UPDATE mql_customer SET

					password 	= '$password_yo',
					re_pass 	= '$password_re'

					WHERE id ='$id'";

				$result2 = $this->db->update($query2);
				if($result2){
					$alert = "<span class='success'>Cập nhập thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhập không thành công</span>";
					return $alert;
					}
				}
	}
	public function showlist_customer(){
			$query = "SELECT * FROM mql_customer";
			$result = $this->db->select($query);
			return $result;
	}






	}
?>