<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	if (isset($_GET['shiftid'])) {
		$cmrId = $_GET['shiftid'];
		$price = $_GET['price'];
		$date  = $_GET['date'];
		$shifted = $ct->orderShifted($cmrId, $price, $date);
	}

	if (isset($_GET['delshift'])) {
		$delId = $_GET['delshift'];
		$price = $_GET['price'];
		$date  = $_GET['date'];
		$delshift = $ct->orderShiftDelete($delId, $price, $date);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Order</h2>
                <?php
                	if (isset($shifted)) {
                		echo $shifted;
                	}

                	if (isset($delshift)) {
                		echo $delshift;
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Id</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$getOrder = $ct->getOrderAllProduct();
							if ($getOrder) {
								while ($result = $getOrder->fetch_assoc()) {
									
						?>
						<tr class="odd gradeX">
							<td><?php echo $result['id']?></td>
							<td><?php echo $fm->formatDate($result['date']);?></td>
							<td><?php echo $result['productName']?></td>
							<td><?php echo $result['quantity']?></td>
							<td>$ <?php echo $result['price']?></td>
							<td><?php echo $result['cmrId']?></td>
							<td><a href="customer.php?custId=<?php echo $result['cmrId'];?>">View Detail</a></td>
							<?php 
								if ($result['status'] == 0) { ?>
									<td><a style="color:#478efc;" href="?shiftid=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Confirm</a></td>
							<?php }else{?>
								<td><a href="?delshift=<?php echo $result['cmrId'];?>&price=<?php echo $result['price'];?>&date=<?php echo $result['date'];?>">Remove</a></td>
							<?php } ?>
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
