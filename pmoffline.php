<?php
include 'inc/header.php';
?>
<?php
	$login = Session::get("cmrlogin");
	if ($login == false) {
		header("Location:login.php");
	} /* if customer is not logged in */
?>

<?php
    if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
        $cmrId = Session::get("cmrId");
        $ordInsert = $ct->orderProduct($cmrId);
        $delData = $ct->delCustomerCart();
        header("Location:success.php");
    
    } /* order product inserted*/
?>

<div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="paymentorder_bar">
                <div class="col-1">
                    <?php
                    $id = Session::get("cmrId");
                    $cmrdata = $cmr->getCustomerData($id);
                    if ($cmrdata) {
                        while ($result = $cmrdata->fetch_assoc()){

                    ?>
                    <table class="tblone">
                        <tr>
                            <td width="20%">Name</td>
                            <td width="5%">:</td>
                            <td><?php echo $result['name'];?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $result['email'];?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><?php echo $result['phone'];?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo $result['address'];?></td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><?php echo $result['city'];?></td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td><?php echo $result['country'];?></td>
                        </tr>   
                        <tr>
                            <td></td>
                            <td></td>
                            <td><a href="editprofile.php">Edit Profile</a></td>
                        </tr>   
                    </table>
                    <?php } } ?>
                </div>
                <div class="col-2">
                    <table class="tblone">
                    <tr>
                        <th width="5%">No</th>
                        <th width="20%">Product</th>
                        <th width="20%">Quantity</th>
                        <th width="20%">Total Price</th>
                    </tr>
                    
                    <?php 
                        $getCart = $ct->getCartProduct();
                        if ($getCart) {
                            $i = 0;
                            $sum = 0;
                            while ($result = $getCart->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['productName'];?></td>
                        <td><?php echo $result['quantity'];?></td>
                        <td>$ <?php echo $result['price'];?></td>
                    </tr>
                     <?php 
                        $total = $result['price'] * $result['quantity'];
                        $sum = $sum + $total;
                        Session::set("sum", $sum);
                    ?>       
                    <?php } }?>
                </table>
                <?php 
                    $getData = $ct->checkCart();
                    if ($getData) { 
                ?>  
                <table class="subTotal" style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td>$ <?php echo $sum; ?> </td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>$ 10%</td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>$
                            <?php 
                                $vat    = $sum * 0.1; # 10/100 = 10%
                                $gtotal = $sum + $vat;
                                echo $gtotal;
                            ?>
                        </td>
                    </tr>
                </table>
                <?php } else {echo "Your Cart Empty !";}?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="payment_order">
                <h2><a href="?orderId=order">Place Order</a></h2>
            </div>
    	</div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>