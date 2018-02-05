<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<?php
    if (!isset($_GET['custId']) || $_GET['custId'] == NULL) {
        echo "<script>window.location='order.php'</script>";
    }else{
        $custId = $_GET['custId'];
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location='order.php'</script>";
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Details</h2>
                <div class="block copyblock">
                    <form action="" method="post">
                        <?php
                        $custData = $cmr->getCustomerData($custId);
                        if ($custData) {
                            while ($result = $custData->fetch_assoc()) { 
                        ?>    
                        <table class="form">					
                            <tr>
                                <td width="25%">Name</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['name']?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['email']?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['phone']?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['address']?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['city']?>" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    <input type="text" readonly="readonly" value="<?php echo $result['country']?>" class="medium" />
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="submit" Value="OK" />
                                </td>
                            </tr>
                        </table>
                        <?php } } ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>