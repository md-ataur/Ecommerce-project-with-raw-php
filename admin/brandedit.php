<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>
<?php
    if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
        echo "<script>window.location='brandlist.php'</script>";
    }else{
        $id = $_GET['brandid'];
        $getBrand = $brand->getBrandById($id);
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $brandUpdate = $brand->brandUpdate($id, $brandName);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Brand</h2>
                <div class="block copyblock">
                   <?php
                        if (isset($brandUpdate)) {
                            echo $brandUpdate;
                        }
                    ?>
                    <form action="" method="post">
                        <?php
                        if ($getBrand) {
                            while ($result = $getBrand->fetch_assoc()) { 
                        ?>    
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="brandName" value="<?php echo $result['brandName']?>" class="medium" />
                                </td>
                            </tr>
    						<tr> 
                                <td>
                                    <input type="submit" name="submit" Value="Save" />
                                </td>
                            </tr>
                        </table>
                        <?php } } ?>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>