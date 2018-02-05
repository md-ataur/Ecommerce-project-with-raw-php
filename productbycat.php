<?php
include 'inc/header.php';
?>
<?php
    if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
        echo "<script>window.location='404.php'</script>";
    }else{
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['catId']);
        $getCatPro  = $pd->getCatPro($id);
        $getCatName = $pd->getCatName($id);
    }
?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<?php
                if ($getCatName) {
                    while ($cat = $getCatName->fetch_assoc()) { 
            	?>   
    			<h3><?php echo $cat['catname'];?></h3>
    			<?php } }?>
    		</div>
    		<div class="clear"></div>
    	</div>
		<div class="section group">
			<?php
                if ($getCatPro) {
                    while ($result = $getCatPro->fetch_assoc()) { 
            ?>    
			<div class="grid_1_of_4 images_1_of_4">
				<a href="preview.php?proid=<?php echo $result['productId'];?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
				<h2><?php echo $result['productName'];?></h2>
				<p><?php echo $fm->textShorten($result['body'], 60);?></p>
				<p><span class="price">$<?php echo $result['price'];?></span></p>
				<div class="button"><span><a href="preview.php?proid=<?php echo $result['productId'];?>" class="details">Details</a></span></div>
			</div>
			<?php } } else {echo "<p style='color:red; margin-top:15px; text-transform: uppercase;'>Products not available in this category</p>";}?>
		</div>
    </div>
 </div>
<?php
include 'inc/footer.php';
?>