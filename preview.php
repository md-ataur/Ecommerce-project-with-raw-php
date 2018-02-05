<?php
include 'inc/header.php';
?>

<?php
    if (isset($_GET['proid'])) {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['proid']);
        $getPro = $pd->getSingleProById($id);
    } /* single product fetch by id */

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    	$quantity = $_POST['quantity'];
    	$addCart = $ct->addToCart($quantity, $id);
    } /* product add to cart by id */

?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['compare'])) {    	
    	$proId = $_POST['productId'];
    	$cmprProInsert = $pd->addCompareProduct($proId);
    } /* product add to Compare by id */

?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['wishlist'])) {
    	$wlistProInsert = $pd->addWishlistProduct($id);
    } /* product add to Wishlist by id */

?>

<div class="main">
    <div class="content">
    	<div class="section group">
			<div class="cont-desc span_1_of_2">	
				<?php
					if ($getPro) {
						while ($result = $getPro->fetch_assoc()) {
					
				?>
				<div class="grid images_3_of_2">
					<img src="admin/<?php echo $result['image'];?>" alt="" />
				</div>
				<div class="desc span_3_of_2">
					<div class="pn">Name: <span> <?php echo $result['productName'];?><span></div>			
					<div class="price">
						<p>Price: <span>$<?php echo $result['price'];?></span></p>
						<p>Category: <span><?php echo $result['catname'];?></span></p>
						<p>Brand: <span><?php echo $result['brandName'];?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" min="1" class="buyfield" name="quantity" value="1"/>
							<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
						</form>	
						<?php
							if (isset($addCart)) {
								echo "<p style='color:red;font-size:15px;'>".$addCart."</p>";
							}
						?>			
					</div>
					<?php
						$login = Session::get("cmrlogin");
						if ($login == true) { ?>
							<div class="add-list">
								<div class="mybutton">
									<form action="" method="post">
										<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId'];?>"/>
										<input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
									</form>
								</div>	
								<div class="mybutton">
									<form action="" method="post">
										<input type="submit" class="buysubmit" name="wishlist" value="Add to Wishlist"/>
									</form>
								</div>	
								<div class="clear"></div>
							</div>
					<?php } /* if customer is logged in */ ?>
					
					<?php 
						if (isset($cmprProInsert)) {
							echo $cmprProInsert;
						}elseif (isset($wlistProInsert)) {
							echo $wlistProInsert;
						}
					?>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<?php echo $result['body'];?>
			    </div>	
			   <?php } }?>
			</div>

			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
					<?php
						$getCat = $cat->getCatAll();
						if ($getCat) {
							while ($result = $getCat->fetch_assoc()) {
						
					?>
					<li><a href="productbycat.php?catId=<?php echo $result['catId']?>"><?php echo $result['catname']?></a></li>
					<?php } }?>
				</ul>
			</div>

 		</div>
 	</div>
</div>
<?php
include 'inc/footer.php';
?>