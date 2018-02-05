<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$result = $brand->brandDelete($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <?php
        	if (isset($result)) {
        		echo $result;
        	}
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$getBrand = $brand->getBrandAll();
					if ($getBrand) {
						$i = 0;
						while ($brand = $getBrand->fetch_assoc()) {
							$i++;	
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $brand['brandName'];?></td>
					<td><a href="brandedit.php?brandid=<?php echo $brand['brandId']?>">Edit</a> || <a onclick="return confirm('Are you sure to delete ?')" href="?id=<?php echo $brand['brandId']?>">Delete</a></td>
				</tr>

				<?php } }?>
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

