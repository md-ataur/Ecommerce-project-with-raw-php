<?php
include 'inc/header.php';
?>

<?php
	$login = Session::get("cmrlogin");
	if ($login == true) {
		header("Location:cart.php");
	} /* if customer is logged in */
?>

<div class="main">
    <div class="content">
    	<div class="login_panel">
        	<h3>Existing Customers</h3>

    		<?php
    			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
			        $custLogin = $cmr->customerLogin($_POST);
			    }
			    if (isset($custLogin)) {
			    	echo $custLogin;
			    }
    		?>
        	<form action="" method="post">
	        	<input type="text" name="email" placeholder="Email" />
	            <input type="password" name="password" class="field" placeholder="Password" />
	            <div class="buttons"><button class="grey" name="signin">Sign In</button></div>
	        </form>
            
        </div>
    	<div class="register_account">
    		<h3>Register New Account</h3>

    		<?php
    			if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
			        $customerRegi = $cmr->customerRegistration($_POST);
			    }
			    if (isset($customerRegi)) {
			    	echo $customerRegi;
			    }
    		?>
			<form action="" method="post">
				<table>
					<tbody>
						<tr>
							<td>
								<div>
									<input type="text" name="name" placeholder="Name" />
								</div>

								<div>
									<input type="text" name="city" placeholder="City" />
								</div>

								<div>
									<input type="text" name="zip" placeholder="Zip-Code" />
								</div>
								<div>
									<input type="text" name="email" placeholder="Email" />
								</div>
							</td>
							<td>
								<div>
									<input type="text" name="address" placeholder="Address" />
								</div>
								<div>
									<select id="country" name="country" class="frm-field required">
										<option value="null">Select a Country</option>         
										<option value="Afghanistan">Afghanistan</option>
										<option value="Australia">Australia</option>
										<option value="Austria">Austria</option>
										<option value="Bahrain">Bahrain</option>
										<option value="Bangladesh">Bangladesh</option>
										<option value="India">India</option>
										<option value="Pakistan">Pakistan</option>
										<option value="China">China</option>
									</select>
								</div>
								<div>
									<input type="text" name="phone" placeholder="Phone" />
								</div>
								<div>
									<input type="text" name="password" placeholder="Password" />
								</div>
							</td>
						</tr> 
					</tbody>
				</table> 
				<div class="search">
					<div>
						<button class="grey" name="register">Create Account</button>
					</div>
				</div>
				<div class="clear"></div>
			</form>
    	</div>  	
        <div class="clear"></div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>