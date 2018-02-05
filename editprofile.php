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
    input[type="text"] {padding: 6px 7px;width: 70%;}
</style>	

<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
        $id = Session::get("cmrId");
        $profileUpdate = $cmr->updateProfile($id, $_POST);
    
    } /* Customer Profile update */
?>  

<div class="main">
    <div class="content">
    	<div class="section group">

    		<?php
    			$id = Session::get("cmrId");
    			$cmrdata = $cmr->getCustomerData($id);
    			if ($cmrdata) {
    				while ($result = $cmrdata->fetch_assoc()){

    		?>
            <?php 
                if (isset($profileUpdate)) {
                    echo "<p style='text-align: center; display: block;margin: 0 auto 14px;'>".$profileUpdate."</p>";
                }
            ?>
            <form action="" method="post">
        		<table class="tblone">
        			<tr>
        				<td width="20%">Name</td>
        				<td width="5%">:</td>
        				<td><input type="text" name="name" value="<?php echo $result['name'];?>" /></td>
        			</tr>
        			<tr>
        				<td>Email</td>
        				<td>:</td>
        				<td><input type="text" name="email" value="<?php echo $result['email'];?>" /></td>
        			</tr>
        			<tr>
        				<td>Phone</td>
                        <td>:</td>
        				<td><input type="text" name="phone" value="<?php echo $result['phone'];?>" /></td>
        			</tr>
        			<tr>
        				<td>Address</td>
                        <td>:</td>
        				<td><input type="text" name="address" value="<?php echo $result['address'];?>" /></td>
        			</tr>
                    <tr>
                        <td>Zip</td>
                        <td>:</td>
                        <td><input type="text" name="zip" value="<?php echo $result['zip'];?>" /></td>
                    </tr>   
        			<tr>
        				<td>City</td>
                        <td>:</td>
        				<td><input type="text" name="city" value="<?php echo $result['city'];?>" /></td>
        			</tr>
        			<tr>
        				<td>Country</td>
                        <td>:</td>
        				<td><input type="text" name="country" value="<?php echo $result['country'];?>" /></td>
        			</tr>
        			<tr>
        				<td></td>
        				<td></td>
        				<td><span><input type="submit" name="submit" value="Update" /></span><span class="probtn"><a href="profile.php">Profile</a></span></td>
        			</tr>	
        		</table>
        		<?php } } ?>
            </form>  
    	</div>
    </div>
</div>

<?php
include 'inc/footer.php';
?>