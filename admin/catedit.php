<?php
include 'inc/header.php';
include 'inc/sidebar.php';
?>

<?php
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location='catlist.php'</script>";
    }else{
        $id = $_GET['catid'];
        $getCat = $cat->getCatById($id);
    }
?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catname = $_POST['catname'];
        $catUpdate = $cat->catUpdate($id, $catname);
    }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
                <div class="block copyblock">
                   <?php
                        if (isset($catUpdate)) {
                            echo $catUpdate;
                        }
                    ?>
                    <form action="" method="post">
                        <?php
                        if ($getCat) {
                            while ($result = $getCat->fetch_assoc()) { 
                        ?>    
                        <table class="form">					
                            <tr>
                                <td>
                                    <input type="text" name="catname" value="<?php echo $result['catname']?>" class="medium" />
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