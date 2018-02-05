<?php
class Product{
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}


	/* Dashboard: product insert */
	public function productInsert($data, $file){

		$productName = $this->fm->validation($data['productName']);
		$catId 		 = $this->fm->validation($data['catId']);
		$brandId 	 = $this->fm->validation($data['brandId']);
		$body 		 = $this->fm->validation($data['body']);
		$price  	 = $this->fm->validation($data['price']);
		$type 		 = $this->fm->validation($data['type']);
		

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);



		/* file upload */
		$permited  = array('jpg', 'jpeg', 'png', 'gif' );
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];
		
		$explode = explode('.', $file_name);
		$file_ext = strtolower(end($explode));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$upload_img = "upload/".$unique_image;


		/* validation */
		if (empty($productName) or empty($catId) or empty($brandId) or empty($body) or empty($price) or $type == "" or empty($file_name)) {
			$msg = "<span class='error'>Field must not be empty !</span>";
			return $msg;

		}elseif ($file_size > 1048576) {
			$msg = "<span class='error'> Image size should be less than 1 MB !</span>";
			return $msg;

		}elseif (in_array($file_ext, $permited) === false) {
			$msg = "<span class='error'> You can upload only:-".implode(', ', $permited). "</span>";
			return $msg;

		}else{
			move_uploaded_file($file_temp, $upload_img);
			$query  = "INSERT INTO tbl_product(productName, catId, brandId, body, price, type, image) VALUES ('$productName', '$catId', '$brandId', '$body', '$price', '$type', '$upload_img')";
			$result = $this->db->insert($query);

			if($result){
				$msg = "<span class='success'>Product Successfully Inserted!</span>";
				return $msg;

			}else{
				$msg = "<span class='error'>Not Inserted!</span>";
				return $msg;
			}
		}

	}



	/* Dashboard: Products fetch with 3 table combine */
	public function getAllProduct(){
		
		$query ="SELECT p.*, c.catname, b.brandName
				FROM tbl_product as p, tbl_category as c, tbl_brand as b
				WHERE p.catId = c.catId AND p.brandId = b.brandId
				ORDER BY p.productId DESC";

		/*
		$query ="SELECT tbl_product.*, tbl_category.catname, tbl_brand.brandName
				FROM tbl_product
				INNER JOIN tbl_category
				ON tbl_product.catId = tbl_category.catId
				INNER JOIN tbl_brand
				ON tbl_product.brandId = tbl_brand.brandId
				ORDER BY tbl_product.productId DESC";
			*/	

		$result =  $this->db->select($query);
		return $result;
	}


	/* Dashboard: get product by id */
	public function getProById($id){
		$query  = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$result =  $this->db->select($query);
		return $result;
	}


	/* Dashboard: product update by id */
	public function productUpdate($data, $file, $id){
		$productName = $this->fm->validation($data['productName']);
		$catId 		 = $this->fm->validation($data['catId']);
		$brandId 	 = $this->fm->validation($data['brandId']);
		$body 		 = $this->fm->validation($data['body']);
		$price  	 = $this->fm->validation($data['price']);
		$type 		 = $this->fm->validation($data['type']);
		

		$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
		$catId 		 = mysqli_real_escape_string($this->db->link, $data['catId']);
		$brandId 	 = mysqli_real_escape_string($this->db->link, $data['brandId']);
		$body 		 = mysqli_real_escape_string($this->db->link, $data['body']);
		$price 		 = mysqli_real_escape_string($this->db->link, $data['price']);
		$type 		 = mysqli_real_escape_string($this->db->link, $data['type']);



		/* file upload */
		$permited  = array('jpg', 'jpeg', 'png', 'gif' );
		$file_name = $file['image']['name'];
		$file_size = $file['image']['size'];
		$file_temp = $file['image']['tmp_name'];
		
		$explode = explode('.', $file_name);
		$file_ext = strtolower(end($explode));
		$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
		$upload_img = "upload/".$unique_image;


		/* validation */
		if (empty($productName) or empty($catId) or empty($brandId) or empty($body) or empty($price) or $type == "" ) {
			$msg = "<span class='error'>Field must not be empty !</span>";
			return $msg;

		}else{

			if (!empty($file_name)) {

				if ($file_size > 1048576) {
					$msg = "<span class='error'> Image size should be less than 1 MB !</span>";
					return $msg;

				}elseif (in_array($file_ext, $permited) === false) {
					$msg = "<span class='error'> You can upload only:-".implode(', ', $permited). "</span>";
					return $msg;

				}else{
					move_uploaded_file($file_temp, $upload_img);
					$query ="UPDATE tbl_product 
								SET 
								productName = '$productName', 
								catId 		= '$catId', 
								brandId 	= '$brandId', 
								body 		= '$body', 
								price 		= '$price', 
								type 		= '$type', 
								image 		= '$upload_img' 
								WHERE productId = '$id'";

					$result = $this->db->update($query);
					if($result){
						/*
						$msg = "<span class='success'>Product Successfully Updated!</span>";
						return $msg;
						*/

						/*
						header('Location:'.$_SERVER['REQUEST_URI']); //redirect to the exactly same page 
						exit;
						*/

						echo "<script>window.location='productlist.php'</script>";
						//header('Location: productlist.php');

					}else{
						$msg = "<span class='error'>Not Updated!</span>";
						return $msg;
					}
				}

			} else{
				$query="UPDATE tbl_product 
							SET 
							productName = '$productName', 
							catId 		= '$catId', 
							brandId 	= '$brandId', 
							body 		= '$body', 
							price 		= '$price', 
							type 		= '$type'
							WHERE productId = '$id'";

				$result = $this->db->update($query);
				if($result){
					/*
					$msg = "<span class='success'>Product Successfully Updated!</span>";
					return $msg;
					*/

					/*
					header('Location:'.$_SERVER['REQUEST_URI']); //redirect to the exactly same page
					exit;
					*/
					echo "<script>window.location='productlist.php'</script>";
					//header('Location: productlist.php');
	
				}else{
					$msg = "<span class='error'>Not Updated!</span>";
					return $msg;
				}
			}
		}
	}

	/* Dashboard: product delete by id */
	public function productDelete($id){

		$getquery = "SELECT * FROM tbl_product WHERE productId = '$id'";
		$getimg = $this->db->select($getquery);
		if ($getimg) {
			while ($img = $getimg->fetch_assoc()) {
			 	$delimg = $img['image'];
			 	unlink($delimg);
			}
		}

		$query = "DELETE FROM tbl_product WHERE productId = '$id'";
		$delpro = $this->db->delete($query);
		if($delpro){
			$msg = "<span class='success'>Product Successfully Deleted!</span>";
			return $msg;
		} else{
			$msg = "<span class='success'>Not Deleted!</span>";
			return $msg;
		}
	}



	/* Frontend: Featured product fetch */
	public function getFeatureProduct(){
		$query = "SELECT * FROM tbl_product WHERE type = '0' ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}


	/* Frontend: New product fetch */
	public function getNewProduct(){
		$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
		$result = $this->db->select($query);
		return $result;
	}

	/* Frontend: Single product by id */
	public function getSingleProById($id){
		$query ="SELECT p.*, c.catname, b.brandName
				FROM tbl_product as p, tbl_category as c, tbl_brand as b
				WHERE p.catId = c.catId AND p.brandId = b.brandId AND productId = '$id'";

		$result =  $this->db->select($query);
		return $result;
	}

	/* Frontend: Latest Brand Product Iphone */
	public function latestIphone(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='7' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	/* Frontend: Latest Brand Product Samsung */
	public function latestSamsung(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='3' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	/* Frontend: Latest Brand Product Acer */
	public function latestAcer(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='2' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	/* Frontend: Latest Brand Product Canon */
	public function latestCanon(){
		$query = "SELECT * FROM tbl_product WHERE brandId ='4' ORDER BY productId DESC LIMIT 1";
		$result = $this->db->select($query);
		return $result;
	}

	/* Frontend: get product by category */
	public function getCatPro($id){
		$query  = "SELECT * FROM tbl_product WHERE catId = '$id'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* Frontend: get category Name*/
	public function getCatName($id){
		$query  = "SELECT * FROM tbl_category WHERE catId = '$id'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* Frontend: add compare product */
	public function addCompareProduct($proId){
		$proquery = "SELECT * FROM tbl_product WHERE productId ='$proId'";
		$result = $this->db->select($proquery)->fetch_assoc();
		
		$cmrId = Session::get('cmrId');
		$productId 	 = $result['productId'];
		$productName = $result['productName'];
		$price 		 = $result['price'];
		$image 		 = $result['image'];

		
		$chquery = "SELECT * FROM tbl_compare WHERE productId = '$proId' AND cmrId = '$cmrId'";
		$getPro = $this->db->select($chquery);
		if ($getPro) {
			$msg = "<span class='error'> Already added to compare !</span>";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_compare(cmrId, productId, productName, price, image) VALUES ('$cmrId','$productId','$productName','$price','$image')";
			$insert_row = $this->db->insert($query);
			if($insert_row){
				$msg = "<span class='success'>Added to compare !</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Not added to compare !</span>";
				return $msg;
			}
		}
	}


	/* Frontend: view compare product */
	public function getCompareProduct($cmrId){
		$query  = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC";
		$result =  $this->db->select($query);
		return $result;
	}


	/* Delete Customer Compare Item when customer will logout */
	public function delAllCompareData(){
		$cmrId = Session::get('cmrId');
		$query = "DELETE FROM tbl_compare WHERE cmrId ='$cmrId'";
		$result = $this->db->delete($query);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}


	/* Frontend: add wishlist product */
	public function addWishlistProduct($proId){
		$proquery = "SELECT * FROM tbl_product WHERE productId ='$proId'";
		$result = $this->db->select($proquery)->fetch_assoc();
		
		$cmrId = Session::get('cmrId');
		$productId 	 = $result['productId'];
		$productName = $result['productName'];
		$price 		 = $result['price'];
		$image 		 = $result['image'];

		
		$chquery = "SELECT * FROM tbl_wishlist WHERE productId = '$proId' AND cmrId = '$cmrId'";
		$getPro = $this->db->select($chquery);
		if ($getPro) {
			$msg = "<span class='error'> Already added to Wishlist !</span>";
			return $msg;
		}else{
			$query = "INSERT INTO tbl_wishlist(cmrId, productId, productName, price, image) VALUES ('$cmrId','$productId','$productName','$price','$image')";
			$insert_row = $this->db->insert($query);
			if($insert_row){
				$msg = "<span class='success'>Added to Wishlist !</span>";
				return $msg;
			} else{
				$msg = "<span class='error'>Not added to Wishlist !</span>";
				return $msg;
			}
		}
	}


	/* Frontend: view wishlist product */
	public function getWishlistProduct($cmrId){
		$query  = "SELECT * FROM tbl_wishlist WHERE cmrId = '$cmrId' ORDER BY id DESC";
		$result =  $this->db->select($query);
		return $result;
	}


	/* Frontend: wishlist product delete by id */
	public function delWishlist($proid){
		$cmrId = Session::get("cmrId");
		$query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND cmrId='$cmrId'";
		$delpro = $this->db->delete($query);
		if($delpro){
			$msg = "<span class='success'>Successfully Deleted!</span>";
			return $msg;
		} else{
			$msg = "<span class='success'>Not Deleted!</span>";
			return $msg;
		}
	}


}	

?>	