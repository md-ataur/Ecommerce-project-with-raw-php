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
    		 <h2>Order Details</h2>
                <table class="tblone">
                    <tr>
                        <th>No</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $cmrId = Session::get("cmrId");
                        $getOrder = $ct->orderDetails($cmrId);
                        if ($getOrder) {
                            $i = 0;
                            while ($result = $getOrder->fetch_assoc()) {
                                $i++;
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $result['productName'];?></td>
                        <td><img src="admin/<?php echo $result['image'];?>" alt=""/></td>
                        <td>$ <?php echo $result['price'];?>
                        </td>
                        <td><?php echo $result['quantity'];?></td>
                        <td><?php echo $fm->formatDate($result['date']);?></td>
                        <td>
                            <?php
                                if ($result['status'] == '0') {
                                    echo "Pending";
                                }else{
                                    echo "<span style='color:green; font-weight:bold;'>Shifted</span>";
                                }
                            ?>       
                        </td>
                        <td>
                        <?php
                            if ($result['status'] == '1') { ?>
                                <a onclick="return confirm('Are you sure you want to delete this item?');" href="?delpro=<?php echo $result['cmrId'];?>">X</a>
                        <?php } else {echo "N/A";}?>
                        </td>
                        
                    </tr>              
                    <?php } }?>
                </table>
    	</div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>