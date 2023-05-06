<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class Category
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_category($catName){

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if(empty($catName)){
				$alert = "<span class='error'>Chưa có tên danh mục</span>";
				return $alert;
			}else{
				$query = "INSERT INTO mql_category(catName) VALUES('$catName')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm Danh mục thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm Danh mục không thành công</span>";
					return $alert;
				}
			}
		}
		public function show_category(){
			$query = "SELECT * FROM mql_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_category($catName, $id){

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);
			$id = mysqli_real_escape_string($this->db->link, $id);

			if(empty($catName)){
				$alert = "<span class='error'>Chưa có tên danh mục</span>";
				return $alert;
			}else{
				$query = "UPDATE mql_category SET catName = '$catName' WHERE catId ='$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Sửa Danh mục thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Sửa Danh mục không thành công</span>";
					return $alert;
				}
			}
		}
		public function del_category($id){
			$query = "DELETE FROM mql_category where catId = '$id'";
			$result = $this->db->delete($query);

				if($result){
					$alert = "<span class='success'>Xóa Danh mục thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Xóa Danh mục không thành công</span>";
					return $alert;
				}
			}

		public function getcatbyId($id){
			$query = "SELECT * FROM mql_category where catId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function show_category_fontend(){
			$query = "SELECT * FROM mql_category order by catId desc";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_product_by_cat($id){
			$query = "SELECT * FROM mql_product where catId='$id' order by catId desc LIMIT 12";
			$result = $this->db->select($query);
			return $result;
		}
		public function get_name_by_cat($id){
			$query = "SELECT mql_product.*,mql_category.catName,mql_category.catId FROM mql_product,mql_category where mql_product.catId = mql_category.catId AND mql_product.catId ='$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}
	}
?>