<?php
include 'inc/header.php';
include 'inc/slider.php';
?>
	
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
				$getFeature = $pd->getFeatureProduct();
				if ($getFeature) {
					while ($fp = $getFeature->fetch_assoc()) {			
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?proid=<?php echo $fp['productId'];?>"><img src="admin/<?php echo $fp['image'];?>" alt="" /></a>
				<h2><?php echo $fp['productName'];?></h2>
				<p><?php echo $fm->textShorten($fp['body'], 40);?></p>
				<p><span class="price">$<?php echo $fp['price'];?></span></p>
				<div class="button"><span><a href="preview.php?proid=<?php echo $fp['productId'];?>" class="details">Details</a></span></div>
			</div>

			<?php } }?>

		</div>
		<div class="content_bottom">
    		<div class="heading">
    			<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
				$getNew = $pd->getNewProduct();
				if ($getNew) {
					while ($np = $getNew->fetch_assoc()) {			
			?>
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?proid=<?php echo $np['productId'];?>"><img src="admin/<?php echo $np['image'];?>" alt="" /></a>
				<h2><?php echo $np['productName'];?></h2>
				<p><?php echo $fm->textShorten($np['body'], 40);?></p>
				<p><span class="price">$<?php echo $np['price'];?></span></p>
				<div class="button"><span><a href="preview.php?proid=<?php echo $np['productId'];?>" class="details">Details</a></span></div>
			</div>

			<?php } } ?>
		</div>
    </div>
</div>
<?php
include 'inc/footer.php';
?>