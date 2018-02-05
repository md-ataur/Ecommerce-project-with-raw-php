<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	if (isset($_GET['delpro'])) {
		$id = $_GET['delpro'];
		$delpro = $pd->productDelete($id);
	}

?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <?php
        	if (isset($delpro)) {
        		echo $delpro;
        	}
        ?>
        <div class="block">  
            <table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>SL</th>
						<th>Product Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Price</th>
						<th>Image</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$getProduct = $pd->getAllProduct();
						if ($getProduct) {
							$i = 0;
							while ($product = $getProduct->fetch_assoc()) {
								$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i;?></td>
						<td><?php echo $product['productName'];?></td>
						<td><?php echo $product['catname'];?></td>
						<td><?php echo $product['brandName'];?></td>
						<td><?php echo $fm->textShorten($product['body'], 40);?></td>
						<td><?php echo $product['price'];?></td>
						<td><img src="<?php echo $product['image'];?>" width="50px" height="40"/></td>
						<td>
							<?php 
								if ($product['type'] == 0) {
									echo "Featured";
								}else{
									echo "General";
								}
							?>	
						</td>
						<td><a href="productedit.php?proid=<?php echo $product['productId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete this product ?')" href="?delpro=<?php echo $product['productId']?>">Delete</a></td>
					</tr>
					<?php } } ?>
				</tbody>
			</table>
       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
