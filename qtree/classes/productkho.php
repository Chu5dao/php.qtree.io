<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class ProKho
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
	public function insert_product($data){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$NCC = mysqli_real_escape_string($this->db->link, $data['NCC']);
			$quantity  = mysqli_real_escape_string($this->db->link, $data['quantity']);


				$query = "INSERT INTO mql_productkho(productName, catId, price, nccId,quantity) VALUES('$productName','$category','$price','$NCC','$quantity')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm Sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm Sản phẩm không thành công</span>";
					return $alert;
				}
		
		}
		public function show_product(){
			$query = "SELECT mql_productkho.*, mql_category.catName, mql_ncc.nameNcc
			FROM mql_productkho INNER JOIN mql_category ON mql_productkho.catId = mql_category.catId
			INNER JOIN mql_ncc ON mql_productkho.nccId = mql_ncc.idNcc
			order by mql_productkho.productId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproductbyId($id){
			$query = "SELECT * FROM mql_productkho where productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_product($data, $id){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$quantity = mysqli_real_escape_string($this->db->link, $data['quantity']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$NCC = mysqli_real_escape_string($this->db->link, $data['NCC']);



			if($productName=="" || $category=="" || $price=="" || $quantity =="" || $NCC==""){
				$alert = "<span class='error'>Không được bỏ trống !!!</span>";
				return $alert;
			}else{
					// Nếu người dùng không chọn ảnh
					$query = "UPDATE mql_productkho SET

					productName		= '$productName',
					catId 			= '$category',
					quantity		= '$quantity',
					price 			= '$price',
					nccID 			= '$NCC'

					WHERE productId ='$id'";

				}
			
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Sửa Sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Sửa Sản phẩm không thành công</span>";
					return $alert;
				}
			}
		
		public function del_product($id){
			$query = "DELETE FROM mql_productkho where productId = '$id'";
			$result = $this->db->delete($query);
				if($result){
					$alert = "<span class='success'>Xóa Sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Xóa Sảm phẩm không thành công</span>";
					return $alert;
				}
		}






}