<?php
include 'inc/header.php';
?>
<?php
	$login = Session::get("cmrlogin");
	if ($login == false) {
		header("Location:login.php");
	} /* if customer is not logged in */
?>
<style>
table.tblone img {
	width: 150px;
    height: 150px; 
}
</style>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    <h2>Compare</h2>
				<table class="tblone">
					<tr>
						<th width="5%">SL</th>
						<th width="20%">Product Name</th>
						<th width="15%">Price</th>
						<th width="10%">Image</th>
						<th width="10%">Action</th>
					</tr>
					
					<?php 
						$cmrId = Session::get("cmrId");
						$getPro = $pd->getCompareProduct($cmrId);
						if ($getPro) {
							$i = 0;
							while ($result = $getPro->fetch_assoc()) {
								$i++;
					?>
					<tr>
						<td><?php echo $i;?></td>
						<td><?php echo $result['productName'];?></td>
						<td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
						<td>$ <?php echo $result['price'];?></td>
						<td><a href="preview.php?proid=<?php echo $result['productId'];?>">View</a></td>
					</tr>			
					<?php } }?>
				</table>
			</div>
			<div class="shopping">
				<div class="shopleft" style="width: 100%;">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>