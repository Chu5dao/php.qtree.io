<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class Product
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_product($data, $file){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			//Kiểm tra hình ảnh và lấy hình ảnh cho vào folder 'uploads'
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName=="" || $category=="" || $price=="" || $type =="" || $file_name ==""){
				$alert = "<span class='error'>Không được bỏ trống !!!</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO mql_product(productName, catId, product_desc, price, type, image) VALUES('$productName','$category','$product_desc','$price','$type','$unique_image')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm Sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm Sản phẩm không thành công</span>";
					return $alert;
				}
			}
		}
		public function show_product(){
			$query = "SELECT mql_product.*, mql_category.catName
			FROM mql_product INNER JOIN mql_category ON mql_product.catId = mql_category.catId
			order by mql_product.productId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_product($data, $file, $id){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$price = mysqli_real_escape_string($this->db->link, $data['price']);
			$type = mysqli_real_escape_string($this->db->link, $data['type']);

			//Kiểm tra hình ảnh và lấy hình ảnh cho vào folder 'uploads'
			$permited = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($productName=="" || $category=="" || $price=="" || $type ==""){
				$alert = "<span class='error'>Không được bỏ trống !!!</span>";
				return $alert;
			}else{
				if(!empty($file_name)){
					// Nếu người dùng chọn ảnh
					if($file_size > 204800){
						$alert = "<span class='error'> Kích thước hình ảnh phải nhỏ hơn 2MB !!!</span>";
						return $alert;
					}elseif (in_array($file_ext, $permited) === false){
						$alert = "<span class='error'>Bạn chỉ có thể tải lên:-".implode(', ', $permited)."</span>";
						return $alert;}

					move_uploaded_file($file_temp, $uploaded_image);	
					$query = "UPDATE mql_product SET

					productName		= '$productName',
					catId			= '$category',
					product_desc	= '$product_desc',
					price			= '$price',
					type			= '$type',
					image			= '$unique_image'

					WHERE productId ='$id'";

				}else{
					// Nếu người dùng không chọn ảnh
					$query = "UPDATE mql_product SET

					productName		= '$productName',
					catId 			= '$category',
					product_desc	= '$product_desc',
					price 			= '$price',
					type 			= '$type'

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
		}
		public function del_product($id){
			$query = "DELETE FROM mql_product where productId = '$id'";
			$result = $this->db->delete($query);
				if($result){
					$alert = "<span class='success'>Xóa Sản phẩm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Xóa Sảm phẩm không thành công</span>";
					return $alert;
				}
		}
		public function getproductbyId($id){
			$query = "SELECT * FROM mql_product where productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		// END BACKEND
		public function getproduct_noibat(){
			$query = "SELECT * FROM mql_product where type = '1' ORDER BY productId desc Limit 8";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_new(){
			$sp_tungtrang = 8;
			if(!isset($_GET['trang'])){
				$trang = 1;
			}else{
				$trang = $_GET['trang'];
			}
			$tung_trang = ($trang-1)*$sp_tungtrang;

			$query = "SELECT * FROM mql_product order by productId desc LIMIT $tung_trang,$sp_tungtrang";
			$result = $this->db->select($query);
			return $result;
		}
		public function getproduct_all(){
			$query = "SELECT * FROM mql_product";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_details($id){
			$query = "SELECT mql_product.*, mql_category.catName
			FROM mql_product INNER JOIN mql_category ON mql_product.catId = mql_category.catId
			WHERE mql_product.productId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_wishlist($customer_id){
			$query = "SELECT * FROM mql_wishlist WHERE customer_id = '$customer_id' order by id desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function insertWishlist($productid, $customer_id){
			$productid = mysqli_real_escape_string($this->db->link, $productid);
			$customer_id = mysqli_real_escape_string($this->db->link, $customer_id);
			
			$check_wlist = "SELECT * FROM mql_wishlist WHERE productId = '$productid' AND customer_id ='$customer_id'";
			$result_check_wlist = $this->db->select($check_wlist);

			if($result_check_wlist){
				$msg = "<span class='error'>Product Already Added to Wishlist</span>";
				return $msg;
			}else{

			$query = "SELECT * FROM mql_product WHERE productId = '$productid'";
			$result = $this->db->select($query)->fetch_assoc();
			
			$productName = $result["productName"];
			$price = $result["price"];
			$image = $result["image"];

			
			
			$query_insert = "INSERT INTO mql_wishlist(productId,price,image,customer_id,productName) VALUES('$productid','$price','$image','$customer_id','$productName')";
			$insert_wlist = $this->db->insert($query_insert);

			if($insert_wlist){
						$alert = "<span class='success'>Thêm vào Yêu Thích thành công</span>";
						return $alert;
					}else{
						$alert = "<span class='error'>Thêm vào Yêu Thích không thành công</span>";
						return $alert;
					}
			}
		}
		public function del_wlist($proid,$customer_id){
			$query = "DELETE FROM mql_wishlist where productId = '$proid' AND customer_id='$customer_id'";
			$result = $this->db->delete($query);
			return $result;
		}
		public function search_product($tukhoa){
			$tukhoa = $this->fm->validation($tukhoa);
			$query = "SELECT * FROM mql_product WHERE productName LIKE '%$tukhoa%'";
			$result = $this->db->select($query);
			return $result;

		}
	}
?>