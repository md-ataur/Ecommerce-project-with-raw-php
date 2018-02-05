﻿<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $brandName = $_POST['brandName'];
        $brandAdd = $brand->brandInsert($brandName);
    }

?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Brand</h2>
        <div class="block copyblock">
           <?php
                if (isset($brandAdd)) {
                    echo $brandAdd;
                }
            ?>
            <form action="" method="post">
                <table class="form">					
                    <tr>
                        <td>
                            <input type="text" name="brandName" placeholder="Enter Brand Name..." class="medium" />
                        </td>
                    </tr>
					<tr> 
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>