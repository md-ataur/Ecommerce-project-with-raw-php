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
	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		$cartId = $_POST['cartId'];
		$quantity = $_POST['quantity'];
		$updateCart = $ct->updateCartQuantity($quantity, $cartId);
	} /* quantity update by cartId*/

	if (isset($_GET['delpro'])) {
		$cartId = $_GET['delpro'];
		$deleteCart = $ct->deleteCartById($cartId);
	} /* Delete cart by cartId */
?>

<?php 
	if (!isset($_GET['id'])) {
		echo "<meta http-equiv='refresh' content='0; URL=?id=shop'/>";
	} /* for page refreshing */

?>

<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    <h2>Your Cart</h2>
			    <?php 
			    	if (isset($updateCart)) {
			    		echo "<p>".$updateCart."</p>";

			    	}elseif (isset($deleteCart)) {
			    		echo $deleteCart;
			    	}
			    ?>
				<table class="tblone">
					<tr>
						<th width="5%">SL</th>
						<th width="20%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15%">Price</th>
						<th width="20%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
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
						<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
						<td>$ <?php echo $result['price'];?></td>
						<td>
							<form action="" method="post">
								<input type="hidden" name="cartId" value="<?php echo $result['cartId'];?>"/>
								<input type="number" min="1" name="quantity" value="<?php echo $result['quantity'];?>"/>
								<input type="submit" name="submit" value="Update"/>
							</form>
						</td>
						<td>$ 
							<?php 
								$total = $result['price'] * $result['quantity'];
								echo $total;
							?>
						</td>
						<td><a onclick="return confirm('Are you sure you want to delete this item?');" href="?delpro=<?php echo $result['cartId'];?>">X</a></td>
					</tr>
					<?php 
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
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>