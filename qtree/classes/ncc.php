<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
	class Ncc
	{	
		private $db;
		private $fm;

		public function __construct(){
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function insert_ncc($ncc,$diachi){

			$ncc = $this->fm->validation($ncc);
			$diachi = $this->fm->validation($diachi);

			$ncc = mysqli_real_escape_string($this->db->link, $ncc);
			$diachi = mysqli_real_escape_string($this->db->link, $diachi);

				$query = "INSERT INTO mql_ncc(nameNcc,dia_chi) VALUES('$ncc','$diachi')";
				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Thêm thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Thêm không thành công</span>";
					return $alert;
				}
			}
		public function show_NCC(){
			$query = "SELECT * FROM mql_ncc order by idNcc desc";
			$result = $this->db->select($query);
			return $result;
		}
		//show ở edit
		public function getNCCbyId($id){ 
			$query = "SELECT * FROM mql_ncc where idNCC = '$id'";
			$result = $this->db->select($query);
			return $result;
		}
		public function update_NCC($name_NCC,$id,$dia_chiNCC){

			$name_NCC = $this->fm->validation($name_NCC);
			$dia_chiNCC = $this->fm->validation($dia_chiNCC);

			$name_NCC = mysqli_real_escape_string($this->db->link, $name_NCC);
			$dia_chiNCC = mysqli_real_escape_string($this->db->link, $dia_chiNCC);
			$id = mysqli_real_escape_string($this->db->link, $id);

				$query = "UPDATE mql_ncc SET nameNcc = '$name_NCC', dia_chi='$dia_chiNCC' WHERE idNcc ='$id'";
				$result = $this->db->update($query);
				if($result){
					$alert = "<span class='success'>Cập nhập thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Cập nhập không thành công</span>";
					return $alert;
				}
			}
		public function del_ncc($id){
			$query = "DELETE FROM mql_ncc where idNcc = '$id'";
			$result = $this->db->delete($query);

				if($result){
					$alert = "<span class='success'>Xóa thành công</span>";
					return $alert;
				}else{
					$alert = "<span class='error'>Xóa không thành công</span>";
					return $alert;
				}
			}





}