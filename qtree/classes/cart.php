<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class Cart
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function add_to_cart($amount, $id){

				$amount = $this->fm->validation($amount);
				$amount = mysqli_real_escape_string($this->db->link, $amount);
				$id = mysqli_real_escape_string($this->db->link, $id);
				$sId = session_id();

				$query = "SELECT * FROM mql_product WHERE productId = '$id'";
				$result = $this->db->select($query)->fetch_assoc();
				
				$image = $result["image"];
				$price = $result["price"];
				$productName = $result["productName"];

				$check_cart = "SELECT * FROM mql_cart WHERE productId = '$id' AND sId ='$sId'";
				$result_check = $this->db->select($check_cart);
				if($result_check){
					$msg = "Sản phẩm đã tồn tại";
					return $msg;
				}else{
					$query_insert = "INSERT INTO mql_cart(productId,amount,sId,image,price,productName) VALUES('$id','$amount','$sId','$image','$price','$productName')";
					$insert_cart = $this->db->insert($query_insert);
					// if($insert_cart){
					// 	$msg = "<span class='error'>Thêm sản phẩm thành công</span>";
					// 	return $msg;
						
					// }
					if($insert_cart){
						header("location:cart.php");
					}else{
						header("location:404.php");
					}
				}
			}
		public function get_product_cart(){
			$sId = session_id();
			$query = "SELECT * FROM mql_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_amount_cart($amount, $cartID){
			$amount = mysqli_real_escape_string($this->db->link, $amount);
			$cartID = mysqli_real_escape_string($this->db->link, $cartID);
			$query = "UPDATE mql_cart SET

			amount			= '$amount'
			WHERE cartID 	= '$cartID'";
			$result = $this->db->update($query);
			if($result){
				header("location: cart.php");
			}else{
				$msg = "<span class='error' style='margin: 20px auto 20px auto; width: 80%;'>
						Sản phẩm UPDATE không thành công</span>";
				return $msg;
			}
		}

		public function del_product_cart($cartID){
			$cartID = mysqli_real_escape_string($this->db->link, $cartID);
			$query = "DELETE FROM mql_cart WHERE cartID = '$cartID'";
			$result = $this->db->delete($query);
			if($result){
				header("location: cart.php");
			}else{
				$msg = "<span class='error' style='margin: 20px auto 20px auto; width: 80%;'>
						Xóa sản phẩm không thành công</span>";
				return $msg;
			}
		}
		public function check_cart(){
			$sId = session_id();
			$query = "SELECT * FROM mql_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function check_order($customer_id){
			$sId = session_id();
			$query = "SELECT * FROM mql_order WHERE customer_Id = '$customer_id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function del_all_data_cart(){
			$sId = session_id();
			$query = "DELETE FROM mql_cart WHERE sId = '$sId'";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertOrder($data,$customer_id){

			$tien_ship_save = mysqli_real_escape_string($this->db->link, $data['tien_ship_save']);
			$total_price= mysqli_real_escape_string($this->db->link, $data['tong_chi_phi2']);
			

			$sId = session_id();
			$query = "SELECT * FROM mql_cart WHERE sId = '$sId'";
			$get_product = $this->db->select($query);
			if($get_product && $tien_ship_save){
				while($result = $get_product->fetch_assoc()){
					$productID = $result['productID'];
					$productName = $result['productName'];
					$amount = $result['amount'];
					$price = $result['price'];
					$image = $result['image'];
					$customer_Id = $customer_id;
					$sub_price = $result['price'] * $amount;
					$query_order = "INSERT INTO mql_order(productId,productName,customer_Id,amount,price,image,tien_ship_save,sub_price,total_price) VALUES('$productID','$productName','$customer_Id','$amount','$price','$image','$tien_ship_save','$sub_price','$total_price')";

					$insert_order = $this->db->insert($query_order);
       				if($insert_order){
       					header('Location:success.php');
       				}
				}
			}else{
				header("location:404.php");

			}
		}
		public function get_tongchiphi($customer_id){
			$query = "SELECT * FROM mql_order WHERE customer_Id = '$customer_id' ";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_cart_ordered($customer_id){
			$query = "SELECT * FROM mql_order WHERE customer_Id = '$customer_id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_inbox_cart(){
			$query = "SELECT * FROM mql_order ORDER BY date_order";
			$result = $this->db->select($query);
			return $result;
		}
		public function shifted($id,$time,$price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE mql_order SET

					status = '1'

					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Cập nhập Thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Cập nhập không Thành công</span>";
				return $msg;
			}
		}
		public function del_shifted($id,$time,$price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "DELETE FROM mql_order 
					WHERE id = '$id' AND date_order='$time' AND price ='$price'";
			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Xóa thành công</span>";
				return $msg;
			}else{
				$msg = "<span class='error'>Xóa không thành công</span>";
				return $msg;
			}
		}
		public function shifted_confirm($id,$time,$price){
			$id = mysqli_real_escape_string($this->db->link, $id);
			$time = mysqli_real_escape_string($this->db->link, $time);
			$price = mysqli_real_escape_string($this->db->link, $price);
			$query = "UPDATE mql_order SET

					status = '2'

					WHERE customer_id = '$id' AND date_order='$time' AND price ='$price'";
			$result = $this->db->update($query);
			return $result;
		}
		public function show_thu(){
			$query = "SELECT * FROM mql_order WHERE status='2' ";
			$result = $this->db->select($query);
			return $result;
		}






	}

?>