<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
        echo "<script>window.location='productlist.php'</script>";
    }else{
        $id = $_GET['proid'];
        $getProduct = $pd->getProById($id);
    }
?> <!-- product fetch by id -->

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $pdUpdate = $pd->productUpdate($_POST, $_FILES, $id);
    } 
?> <!-- product update by id -->

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Product</h2>
        
        <?php
            if (isset($pdUpdate)) {
                echo $pdUpdate;
            }else if (isset($_GET['message'])) {
                echo "<p style='color:green'>".$_GET['message']."</p>";
            }
        ?>

        <div class="block"> 
             <?php
                if ($getProduct) {
                    while ($product = $getProduct->fetch_assoc()) {

            ?>  <!-- product fetch by id while loop start -->
            
            <form action="" method="post" enctype="multipart/form-data">
                 <table class="form">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $product['productName']?>" class="medium" />
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                            <select id="select" name="catId">
                                <option value="">Select Category</option>
                                    <?php
                                        $cat = new Category();
                                        $getCat = $cat->getCatAll();
                                        if ($getCat) {
                                            while ($result = $getCat->fetch_assoc()) {

                                    ?> <!-- category fetch while loop start -->
                                <option 
                                    <?php
                                        if ($product['catId'] == $result['catId']) { ?>
                                           selected = "selected"
                                    <?php } ?> value="<?php echo $result['catId'];?>"><?php echo $result['catname'];?>     
                                </option>
                                <?php } } ?> <!-- category fetch while loop end -->
                            </select>
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <label>Brand</label>
                        </td>
                        <td>
                            <select id="select" name="brandId">
                                <option value="">Select Brand</option>
                                <?php
                                    $brand = new Brand();
                                    $getBrand = $brand->getBrandAll();
                                    if ($getBrand) {
                                        while ($result = $getBrand->fetch_assoc()) {

                                ?> <!-- brand fetch while loop start -->
                                <option 
                                    <?php
                                        if ($product['brandId'] == $result['brandId']) { ?>
                                           selected = "selected"
                                    <?php } ?> value="<?php echo $result['brandId'];?>"><?php echo $result['brandName'];?>        
                                </option>
                                <?php } } ?> <!-- brand fetch while loop end -->
                            </select>
                        </td>
                    </tr>
    				<tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea class="tinymce" name="body"> <?php echo $product['body']?> </textarea>
                        </td>
                    </tr>
    				<tr>
                        <td>
                            <label>Price</label>
                        </td>
                        <td>
                            <input type="text" name="price" value="<?php echo $product['price']?>" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <img src="<?php echo $product['image'];?>" width="90px" height="90px"/><br/>
                            <input type="file" name="image" />
                        </td>
                    </tr>
    				
    				<tr>
                        <td>
                            <label>Product Type</label>
                        </td>
                        <td>
                            <select id="select" name="type">
                                <option>Select Type</option>
                                <?php
                                    if ($product['type'] == 0) { ?>
                                        <option selected="selected" value="0">Featured</option>
                                        <option value="1">General</option>
                                        
                                <?php } else { ?>

                                    <option selected="selected" value="1">General</option>
                                    <option value="0">Featured</option>

                                <?php }?>
                            </select>
                        </td>
                    </tr>
    				<tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>                
            </form>
            <?php } } ?>  <!-- product fetch by id while loop end -->

        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


