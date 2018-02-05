
<?php
class Category{
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	/* Category add */
	public function catInsert($catname){
		$catname = $this->fm->validation($catname);
		$catname = mysqli_real_escape_string($this->db->link, $catname);

		if (empty($catname)) {
			$msg = "<span class='error'>Please fill the Field !</span>";
			return $msg;
		}else{
			$query  = "INSERT INTO tbl_category(catname) VALUES('$catname')";
			$result = $this->db->insert($query);
			if ($result) {
				$msg = "<span class='success'>Category Successfully Added !</span>";
				return $msg;
			}
		}
	}

	/* All category fetch */
	public function getCatAll(){
		$query = "SELECT * FROM tbl_category ORDER BY catId DESC";
		$result =  $this->db->select($query);
		return $result;
	}

	/* GetCategory by id */
	public function getCatById($id){
		$query = "SELECT * FROM tbl_category WHERE catId = '$id'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* Category update */
	public function catUpdate($id, $catname){
		$catname = $this->fm->validation($catname);
		$catname = mysqli_real_escape_string($this->db->link, $catname);

		if (empty($catname)) {
			$msg = "<span class='error'>Please fill the Field !</span>";
			return $msg;

		}else{
			$query = "UPDATE tbl_category SET catname ='$catname' WHERE catId ='$id'";
			$result = $this->db->update($query);
			if ($result) {
				echo "<script>window.location='catlist.php'</script>";

			}else{
				$msg = "<span class='error'>No Updated !</span>";
				return $msg;
			}
		}	
	}

	/* Category Delete */
	public function catDelete($id){
		$query = "DELETE FROM tbl_category WHERE catId='$id'";
		$del = $this->db->delete($query);
		if ($del) {
			$msg = "<span class='success'>Category Successfully Deleted !</span>";
			return $msg;
		}else{
			$msg = "<span class='error'>Not Deleted !</span>";
			return $msg;
		}

	} 


}

?>