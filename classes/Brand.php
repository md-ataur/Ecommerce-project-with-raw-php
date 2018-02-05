
<?php
class Brand{
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}


	/* Brand add */
	public function brandInsert($brandName){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if (empty($brandName)) {
			$msg = "<span class='error'>Please fill the Field !</span>";
			return $msg;
		}else{
			$query  = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
			$result = $this->db->insert($query);
			if ($result) {
				$msg = "<span class='success'>Brand Successfully Added !</span>";
				return $msg;
			}
		}
	}


	/* All Brand fetch */
	public function getBrandAll(){
		$query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
		$result =  $this->db->select($query);
		return $result;
	}

	/* GetBrand by id */
	public function getBrandById($id){
		$query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* Brand update */
	public function brandUpdate($id, $brandName){
		$brandName = $this->fm->validation($brandName);
		$brandName = mysqli_real_escape_string($this->db->link, $brandName);

		if (empty($brandName)) {
			$msg = "<span class='error'>Please fill the field !</span>";
			return $msg;

		}else{
			$query = "UPDATE tbl_brand SET brandName ='$brandName' WHERE brandId ='$id'";
			$result = $this->db->update($query);
			if ($result) {
				echo "<script>window.location='brandlist.php'</script>";

			}else{
				$msg = "<span class='error'>No Updated !</span>";
				return $msg;
			}
		}	
	}

	/* Brand Delete */
	public function brandDelete($id){
		$query = "DELETE FROM tbl_brand WHERE brandId='$id'";
		$del = $this->db->delete($query);
		if ($del) {
			$msg = "<span class='success'>Brand Successfully Deleted !</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Not Deleted !</span>";
			return $msg;
		}

	} 

	

}

?>