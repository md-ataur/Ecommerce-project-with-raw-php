<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helper/Format.php');
?>

<?php
class Customer{
	private $db;
	private $fm;

	function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	}

	/* Customer Registration */
	public function customerRegistration($data){
		$name		= $this->fm->validation($data['name']);
		$city		= $this->fm->validation($data['city']);
		$zip		= $this->fm->validation($data['zip']);
		$email		= $this->fm->validation($data['email']);
		$address	= $this->fm->validation($data['address']);
		$country 	= $this->fm->validation($data['country']);
		$phone	 	= $this->fm->validation($data['phone']);
		$password	= $this->fm->validation($data['password']);

		$name 		= mysqli_real_escape_string($this->db->link, $data['name']);
		$city 		= mysqli_real_escape_string($this->db->link, $data['city']);
		$zip 		= mysqli_real_escape_string($this->db->link, $data['zip']);
		$email		= mysqli_real_escape_string($this->db->link, $data['email']);
		$address 	= mysqli_real_escape_string($this->db->link, $data['address']);
		$country 	= mysqli_real_escape_string($this->db->link, $data['country']);
		$phone 		= mysqli_real_escape_string($this->db->link, $data['phone']);
		$password 	= mysqli_real_escape_string($this->db->link, $data['password']);

		if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == "" ){
			$msg = "<span class='error'>Fields must not be empty !</span>";
			return $msg;

		}elseif ($password) {
			$password = md5($data['password']);
		}

		$emailquery = "SELECT * FROM tbl_customer WHERE email = '$email'";
		$emailCheck = $this->db->select($emailquery);

		if($emailCheck == true){
			$msg = "<span class='error'>Email already Exists !</span>";
			return $msg;

		}else{
			$query  = "INSERT INTO tbl_customer(name, city, zip, email, address, country, phone, password) VALUES ('$name', '$city', '$zip', '$email', '$address', '$country', '$phone', '$password')";
			$result = $this->db->insert($query);
			if($result){
				$msg = "<span class='success'>Successfully You Registered !</span>";
				return $msg;

			}else{
				$msg = "<span class='error'>Not Registered !</span>";
				return $msg;
			}
		}
	}

	/* Customer Login */
	public function customerLogin($data){
		$email		= $this->fm->validation($data['email']);
		$password	= $this->fm->validation($data['password']);

		$email		= mysqli_real_escape_string($this->db->link, $data['email']);
		$password 	= mysqli_real_escape_string($this->db->link, $data['password']);

		if ($email == "" || $password == "" ){
			$msg = "<span class='error'>Fields must not be empty !</span>";
			return $msg;

		}elseif ($password) {
			$password = md5($data['password']);
		}

		$query  = "SELECT * FROM tbl_customer WHERE email='$email' AND password='$password'";
		$result = $this->db->select($query);
		if ($result != false) {
			$value = $result->fetch_assoc();
			Session::set("cmrlogin", true);
			Session::set("cmrId", $value['id']);
			Session::set("cmrName", $value['name']);
			header("Location:cart.php");
		} else{
			$msg = "<span class='error'>User or Password Invalid !</span>";
			return $msg;
		}

	}


	/* Profile page customer data show */
	public function getCustomerData($id){
		$query  = "SELECT * FROM tbl_customer WHERE id='$id'";
		$result = $this->db->select($query);
		return $result;
	}

	/* Update Profile page */
	public function updateProfile($id, $data){
		$name		= $this->fm->validation($data['name']);
		$city		= $this->fm->validation($data['city']);
		$zip		= $this->fm->validation($data['zip']);
		$email		= $this->fm->validation($data['email']);
		$address	= $this->fm->validation($data['address']);
		$country 	= $this->fm->validation($data['country']);
		$phone	 	= $this->fm->validation($data['phone']);
		
		$name 		= mysqli_real_escape_string($this->db->link, $data['name']);
		$city 		= mysqli_real_escape_string($this->db->link, $data['city']);
		$zip 		= mysqli_real_escape_string($this->db->link, $data['zip']);
		$email		= mysqli_real_escape_string($this->db->link, $data['email']);
		$address 	= mysqli_real_escape_string($this->db->link, $data['address']);
		$country 	= mysqli_real_escape_string($this->db->link, $data['country']);
		$phone 		= mysqli_real_escape_string($this->db->link, $data['phone']);
		
		if ($name == "" || $city == "" || $zip == "" || $email == "" || $address == "" || $country == "" || $phone == "" ){
			$msg = "<span class='error'>Fields must not be empty !</span>";
			return $msg;

		}else{
			$query ="UPDATE tbl_customer 
						SET 
						name 	 = '$name', 
						city 	 = '$city', 
						zip 	 = '$zip', 
						email 	 = '$email', 
						address  = '$address', 
						country  = '$country', 
						phone 	 = '$phone' 
						WHERE id = '$id'";

			$result = $this->db->update($query);
			if($result){
				$msg = "<span class='success'>Successfully User Profile Updated !</span>";
				return $msg;

			}else{
				$msg = "<span class='error'>Not Updated !</span>";
				return $msg;
			}
		}
	}

}	