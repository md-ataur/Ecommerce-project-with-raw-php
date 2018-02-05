<?php
include 'inc/header.php';
?>
<?php
	$login = Session::get("cmrlogin");
	if ($login == false) {
		header("Location:login.php");
	} /* if customer is not logged in */
?>

<div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="payment_bar">
                <h2>Choose Payment Option</h2>
                <div class="payment_btn">
                    <span><a href="pmoffline.php">Offline Payment</a></span>
                    <span><a href="">Online Payment</a></span>
                </div>
                <h1><a href="cart.php">BACK</a></h1>
            </div>
    	</div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>