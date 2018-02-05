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
                <h2>Success</h2>
                <?php
                    $sum = 0;
                    $cmrId = Session::get("cmrId");
                    $getAmount = $ct->payableAmount($cmrId);
                    if ($getAmount) {
                        while ($result = $getAmount->fetch_assoc()) {
                            $price = $result['price'];
                            $sum = $sum + $price; 
                        }
                    }
                ?>
                <div class="success">
                   <p>Total Payable Amount (Including Vat): $
                        <?php
                            $vat   = $sum * 0.1;
                            $total = $sum + $vat;
                            echo $total;
                        ?>
                   </p>
                   <p>Thanks for Purchase. Receive Your Order Successfully. We will contact you as soon as possible with delivery details. Here is your order details...<a href="orderdetails.php">Visit Here</a></p>
                </div>
            </div>
    	</div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>