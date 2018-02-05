<?php
include 'inc/header.php';
?>
<?php
	$login = Session::get("cmrlogin");
	if ($login == false) {
		header("Location:login.php");
	} /* if customer is not logged in */
?>
<style type="text/css">
	table.tblone {width: 550px; margin:0 auto; border:1px solid #ddd;}
	table.tblone tr td{text-align: justify; width: auto;}
</style>	
<div class="main">
    <div class="content">
    	<div class="section group">
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
    </div>
</div>

<?php
include 'inc/footer.php';
?>