<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>

<?php
class Cart{
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}


	/* Cart product insert in the db table */
	public function addToCart($quantity, $id){
		$quantity  = mysqli_real_escape_string($this->db->link, $quantity);
		$productId = mysqli_real_escape_string($this->db->link, $id);
		$sessionId = session_id();

		$squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
		$result = $this->db->select($squery)->fetch_assoc();
		
		$productName = $result['productName'];
		$price 		 = $result['price'];
		$image		 = $result['image'];


		$chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sessionId = '$sessionId'";
		$getPro = $this->db->select($chquery);
		if ($getPro) {
			$msg = "Product already added !";
			return $msg;
		} else {

			$query  = "INSERT INTO tbl_cart(sessionId, productId, productName, price, quantity, image) VALUES ('$sessionId', '$productId', '$productName', '$price', '$quantity', '$image')";
			$result = $this->db->insert($query);

			if($result){
				echo "<script>window.location ='cart.php'</script>";
			}else{
				header("Location:404.php");
			}
		}	
	}

	/* Product fetch to the cart page */
	public function getCartProduct(){
		$sessionId = session_id();
		$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* update quantity */
	public function updateCartQuantity($quantity, $cartId){
		$query = "UPDATE tbl_cart SET quantity ='$quantity' WHERE cartId ='$cartId'";
		$result = $this->db->update($query);
		if ($result) {
			echo "<script>window.location ='cart.php'</script>";

		}else{
			$msg = "<span class='error'>Quantity Not updated !</span>";
			return $msg;
		}
	}

	/* Delete cart */
	public function deleteCartById($cartId){
		$query = "DELETE FROM tbl_cart WHERE cartId ='$cartId'";
		$result = $this->db->delete($query);
		if ($result) {
			header("Location:cart.php");

		}else{
			$msg = "<span class='error'>Product Not Deleted !</span>";
			return $msg;
		}
	}

	/* check cart table */
	public function checkCart(){
		$sessionId = session_id();
		$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* Delete Customer Cart Item when customer will logout */
	public function delCustomerCart(){
		$sessionId = session_id();
		$query = "DELETE FROM tbl_cart WHERE sessionId ='$sessionId'";
		$result = $this->db->delete($query);
		if ($result) {
			return true;
		}else{
			return false;
		}
	}


	/* Order product insert */
	public function orderProduct($cmrId){
		$sessionId = session_id();
		$query  = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
		$getPro =  $this->db->select($query);
		if ($getPro) {
			while ($result = $getPro->fetch_assoc()) {
				$productId 	 = $result['productId'];
				$productName = $result['productName'];
				$quantity 	 = $result['quantity'];
				$price 		 = $result['price'] * $quantity;
				$image 		 = $result['image'];
				
				$query  = "INSERT INTO tbl_order(cmrId, productId, productName, price, quantity, image) VALUES ('$cmrId', '$productId', '$productName', '$price', '$quantity', '$image')";
				$result = $this->db->insert($query);

			}
		}
	}


	/* Payable amount show in success page */
	public function payableAmount($cmrId){
		$query  = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
		$result =  $this->db->select($query);
		return $result;
	}


	/* Customer order detials */
	public function orderDetails($cmrId){
		$query  = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC ";
		$result =  $this->db->select($query);
		return $result;
	}


	/* check Order table */
	public function checkOrder($cmrId){
		$query  = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
		$result =  $this->db->select($query);
		return $result;
	}

	/* admin: order product show */
	public function getOrderAllProduct(){
		$query  = "SELECT * FROM tbl_order ORDER BY date DESC";
		$result =  $this->db->select($query);
		return $result;
	}

	/* admin: product shifted function */
	public function orderShifted($cmrId, $price, $date){
		$cmrId  = mysqli_real_escape_string($this->db->link, $cmrId);
		$price  = mysqli_real_escape_string($this->db->link, $price);
		$date   = mysqli_real_escape_string($this->db->link, $date);

		$query  = "UPDATE tbl_order 
					SET status='1' WHERE cmrId = '$cmrId' AND price='$price' AND date='$date'";
		$result =  $this->db->update($query);
		if($result){
			$msg = "<span class='success'>Successfully Updated !</span>";
			return $msg;

		}else{
			$msg = "<span class='error'>Not Updated !</span>";
			return $msg;
		}

	}


	/* admin: product shifted delete */
	public function orderShiftDelete($id, $price, $date){
		$id    = mysqli_real_escape_string($this->db->link, $id);
		$price = mysqli_real_escape_string($this->db->link, $price);
		$date  = mysqli_real_escape_string($this->db->link, $date);
		$query = "DELETE FROM tbl_order WHERE cmrId = '$id' AND price='$price' AND date='$date'";
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